<?php

/*
결과코드
1 : 내 프로필
2 : 다른이의 프로필
-1 : isset 공백 에러
-2 : 세션이 없는데 마이페이지 형태로 접근
 */

  $config = parse_ini_file('../config.ini', true);
  $db_host = "localhost";
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];
  $resultJsonData = '';

  //sql인젝션 방지
  if (isset($_GET['userId'])) {
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
          $userId = stripslashes($_GET['userId']);

      } else {
          $userId = $_GET['userId'];
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

      //_my일 경우 ID처리
      if($userId == '_my' && $myId != null){
          $sql = "SELECT user_id, level, avatar FROM USER_MST WHERE user_id = '".$myId."';";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_row($result)) {
              $userId = $row[0];
              $resultJsonData .= '"myId": "'.$row[0].'", ';
              $resultJsonData .= '"userId": "'.$row[0].'", ';
              $resultJsonData .= '"userLevel": "'.$row[1].'", ';
              $resultJsonData .= '"userAvatar": "'.$row[2].'", ';
              break;
          }
      }
      else if($userId == '_my' && $myId == null){
          echo '{"result": "error", "code": "-2", "message": "로그인이 필요한 서비스 입니다."}';
          mysqli_close($connect);
      }
      else{
          $sql = "SELECT user_id, level, avatar FROM USER_MST WHERE user_id = '".$userId."';";
          $result = mysqli_query($connect, $sql);
          while ($row = mysqli_fetch_row($result)) {
              $userId = $row[0];
              if($myId == null)
                  $resultJsonData .= '"myId": "_tmpId", ';
              else
                  $resultJsonData .= '"myId": "'.$myId.'", ';
              $resultJsonData .= '"userId": "'.$row[0].'", ';
              $resultJsonData .= '"userLevel": "'.$row[1].'", ';
              $resultJsonData .= '"userAvatar": "'.$row[2].'", ';
              break;
          }
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
      $sql = "SELECT a.user_id, a.friend_id, b.level, b.avatar FROM FRIENDS a, USER_MST b WHERE a.user_id = '".$userId."' AND a.friend_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData .= '{"id": "'.$row[1].'", "level" : "'.$row[2].'", "avatar" : "'.$row[3].'"},';
      }
      if($flagMy)
          $resultJsonData = substr($resultJsonData , 0, -1); //마지막 콤마 제거
      $resultJsonData .= '],';

      //이 사람의 팔로워 리스트
      $resultJsonData .= '"follower": ['; //이사람을 친추한 사람들
      $sql = "SELECT a.user_id, a.friend_id, b.level, b.avatar FROM FRIENDS a, USER_MST b WHERE a.friend_id = '".$userId."' AND a.user_id = b.user_id;";
      $result = mysqli_query($connect, $sql);
      $flagMy = false;
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData .= '{"id": "'.$row[0].'", "level" : "'.$row[2].'", "avatar" : "'.$row[3].'"},';
      }
      if($flagMy)
          $resultJsonData = substr($resultJsonData , 0, -1); //마지막 콤마 제거
      $resultJsonData .= '],';



//리뷰데이터
      $resultJsonData .= '"reviewData": ['; //이사람이 친추한 사람들
      $sql = "select personallist.store_id, personallist.store_name, personallist.category, personallist.telephone, personallist.address, personallist.roadaddress, personallist.lon, personallist.lat, personallist.cnt, personallist.ratingav, personallist.review_seq, personallist.rating, personallist.review, personallist.visit_yn, IFNULL(personaltag.taglist,'') as taglist, personallist.created
        from 
              ( 
              select store.store_id, store.store_name, store.category, store.telephone, store.address, store.roadaddress, store.lon, store.lat, calcul.cnt, calcul.ratingav, review.review_seq, review.rating, review.review, review.visit_yn, review.created
              from  STORE_MST store, REVIEW_MST review, 
                      (SELECT store_id, COUNT(store_id) AS cnt, AVG(rating) AS ratingav FROM REVIEW_MST Group by store_id) calcul 
              where store.store_id = review.store_id and store.store_id = calcul.store_id and review.del_yn != 'Y' and review.visit_yn = 'Y' and review.user_id = '".$userId."' ) personallist 
        left join 
             (SELECT review_seq, GROUP_CONCAT(tag_code SEPARATOR ',') AS taglist FROM REVIEW_TAG GROUP BY review_seq) personaltag 
        on 
            personallist.review_seq = personaltag.review_seq ORDER BY personallist.created DESC";
      $result = mysqli_query($connect, $sql);
      $flagMy = false;
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData = $resultJsonData.'{';
          $resultJsonData = $resultJsonData.'"store_id":"'.$row[0].'",';
          $resultJsonData = $resultJsonData.'"store_name":"'.$row[1].'",';
          $resultJsonData = $resultJsonData.'"category":"'.$row[2].'",';
          $resultJsonData = $resultJsonData.'"telephone":"'.$row[3].'",';
          $resultJsonData = $resultJsonData.'"address":"'.$row[4].'",';
          $resultJsonData = $resultJsonData.'"roadaddress":"'.$row[5].'",';
          $resultJsonData = $resultJsonData.'"lon":"'.$row[6].'",';
          $resultJsonData = $resultJsonData.'"lat":"'.$row[7].'",';
          $resultJsonData = $resultJsonData.'"cnt":"'.$row[8].'",';
          $resultJsonData = $resultJsonData.'"ratingav":"'.$row[9].'",';
          $resultJsonData = $resultJsonData.'"review_seq":"'.$row[10].'",';
          $resultJsonData = $resultJsonData.'"rating":"'.$row[11].'",';
          $resultJsonData = $resultJsonData.'"review":"'.$row[12].'",';
          $resultJsonData = $resultJsonData.'"visit_yn":"'.$row[13].'",';
          $resultJsonData = $resultJsonData.'"taglist":"'.$row[14].'"},';

      }
      if($flagMy)
          $resultJsonData = substr($resultJsonData , 0, -1); //마지막 콤마 제거

