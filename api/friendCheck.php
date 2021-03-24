<?php

/*
결과코드
1 : 존재하는 아이디
-1 : isset 공백 에러
-2 : 없는 아이디
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

    if($_GET['friendId'] == null || $_GET['friendId'] == '') {
        echo '{"result": "success", "code": "-1", "message": "유효하지 않은 요청 입니다."}';
        return;
    }

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
          $friendId = stripslashes($_GET['friendId']);

      } else {
          $friendId = $_GET['friendId'];
      }


      $sql = "select user_id from USER_MST where user_id='".$friendId."' and status_cd != 'D';";
      $result = mysqli_query($connect, $sql);
      $isExist = false;
      while ($row = mysqli_fetch_row($result)) {
          $isExist = true;
          break;
      }

      if($isExist == true) {
          echo '{"result": "success", "code": "1", "message": "존재하는 아이디 입니다."}';
      }
      else {
          echo '{"result": "fail", "code": "-2", "message": "존재하지 않는 아이디 입니다."}';
      }

      mysqli_close($connect);




?>