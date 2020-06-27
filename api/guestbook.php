<?php

/*
결과코드
1 : 등록성공
2 : 업데이트 성공
3 : 제거 성공
-100 : 존재하지 않는 임시 아이디 입니다. 문제가 지속돼면 캐시데이터를 삭제 후 시도해보세요
-1 : isset 공백 에러
-2 : 세션에 없는 유저가 요청을 시도함
-3 : 세션유저는 권한이 없음
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  $myId = '';

  //sql인젝션 방지
  if (isset($_POST['order'])
      && isset($_POST['guestbookSeq']) && isset($_POST['refGuestbookSeq']) && isset($_POST['toUserId'])
      && isset($_POST['fromUserId']) && isset($_POST['contents'])
      && isset($_POST['secretYn'])) {
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
          $order = stripslashes($_POST['order']);

          $guestbookSeq = stripslashes($_POST['guestbookSeq']);
          $refGuestbookSeq = stripslashes($_POST['refGuestbookSeq']);
          $toUserId = stripslashes($_POST['toUserId']);

          $fromUserId = stripslashes($_POST['fromUserId']);
          $contents = stripslashes($_POST['contents']);

          $secretYn = stripslashes($_POST['secretYn']);

      } else {
          $order = $_POST['order'];

          $guestbookSeq = $_POST['guestbookSeq'];
          $refGuestbookSeq = $_POST['refGuestbookSeq'];
          $toUserId = $_POST['toUserId'];

          $fromUserId = $_POST['fromUserId'];
          $contents = $_POST['contents'];

          $secretYn = $_POST['secretYn'];
      }

      if($secretYn == false)
          $secretYn = 'N';
      if($secretYn == true)
          $secretYn = 'Y';


      session_start();

      if($_SESSION['userId'] == null){ //로그인 유저인지 확인
          echo '{"result": "error", "code": "-2", "message": "session이 없는 사용자 입니다."}';
          mysqli_close($connect);
          return;

      } else{ //로그인 유저일 경우 myId변수에 계정정보를 넣어준다
          $myId = $_SESSION['userId'];
      }


      //// 방명록 글 등록
      if($order == '1'){
          if($refGuestbookSeq = ''){
              $sql = "INSERT INTO GUESTBOOK (to_user_id, from_user_id, del_yn, contents, secret_yn, created, updated)
                      VALUES ('".$toUserId."', '".$fromUserId."', 'N', '".$contents."', '".$secretYn."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."');";
              $result = mysqli_query($connect, $sql);

          }
          else{
              $sql = "INSERT INTO GUESTBOOK (ref_guestbook_seq, to_user_id, from_user_id, del_yn, contents, secret_yn, created, updated)
                      VALUES ('".$refGuestbookSeq."', '".$toUserId."', '".$fromUserId."', 'N', '".$contents."', '".$secretYn."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."');";
              $result = mysqli_query($connect, $sql);
          }

          echo '{"result": "success", "code": "1", "message": "글이 등록 되었습니다."}';
          mysqli_close($connect);
          return;
      }

      //// 방명록 글 수정
      else if($order == '2'){
          //실제 게시물 수정 권한 있는지 확인
          $havePermission = false;
          $sql = "SELECT to_user_id FROM GUESTBOOK 
                  WHERE guestbook_seq = '".$guestbookSeq."' and from_user_id = '".$myId."';";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_row($result)) {
              $havePermission = true;
              break;
          }
          if($havePermission == false){
              echo '{"result": "error", "code": "-3", "message": "권한이 없음"}';
              mysqli_close($connect);
              return;
          }
          $sql = "UPDATE GUESTBOOK 
                  SET 
                         contents='".$contents."'
                       , secret_yn='".$secretYn."'
                       , updated='".date("Y-m-d H:i:s")."' 
                   WHERE guestbook_seq = '".$guestbookSeq."';";
          $result = mysqli_query($connect, $sql);

          echo '{"result": "success", "code": "2", "message": "글이 수정 되었습니다."}';
      }
      //// 방명록 글 삭제
      else if($order == '3'){
          //실제 게시물 삭제 권한 있는지 확인
          $havePermission = false;
          $sql = "SELECT to_user_id FROM GUESTBOOK 
                  WHERE guestbook_seq = '".$guestbookSeq."' 
                        and (
                            from_user_id = '".$myId."' or to_user_id = '".$myId."');";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_row($result)) {
              $havePermission = true;
              break;
          }
          if($havePermission == false){
              echo '{"result": "error", "code": "-3", "message": "권한이 없음"}';
              mysqli_close($connect);
              return;
          }
          $sql = "UPDATE GUESTBOOK 
                  SET 
                         del_yn='Y'
                       , updated='".date("Y-m-d H:i:s")."' 
                   WHERE guestbook_seq = '".$guestbookSeq."';";
          $result = mysqli_query($connect, $sql);

          echo '{"result": "success", "code": "3", "message": "글이 삭제 되었습니다."}';
          mysqli_close($connect);
          return;
      }
      else{
          echo '{"result": "error", "code": "-1", "message": "empty data"}';
          mysqli_close($connect);
          return;
      }



  }
  else{
      //비어있는 post데이터가 있음

      echo '{"result": "error", "code": "-1", "message": "empty data"
'.
          '1'.$_POST['order']

      .'2'.$_POST['guestbookSeq']
          .'3'.$_POST['refGuestbookSeq']
          .'4'. $_POST['toUserId']

          .'5'.$_POST['fromUserId']
          .'6'.$_POST['contents']

          .'7'.$_POST['secretYn']
          .'      
      }';
      mysqli_close($connect);

  }

?>