//JSON 중간 생성
      $resultJsonData = $resultJsonData.'],';



//찜데이터
      $resultJsonData .= '"bookmarkData": ['; //이사람이 친추한 사람들
      $sql = "select personallist.store_id, personallist.store_name, personallist.category, personallist.telephone, personallist.address, personallist.roadaddress, personallist.lon, personallist.lat, personallist.cnt, personallist.ratingav, personallist.review_seq, personallist.rating, personallist.review, personallist.visit_yn, IFNULL(personaltag.taglist,'') as taglist, personallist.created
        from 
              ( 
              select store.store_id, store.store_name, store.category, store.telephone, store.address, store.roadaddress, store.lon, store.lat, calcul.cnt, calcul.ratingav, review.review_seq, review.rating, review.review, review.visit_yn, review.created
              from  STORE_MST store, REVIEW_MST review, 
                      (SELECT store_id, COUNT(store_id) AS cnt, AVG(rating) AS ratingav FROM REVIEW_MST Group by store_id) calcul 
              where store.store_id = review.store_id and store.store_id = calcul.store_id and review.del_yn != 'Y' and review.visit_yn = 'N' and review.user_id = '".$userId."' ) personallist 
        left join 
             (SELECT review_seq, GROUP_CONCAT(tag_code SEPARATOR ',') AS taglist FROM REVIEW_TAG GROUP BY review_seq) personaltag 
        on 
            personallist.review_seq = personaltag.review_seq ORDER BY personallist.created DESC";
      $result = mysqli_query($connect, $sql);
      $flagMy = false;
      while ($row = mysqli_fetch_row($result)) {
          $flagMy = true;
          $resultJsonData = $resultJsonData.'{';
          $resultJsonData = $resultJsonData.'"store_id":"'.$row[0].'",';
          $resultJsonData = $resultJsonData.'"store_name":"'.$row[1].'",';
          $resultJsonData = $resultJsonData.'"category":"'.$row[2].'",';
          $resultJsonData = $resultJsonData.'"telephone":"'.$row[3].'",';
          $resultJsonData = $resultJsonData.'"address":"'.$row[4].'",';
          $resultJsonData = $resultJsonData.'"roadaddress":"'.$row[5].'",';
          $resultJsonData = $resultJsonData.'"lon":"'.$row[6].'",';
          $resultJsonData = $resultJsonData.'"lat":"'.$row[7].'",';
          $resultJsonData = $resultJsonData.'"cnt":"'.$row[8].'",';
          $resultJsonData = $resultJsonData.'"ratingav":"'.$row[9].'",';
          $resultJsonData = $resultJsonData.'"review_seq":"'.$row[10].'",';
          $resultJsonData = $resultJsonData.'"rating":"'.$row[11].'",';
          $resultJsonData = $resultJsonData.'"review":"'.$row[12].'",';
          $resultJsonData = $resultJsonData.'"visit_yn":"'.$row[13].'",';
          $resultJsonData = $resultJsonData.'"taglist":"'.$row[14].'"},';

      }
      if($flagMy)
          $resultJsonData = substr($resultJsonData , 0, -1); //마지막 콤마 제거

      $resultJsonData = $resultJsonData.']';




      $resultJsonData .= '}';
      echo $resultJsonData;
      mysqli_close($connect);

  }
  else{
      //비어있는 post데이터가 있음

      echo '{"result": "error", "code": "-1", "message": "empty data"}';
      mysqli_close($connect);

  }

?>