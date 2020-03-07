<?php

/*
결과코드
1 : 임시유저 가입 정상 message에 id발급
2 : 유저 가입 정상
-100 : 이미 있는 아이디임
-1 : isset 공백 에러
-44 : 이미 로그인된 임시회원이라 가입 불가
-45 : 이미 로그인된 회원이라 가입 불가
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  //sql인젝션 방지
  if (isset($_POST['userId']) && isset($_POST['userPw']) && isset($_POST['isTmpUser']) && isset($_POST['tmpIdForUpgradeAccount'])) {

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
          $tmpIdForUpgradeAccount = stripslashes($_POST['tmpIdForUpgradeAccount']);

      } else {
          $userId = $_POST['userId'];
          $userPw = $_POST['userPw'];
          $isTmpUser = $_POST['isTmpUser'];
          $tmpIdForUpgradeAccount = $_POST['tmpIdForUpgradeAccount'];
      }


      //이미 있는 id인지 확인합니다
      $sql = "select user_id from USER_MST where user_id='" . $userId . "';";
      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_row($result)) {
          echo '{"result": "error", "code": "-100", "message": "이미 있는 아이디 입니다."}';
          return;
      }
      session_start();
      if ($isTmpUser == 'Y') {//임시유저 가입 처리, 임시유저는 로그인까지 자동으로 해준다
          if($_SESSION["tmpUserId"] == null) {
              $newTmpId = "GUEST_".uniqid();
              $sql = "insert into USER_MST (user_id, level, create_date, status_cd) values ";
              $sql = $sql . "('" . $newTmpId . "', '0', '" . date("Y-m-d H:i:s") . "', 'T');";
              $result = mysqli_query($connect, $sql);
              $_SESSION["tmpUserId"] = $newTmpId;
              mysqli_close($connect);
              echo '{"result": "success", "code": "1", "message": "'.$newTmpId.'"}';
          }
          else{
              echo '{"result": "error", "code": "-44", "message": "이미 임시 유저로 인증되었습니다."}';
          }
      } else {//신규유저 가입 처리
          if($_SESSION["userId"] == null) {
              $sql = "insert into USER_MST (user_id, user_pw, level, create_date, status_cd) values ";
              $sql = $sql . "('" . mysqli_real_escape_string($connect, $userId) . "', '" . mysqli_real_escape_string($connect, $userPw) . "', '1', '" . date("Y-m-d H:i:s") . "', 'U');";
              $result = mysqli_query($connect, $sql);
              if($tmpIdForUpgradeAccount != null && $tmpIdForUpgradeAccount != ''){//그동안 임시 계정으로 활동했었다면 신규계정으로 모두 이전처리해준다.
                  $sql = "update USER_MST set status_cd = 'D', update_date='".date("Y-m-d H:i:s")."', introduce='".mysqli_real_escape_string($connect, $userId)."' where user_id = '".mysqli_real_escape_string($connect, $tmpIdForUpgradeAccount)."';";
                  $result = mysqli_query($connect, $sql);

                  $sql = "update REVIEW_MST set user_id = '".mysqli_real_escape_string($connect, $userId)."' where user_id='".mysqli_real_escape_string($connect, $tmpIdForUpgradeAccount)."';";
              }
              mysqli_close($connect);
              echo '{"result": "success", "code": "2", "message": "회원가입이 완료되었습니다."}';
          }
          else{
              echo '{"result": "error", "code": "-45", "message": "이미 로그인된 유저 입니다."}';
          }
      }


      //비어있는 post데이터가 있음

  }
  else{
      //비어있는 post데이터가 있음
      echo '{"result": "error", "code": "-1", "message": "empty data"}';
  }

?>