<?php

/*
결과코드
1 : 정상
100 : 이미 찜하기 됨, 바로 리턴
101 : 찜하려는데 이미 리뷰됨, 바로 리턴
102 : 리뷰하려는데 이미 찜, 업데이트 처리
103 : 리뷰하려는데 이미 리뷰, 업데이트 처리
-1 : isset 공백 에러
-5000 : 로그인 안되어 있음

 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];

  //sql인젝션 방지
  if (isset($_POST['storeId']) && isset($_POST['visitYn']) && isset($_POST['rating']) && isset($_POST['review']) && isset($_POST['tags']) ) {

      //유저 인증
      session_start();
      $LOGIN_USER_ID = '';
      if($_SESSION['userId'] == null && $_SESSION['tmpUserId' == null]){
          echo '{"result": "error", "code": "-5000", "message": "이 기능은 로그인이 필요합니다. 현재 서버에 로그인된 상태가 아닙니다."}';
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


    // ON일 경우 magic_quotes_gpc/magic_quotes_sybase 효과 제거
    if(get_magic_quotes_gpc()) {
        $store_id = stripslashes($_POST['storeId']);
        $visit_yn = stripslashes($_POST['visitYn']);
        $rating = stripslashes($_POST['rating']);
        $review = stripslashes($_POST['review']);
        $tags = stripslashes($_POST['tags']);
    } else {
        $store_id        = $_POST['storeId'];
        $visit_yn = $_POST['visitYn'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        $tags = $_POST['tags'];
    }

    /////////////이미 평가한 집인지 또는 찜했던 것을 업데이트 하는 것인지 확인
    $returnMsg = "";
    $updateToReviewFromBookmark = false;
    $updateToReviewFromReview = false;
    $reviewSeqForUpdate = '';


    $sql = "select visit_yn, del_yn, review_seq from REVIEW_MST where user_id='".mysqli_real_escape_string($connect, $LOGIN_USER_ID)."' and store_id='".$store_id."' and del_yn = 'N'";
    $result = mysqli_query($connect, $sql);
    while($row = mysqli_fetch_row($result)){
      if($row[1]=='Y')
        break;//삭제된 데이터면 그냥 새로 insert할수 있도록 pass

        //찜하려는데 이미 찜
        if($row[0]=='N' && $visit_yn == 'N') {//방문했을 경우 이 경우 INSERT대신 REPLACE사용
            $returnMsg = "{\"result\": \"success\", \"code\": \"100\", \"message\": \"이미 찜하기로 등록하였습니다.\"}";
            echo $returnMsg;
            return;
        }

        //찜하려는데 이미 리뷰
        else if($row[0]=='Y' && $visit_yn == 'N') {

            $returnMsg = "{\"result\": \"success\", \"code\": \"101\", \"message\": \"이미 리뷰하였습니다.\"}";
            echo $returnMsg;
            return;

        }
        //리뷰하려는데 이미 찜
        else if($row[0]=='N' && $visit_yn == 'Y') {
            $updateToReviewFromBookmark = true;
            $reviewSeqForUpdate = $row[2];
            $returnMsg = "{\"result\": \"success\", \"code\": \"102\", \"message\": \"이미 찜하였습니다. 업데이트 처리합니다..".$reviewSeqForUpdate."\"}";
            //echo $returnMsg;
        }
        //리뷰하려는데 이미 리뷰
        else{
            $updateToReviewFromReview = true;
            $reviewSeqForUpdate = $row[2];
            $returnMsg = "{\"result\": \"success\", \"code\": \"103\", \"message\": \"이미 리뷰 하였습니다. 업데이트 처리 합니다..\"}";

        }

    }

    /////////////데이터 insert 시작

    if(!$updateToReviewFromBookmark && !$updateToReviewFromReview) {
        $bookMarkRating = $rating;
        if($visit_yn == 'N')
            $bookMarkRating = null;

        $sql = "insert into REVIEW_MST (user_id, store_id, visit_yn, del_yn, rating, review, created, updated) values ";
        $sql = $sql."('".mysqli_real_escape_string($connect, $LOGIN_USER_ID)."', '".mysqli_real_escape_string($connect, $store_id)."', '".mysqli_real_escape_string($connect, $visit_yn)."', 'N', '".mysqli_real_escape_string($connect, $bookMarkRating)."', '".mysqli_real_escape_string($connect, $review)."', '".date("Y-m-d H:i:s"). "', '".date("Y-m-d H:i:s")."');";

        //질의 전송
        $result = mysqli_query($connect, $sql);

        //ID값 가져오자
        $sql = "SELECT LAST_INSERT_ID();";
        $result = mysqli_query($connect, $sql);
        $autoIncreasedId = '';
        while($row = mysqli_fetch_row($result)){
            $autoIncreasedId = $row[0];
            break;
        }

        //태그정보 입력
        $tags_arr = explode(',', $tags);
        $sql = "insert into REVIEW_TAG (review_seq, tag_code) values ";
        for($i=0; $i < count($tags_arr); $i++){
            if($tags_arr[$i] != null && $tags_arr[$i] != '') {
                $sql = $sql . "(" . $reviewSeqForUpdate . "," . $tags_arr[$i] . ")";
                if ($i < (count($tags_arr) - 1))
                    $sql = $sql . ",";
            }
        }
        $result = mysqli_query($connect, $sql);

        //$fields = mysql_num_fields($result);
        mysqli_close($connect);
        $returnMsg = "{\"result\": \"success\", \"code\": \"1\", \"message\": \"등록하였습니다.\"}";
        echo $returnMsg;
        //while($row = mysql_fetch_row($result)){
        //  echo $row[0].$row[1].$row[2];
        //}
    }
    else if($updateToReviewFromBookmark){
        $sql = "update REVIEW_MST set visit_yn = 'Y', rating = '".$rating."', review = '".$review."', updated = '".date("Y-m-d H:i:s")."' where review_seq = ".$reviewSeqForUpdate.";";

        //질의 전송
        $result = mysqli_query($connect, $sql);

        //태그정보 초기화
        $sql = "delete from REVIEW_TAG where review_seq = '".$reviewSeqForUpdate."' ";
        $result = mysqli_query($connect, $sql);
        //태그정보 입력
        $tags_arr = explode(',', $tags);
        $sql = "insert into REVIEW_TAG (review_seq, tag_code) values ";
        for($i=0; $i < count($tags_arr); $i++){
            if($tags_arr[$i] != null && $tags_arr[$i] != '') {
                $sql = $sql . "(" . $reviewSeqForUpdate . "," . $tags_arr[$i] . ")";
                if ($i < (count($tags_arr) - 1))
                    $sql = $sql . ",";
            }
        }
        $result = mysqli_query($connect, $sql);

        mysqli_close($connect);
        //$returnMsg = "{\"result\": \"success\", \"code\": \"102\", \"message\": \"이미 찜하였습니다. 업데이트 처리합니다..2345".$reviewSeqForUpdate."\"}";

        echo $returnMsg;

    }
    else if($updateToReviewFromReview){
        $sql = "update REVIEW_MST set rating = '".$rating."', review = '".$review."', updated = '".date("Y-m-d H:i:s")."' where review_seq = ".$reviewSeqForUpdate.";";

        //질의 전송
        $result = mysqli_query($connect, $sql);

        //태그정보 초기화
        $sql = "delete from REVIEW_TAG where review_seq = '".$reviewSeqForUpdate."' ";
        $result = mysqli_query($connect, $sql);
        //태그정보 입력
        $tags_arr = explode(',', $tags);
        $sql = "insert into REVIEW_TAG (review_seq, tag_code) values ";
        for($i=0; $i < count($tags_arr); $i++){
            if($tags_arr[$i] != null && $tags_arr[$i] != '') {
                $sql = $sql . "(" . $reviewSeqForUpdate . "," . $tags_arr[$i] . ")";
                if ($i < (count($tags_arr) - 1))
                    $sql = $sql . ",";
            }
        }
        $result = mysqli_query($connect, $sql);

        mysqli_close($connect);
        echo $returnMsg;

    }
  }
  else{
    //비어있는 post데이터가 있음
    echo '{"result": "error", "code": "-1", "message": "empty data"}';
  }


?>
