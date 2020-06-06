<?php

/*
결과코드
1 : 임시유저 로그인 성공
2 : 실유저 로그인 성공
3 : 로그아웃 성공
-100 : 존재하지 않는 임시 아이디 입니다. 문제가 지속돼면 캐시데이터를 삭제 후 시도해보세요
-200 : 암호 틀리거나 아이디가 틀림
-1 : isset 공백 에러
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  //sql인젝션 방지
  if (isset($_POST['userId']) && isset($_POST['userPw']) && isset($_POST['isTmpUser']) && isset($_POST['isLoginReq'])) {
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
          $userPw = stripslashes($_POST['userPw']);
          $isTmpUser = stripslashes($_POST['isTmpUser']);
          $isLoginReq = stripslashes($_POST['isLoginReq']);

      } else {
          $userId = $_POST['userId'];
          $userPw = $_POST['userPw'];
          $isTmpUser = $_POST['isTmpUser'];
          $isLoginReq = $_POST['isLoginReq'];
      }

      //로그인 요청인지 로그아웃 요청인지 확인하자
      if($isLoginReq == 'Y'){
          if($isTmpUser == 'Y'){//게스트유저 로그인 처리
              //존재하는 ID 인지 확인 합니다.
              $sql = "select user_id from USER_MST where user_id='" . $userId . "';";
              $result = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_row($result)) {
                  session_start();
                  $_SESSION["tmpUserId"] = $userId;
                  echo '{"result": "success", "code": "1", "message": "게스트계정 로그인 완료"}';
                  mysqli_close($connect);
                  return;
              }
              echo '{"result": "error", "code": "-100", "message": "존재하지 않는 게스트아이디 입니다 : '.$userId.'"}';
              mysqli_close($connect);

              return;
          }
          else{//실유저 로그인 처리
              //존재하는 ID 인지, 패스워드는 맞는지 확인 합니다.
              $sql = "select user_id from USER_MST where user_id='" . $userId . "' and user_pw = '".$userPw."';";
              $result = mysqli_query($connect, $sql);
              while ($row = mysqli_fetch_row($result)) {
                  session_start();
                  $_SESSION["userId"] = $userId;
                  echo '{"result": "success", "code": "2", "message": "로그인 완료"}';
                  mysqli_close($connect);

                  return;
              }
              echo '{"result": "error", "code": "-200", "message": "존재하지 않는 아이디거나 패스워드가 일치하지 않습니다."}';
              mysqli_close($connect);
              return;
          }
      }
      else{//로그아웃 요청 처리
          session_start();
          session_destroy();
          mysqli_close($connect);

          echo '{"result": "success", "code": "3", "message": "로그아웃 완료"}';
      }

  }
  else{
      //비어있는 post데이터가 있음
      echo '{"result": "error", "code": "-1", "message": "empty data"}';
      mysqli_close($connect);

  }

?>