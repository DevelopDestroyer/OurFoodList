<?php

/*
결과코드
1 : 친추성공
2 : 언팔성공 성공
-100 : 존재하지 않는 임시 아이디 입니다. 문제가 지속돼면 캐시데이터를 삭제 후 시도해보세요
-200 : 암호 틀리거나 아이디가 틀림
-1 : isset 공백 에러
-2 : 세션에 없는 유저가 요청을 시도함
-3 : 세션유저와 요청유저가 동일하지 않음...
-4 : 자신과 친추시도함
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  $myId = '';

  //sql인젝션 방지
  if (isset($_POST['friendId']) && isset($_POST['isFriendRequest'])) {
      //db저장
      $connect = mysqli_connect($db_host, $db_user_name, $db_pw, $db_name);
      //$connect = mysql_connect($db_host,$db_name,$db_pw);
      $db = mysqli_select_db($connect, $db_name) or die('DB Connect failure!!!!');
      //$db = mysql_select_db($db_name,$connect);

      if ($connect->connect_error) {
          //db커넥션 에러
          die("Connection failed: " . $connect->connect_error);
          return;
      }


      // ON일 경우 magic_quotes_gpc/magic_quotes_sybase 효과 제거
      if (get_magic_quotes_gpc()) {
          $friendId = stripslashes($_POST['friendId']);
          $isFriendRequest = stripslashes($_POST['isFriendRequest']);

      } else {
          $friendId = $_POST['friendId'];
          $isFriendRequest = $_POST['isFriendRequest'];
      }

      session_start();

      //세션유저와 실유저가 맞는지 확인
      //임시유저는 사용할 수 없는 기능임 && $_SESSION["tmpUserId"] == null
      if($_SESSION['userId'] == null){
          echo '{"result": "error", "code": "-2", "message": "session이 없는 사용자 입니다."}';
          mysqli_close($connect);
          return;

      } else{
          //if($_SESSION['userId'] == null)
          //    $myId = $_SESSION['tmpUserId'];
          //else

          $myId = $_SESSION['userId'];
      }

      //요청된 유저와 친구유저가 동일한 사람인지 확인
      if($friendId == $myId){
          echo '{"result": "error", "code": "-4", "message": "자신과 친구를 할 수는 없습니다."}';
          mysqli_close($connect);
          return;
      }

      //팔로우 요청인지 언팔요청인지 확인
      if($isFriendRequest == 'Y') { //친구요청
          //이미 등록된 레코드가 있을 수 있으니 선제거 후 등록
          $sql = "DELETE FROM FRIENDS WHERE user_id = '" . mysqli_real_escape_string($connect, $myId) . "' AND friend_id = '" . mysqli_real_escape_string($connect, $friendId) . "';";
          $result = mysqli_query($connect, $sql);

          //실제 상대가 존재하는 유저인지 확인하는 로직이 있으면 더 좋겠음..


          $sql = "INSERT INTO FRIENDS (user_id, friend_id) VALUES ('" . mysqli_real_escape_string($connect, $myId) . "', '" . mysqli_real_escape_string($connect, $friendId) . "');";
          $result = mysqli_query($connect, $sql);

          echo '{"result": "success", "code": "1", "message": "팔로잉 되었습니다."}';
          mysqli_close($connect);

          return;
      }
      else { //언팔 요청
          $sql = "DELETE FROM FRIENDS WHERE user_id = '" . mysqli_real_escape_string($connect, $myId) . "' AND friend_id = '" . mysqli_real_escape_string($connect, $friendId) . "';";
          $result = mysqli_query($connect, $sql);

          echo '{"result": "success", "code": "2", "message": "언팔로잉 되었습니다."}';
          mysqli_close($connect);

          return;
      }


  }
  else{
      //비어있는 post데이터가 있음

      echo '{"result": "error", "code": "-1", "message": "empty data"}';
      mysqli_close($connect);

  }

?>