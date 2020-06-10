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
  $resultJsonData = '';

  //sql인젝션 방지
  if (isset($_POST['userId'])) {
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
          $userId = stripslashes($_POST['userId']);

      } else {
          $userId = $_POST['userId'];
      }

      session_start();

      //요청자가 로그인된 실유저인지 확인
      if($_SESSION['userId'] != null){
          $myId = $_SESSION['userId'];
      } else{
          $myId = null;
      }

      //세션유저와 요청된 유저가 동일인 인지 확인
      if($myId == $userId){
          $resultJsonData .= '{"result": "success", "code": "1", "message": "나의 프로필", ';
      }
      else{//남의 프로필을 조회
          $resultJsonData .= '{"result": "success", "code": "2", "message": "다른이의 프로필", ';
      }

      //상대와 친구인지 확인
      // 0 : 아무관계아님, 1 : 내가 친구, 2 : 상대가 친추, 3 : 맞팔 상태
      $isFriend = 0;
      $sql = "SELECT a.user_id, a.friend_id, b.level FROM FRIENDS a, USER_MST b WHERE a.user_id = '".$myId."' AND a.friend_id = '".$userId."' AND a.user_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_row($result)) {
          $isFriend += 1;
      }
      $sql = "SELECT a.user_id, a.friend_id, b.level FROM FRIENDS a, USER_MST b WHERE a.user_id = '".$userId."' AND a.friend_id = '".$myId."' AND a.user_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_row($result)) {
          $isFriend += 2;
      }
      $resultJsonData .= '"friendship": "'.$isFriend.'", ';

      //이 사람의 친구 리스트
      $resultJsonData .= '"following": ['; //이사람이 친추한 사람들
      $flagMy = false;
      $sql = "SELECT a.user_id, a.friend_id, b.level FROM FRIENDS a, USER_MST b WHERE a.user_id = '".$userId."' AND a.friend_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData .= '{"id": "'.$row[1].'", "level" : "'.$row[2].'"},';
      }
      if($flagMy)
          $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거
      $resultJsonData .= ']';

      //이 사람의 팔로워 리스트
      $resultJsonData .= '"follower": ['; //이사람을 친추한 사람들
      $sql = "SELECT a.user_id, a.friend_id, b.level FROM FRIENDS a, USER_MST b WHERE a.friend = '".$userId."' AND a.user_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      $flagMy = false;
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData .= '{"id": "'.$row[0].'", "level" : "'.$row[2].'"},';
      }
      if($flagMy)
          $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거
      $resultJsonData .= ']';


      $resultJsonData .= '}';
      echo $resultJsonData;




  }
  else{
      //비어있는 post데이터가 있음

      echo '{"result": "error", "code": "-1", "message": "empty data"}';
      mysqli_close($connect);

  }

?>