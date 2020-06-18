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

session_start();
$myId = '';
$resultJson = '';
if($_SESSION['userId'] == null && $_SESSION["tmpUserId"] == null){
    echo '{"result": "error", "code": "-1", "message": "session이 없는 사용자 입니다."}';
    return;

} else{
    if($_SESSION['userId'] == null)
        $myId = $_SESSION['tmpUserId'];
    else
        $myId = $_SESSION['userId'];
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

//JSON 첫부분 생성
$resultJson = '{
                 "result":"success",
                 "code":"1",
                 "mydata":[';

//나의 리스트부터 조회합니다..
$sql = "select personallist.store_id, personallist.store_name, personallist.category, personallist.telephone, personallist.address, personallist.roadaddress, personallist.lon, personallist.lat, personallist.cnt, personallist.ratingav, personallist.review_seq, personallist.rating, personallist.review, personallist.visit_yn, IFNULL(personaltag.taglist,'') as taglist, personallist.created
        from 
              ( 
              select store.store_id, store.store_name, store.category, store.telephone, store.address, store.roadaddress, store.lon, store.lat, calcul.cnt, calcul.ratingav, review.review_seq, review.rating, review.review, review.visit_yn, review.created
              from  STORE_MST store, REVIEW_MST review, 
                      (SELECT store_id, COUNT(store_id) AS cnt, AVG(rating) AS ratingav FROM REVIEW_MST Group by store_id) calcul 
              where store.store_id = review.store_id and store.store_id = calcul.store_id and review.del_yn != 'Y' and review.user_id = '".mysqli_real_escape_string($connect, $myId)."' ) personallist 
        left join 
             (SELECT review_seq, GROUP_CONCAT(tag_code SEPARATOR ',') AS taglist FROM REVIEW_TAG GROUP BY review_seq) personaltag 
        on 
            personallist.review_seq = personaltag.review_seq ORDER BY personallist.created DESC";
$result = mysqli_query($connect, $sql);
$flagMy = false;
while ($row = mysqli_fetch_row($result)) {
    $flagMy = true;
    $resultJson = $resultJson.'{';
    $resultJson = $resultJson.'"store_id":"'.$row[0].'",';
    $resultJson = $resultJson.'"store_name":"'.$row[1].'",';
    $resultJson = $resultJson.'"category":"'.$row[2].'",';
    $resultJson = $resultJson.'"telephone":"'.$row[3].'",';
    $resultJson = $resultJson.'"address":"'.$row[4].'",';
    $resultJson = $resultJson.'"roadaddress":"'.$row[5].'",';
    $resultJson = $resultJson.'"lon":"'.$row[6].'",';
    $resultJson = $resultJson.'"lat":"'.$row[7].'",';
    $resultJson = $resultJson.'"cnt":"'.$row[8].'",';
    $resultJson = $resultJson.'"ratingav":"'.$row[9].'",';
    $resultJson = $resultJson.'"review_seq":"'.$row[10].'",';
    $resultJson = $resultJson.'"rating":"'.$row[11].'",';
    $resultJson = $resultJson.'"review":"'.$row[12].'",';
    $resultJson = $resultJson.'"visit_yn":"'.$row[13].'",';
    $resultJson = $resultJson.'"taglist":"'.$row[14].'"},';

}
if($flagMy)
    $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거

//JSON 중간 생성
$resultJson = $resultJson.'],
                          "othersdata":[';

    $sql = "select distinct store.store_id, store.store_name, store.category, store.telephone, store.address, store.roadaddress, store.lon, store.lat, calcul.cnt, calcul.ratingav, review.review_seq
            from STORE_MST store, REVIEW_MST review,
                   (SELECT store_id, COUNT(store_id) AS cnt, AVG(rating) AS ratingav  FROM REVIEW_MST Group by store_id) calcul
            where store.store_id = review.store_id and review.visit_yn = 'Y' and store.store_id = calcul.store_id and review.user_id != '".mysqli_real_escape_string($connect, $myId)."' ORDER BY review.created DESC LIMIT 1000;";
$result = mysqli_query($connect, $sql);
$flagOthers = false;
while ($row = mysqli_fetch_row($result)) {
    $flagOthers = true;
    $resultJson = $resultJson.'{';
    $resultJson = $resultJson.'"store_id":"'.$row[0].'",';
    $resultJson = $resultJson.'"store_name":"'.$row[1].'",';
    $resultJson = $resultJson.'"category":"'.$row[2].'",';
    $resultJson = $resultJson.'"telephone":"'.$row[3].'",';
    $resultJson = $resultJson.'"address":"'.$row[4].'",';
    $resultJson = $resultJson.'"roadaddress":"'.$row[5].'",';
    $resultJson = $resultJson.'"lon":"'.$row[6].'",';
    $resultJson = $resultJson.'"lat":"'.$row[7].'",';
    $resultJson = $resultJson.'"cnt":"'.$row[8].'",';
    $resultJson = $resultJson.'"ratingav":"'.$row[9].'",';
    $resultJson = $resultJson.'"review_seq":"'.$row[10].'"},';
}
if($flagOthers)
    $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거

///
//친구들
$resultJson = $resultJson.'],
                          "friendsdata":[';

$sql = "select distinct store.store_id, store.store_name, store.category, store.telephone, store.address, store.roadaddress, store.lon, store.lat, calcul.cnt, calcul.ratingav, review.review_seq
            from STORE_MST store, REVIEW_MST review,
                   (SELECT store_id, COUNT(store_id) AS cnt, AVG(rating) AS ratingav  FROM REVIEW_MST Group by store_id) calcul
            where store.store_id = review.store_id and review.visit_yn = 'Y' and store.store_id = calcul.store_id and review.user_id IN (SELECT friend_id from FRIENDS where user_id = '".mysqli_real_escape_string($connect, $myId)."') ORDER BY review.created DESC LIMIT 1000;";
$result = mysqli_query($connect, $sql);
$flagFriends = false;
while ($row = mysqli_fetch_row($result)) {
    $flagFriends = true;
    $resultJson = $resultJson.'{';
    $resultJson = $resultJson.'"store_id":"'.$row[0].'",';
    $resultJson = $resultJson.'"store_name":"'.$row[1].'",';
    $resultJson = $resultJson.'"category":"'.$row[2].'",';
    $resultJson = $resultJson.'"telephone":"'.$row[3].'",';
    $resultJson = $resultJson.'"address":"'.$row[4].'",';
    $resultJson = $resultJson.'"roadaddress":"'.$row[5].'",';
    $resultJson = $resultJson.'"lon":"'.$row[6].'",';
    $resultJson = $resultJson.'"lat":"'.$row[7].'",';
    $resultJson = $resultJson.'"cnt":"'.$row[8].'",';
    $resultJson = $resultJson.'"ratingav":"'.$row[9].'",';
    $resultJson = $resultJson.'"review_seq":"'.$row[10].'"},';
}
if($flagFriends)
    $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거

///

//JSON 끝 생성
$resultJson = $resultJson.']}';
echo $resultJson;

mysqli_close($connect);

?>