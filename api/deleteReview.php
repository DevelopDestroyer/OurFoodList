<?php

/*
결과코드
1 : 정상
-1 : 비어있는 데이터가 있음
-3 : reviewSeq값을 숫자가 아닌 것으로 받았을 때
-5000 : 로그인 안되어 있음

 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  //sql인젝션 방지
  if (isset($_POST['reviewSeq'])) {

      //유저 인증
      session_start();
      $LOGIN_USER_ID = '';


      if(!preg_match( "/^[0-9]/i", $_POST['reviewSeq'] )){
          echo '{"result": "error", "code": "-3", "message": "유효하지 않은 리뷰아이디 입니다."}';
          //mysqli_close($connect);

          return;
      }


      if($_SESSION['userId'] == null && $_SESSION['tmpUserId' == null]){
          echo '{"result": "error", "code": "-5000", "message": "이 기능은 로그인이 필요합니다. 현재 서버에 로그인된 상태가 아닙니다."}';
          //mysqli_close($connect);

          return;
      }
      else {
          if($_SESSION['userId'] != null)
              $LOGIN_USER_ID = $_SESSION['userId'];
          else
              $LOGIN_USER_ID = $_SESSION['tmpUserId'];
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


      $reviewsseq = $_POST['$reviewSeq'];
    // ON일 경우 magic_quotes_gpc/magic_quotes_sybase 효과 제거
    if(get_magic_quotes_gpc()) {
        $reviewsseq = stripslashes($_POST['$reviewSeq']);
    } else {
        $reviewsseq = $_POST['$reviewSeq'];
    }

      $sql = "update REVIEW_MST set del_yn = 'Y' where user_id='".mysqli_real_escape_string($connect, $LOGIN_USER_ID)."' and review_seq = '".$_POST['reviewSeq']."';";

      //질의 전송
      $result = mysqli_query($connect, $sql);
      echo '{"result": "success", "code": "1", "message": "complete'.$LOGIN_USER_ID.';;'.stripslashes($_POST['$reviewSeq']).';;'.$_POST["reviewSeq"].'"}';
      
      mysqli_close($connect);

  }
  else{
    //비어있는 post데이터가 있음
    echo '{"result": "error", "code": "-1", "message": "empty data"}';
      mysqli_close($connect);

  }


?>
