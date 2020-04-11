<?php

/*
결과코드
1 : 임시유저 가입 정상 message에 id발급
2 : 유저 가입 정상
-100 : 존재하지 않는 식당임...
-1 : isset 공백 에러
 */

$config = parse_ini_file('../config.ini', true);
$db_host = "localhost";
$db_user_name = $config['dbusername'];
$db_name = $config['dbname'];
$db_pw = $config['dbpw'];

$resultJson = "";

//sql인젝션 방지
if (isset($_GET['restaurantId'])) {

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
        $restaurantId = stripslashes($_GET['restaurantId']);
    } else {
        $restaurantId = $_GET['restaurantId'];
    }


    $resultJson = '{"result": "success", "code": "1", ';

    //식당 상제 정보를 조회 합니다.. 만약 데이터가 없을 시 에러를 반환 합니다.
    $sql = "SELECT store_id, store_name, category, telephone, address, roadaddress FROM STORE_MST WHERE store_id = '".$restaurantId."';";
    $result = mysqli_query($connect, $sql);
    $flag = false;
    while ($row = mysqli_fetch_row($result)) {
        $flag = true;
        $resultJson = $resultJson.'"storeId" : "'.$row[0].'" ,';
        $resultJson = $resultJson.'"storeName" : "'.$row[1].'" ,';
        $resultJson = $resultJson.'"category" : "'.$row[2].'" ,';
        $resultJson = $resultJson.'"telephone" : "'.$row[3].'" ,';
        $resultJson = $resultJson.'"address" : "'.$row[4].'" ,';
        $resultJson = $resultJson.'"roadaddress" : "'.$row[5].'", ';
        break;
    }
    if($flag == false){
        echo '{"result": "error", "code": "-100", "message": "존재하지 않는 식당 입니다."}';
        return;
    }

    //식당 리뷰 개수를 반환 합니다.
    $sql = "SELECT count(*) FROM REVIEW_MST WHERE store_id = '".$restaurantId."' AND visit_yn = 'Y' AND del_yn= 'N';";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $flag = true;
        $resultJson = $resultJson.'"reviewCnt" : "'.$row[0].'", ';
        break;
    }

    //식당 찜 개수를 반환 합니다.
    $sql = "SELECT count(*) FROM REVIEW_MST WHERE store_id = '".$restaurantId."' AND visit_yn = 'N' AND del_yn= 'N';";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $resultJson = $resultJson.'"bookmarkCnt" : "'.$row[0].'", ';
        break;
    }

    //식당 평균점수를 반환합니다.
    $sql = "SELECT IFNULL(AVG(rating), 0) FROM REVIEW_MST WHERE store_id = '".$restaurantId."' AND visit_yn = 'Y' AND del_yn= 'N';";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_row($result)) {
        $resultJson = $resultJson.'"score" : "'.$row[0].'", ';
        break;
    }

    //식당 리뷰리스트를 반환합니다
    $resultJson = $resultJson.'"reviewData" : [';
    $sql = "select personallist.user_id, personallist.store_id, personallist.rating, personallist.review, personallist.visit_yn, IFNULL(personaltag.taglist,'') as taglist, personallist.created
        from 
              ( 
              select store.store_id, review.user_id, review.review_seq, review.rating, review.review, review.visit_yn, review.created
              from  STORE_MST store, REVIEW_MST review
              where store.store_id = review.store_id and review.del_yn != 'Y'  and review.visit_yn = 'Y' and review.store_id = '".$restaurantId."' ) personallist 
        left join 
             (SELECT review_seq, GROUP_CONCAT(tag_code SEPARATOR ',') AS taglist FROM REVIEW_TAG GROUP BY review_seq) personaltag 
        on 
            personallist.review_seq = personaltag.review_seq ORDER BY personallist.created DESC";
    $result = mysqli_query($connect, $sql);
    $flag = false;
    while ($row = mysqli_fetch_row($result)) {
        $flag = true;
        $resultJson = $resultJson.'{"userId" : "'.$row[0].'", ';
        $resultJson = $resultJson.'"storeId" : "'.$row[1].'", ';
        $resultJson = $resultJson.'"rating" : "'.$row[2].'", ';
        $resultJson = $resultJson.'"review" : "'.$row[3].'", ';
        $resultJson = $resultJson.'"visitYn" : "'.$row[4].'", ';
        $resultJson = $resultJson.'"taglist" : "'.$row[5].'", ';
        $resultJson = $resultJson.'"created" : "'.$row[6].'"},';
    }
    if($flag){
        $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거
    }
    $resultJson = $resultJson.'] }';


    //비어있는 get데이터가 있음

}
else{
    //비어있는 get데이터가 있음
    echo '{"result": "error", "code": "-1", "message": "empty data"}';
}

?>