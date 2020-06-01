<?php

/*
결과코드
1 : 임시유저 가입 정상 message에 id발급
2 : 유저 가입 정상
-100 : 존재하지 않는 식당임...
-1 : isset 공백 에러
 */


/*
 * 샘플데이터 입니다
{
"result":"success",
"code":"1",
"storeId":"1574833588",
"storeName":"도안",
"category":"음식점 > 카페",
"telephone":"070-8884-1204",
"address":"경기 수원시 팔달구 인계동 1118-7",
"roadaddress":"경기 수원시 팔달구 효원로307번길 61",
"reviewCnt":"3",
"bookmarkCnt":"0",
"score":"4.333333333333333",
"reviewData":[
    {
    "userId":"테스트3",
    "storeId":"1574833588",
    "rating":"5",
    "review":"카공하기 조아여55",
    "visitYn":"Y",
    "taglist":"",
    "created":"2020-03-16 14:57:15",
    "avatar" : "1"
    },
    {
    "userId":"테스트",
    "storeId":"1574833588",
    "rating":"5",
    "review":"",
    "visitYn":"Y",
    "taglist":"",
    "created":"2020-03-15 19:17:15"
    },
    {
    "userId":"테스트2",
    "storeId":"1574833588",
    "rating":"3",
    "review":"맛난당",
    "visitYn":"Y",
    "taglist":"2,5,1",
    "created":"2020-03-12 00:52:33"
    }
]
}
 */

$config = parse_ini_file('../config.ini', true);
$db_host = "localhost";
$db_user_name = $config['dbusername'];
$db_name = $config['dbname'];
$db_pw = $config['dbpw'];

$resultJson = "";


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


    //식당 리뷰리스트를 반환합니다
    $resultJson = $resultJson.'"reviewData" : [';
    $sql = "SELECT review_info.*, user_mst.avatar FROM
(select personallist.user_id, personallist.store_id, personallist.rating, personallist.review, personallist.visit_yn, IFNULL(personaltag.taglist,'') as taglist, personallist.created, personallist.store_name
        from 
              ( 
              select store.store_id, review.user_id, review.review_seq, review.rating, review.review, review.visit_yn, review.created, store.store_name
              from  STORE_MST store, REVIEW_MST review
              where store.store_id = review.store_id and review.del_yn != 'Y'  and review.visit_yn = 'Y') personallist 
        left join 
             (SELECT review_seq, GROUP_CONCAT(tag_code SEPARATOR ',') AS taglist FROM REVIEW_TAG GROUP BY review_seq) personaltag 
        on 
            personallist.review_seq = personaltag.review_seq ORDER BY personallist.created DESC) review_info, USER_MST user_mst WHERE review_info.user_id = user_mst.user_id and user_mst.level > 0 ORDER BY review_info.created DESC LIMIT 100;";
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
        $resultJson = $resultJson.'"created" : "'.$row[6].'", ';
        $resultJson = $resultJson.'"storeName" : "'.$row[7].'", ';
        $resultJson = $resultJson.'"avatar" : "'.$row[8].'"},';
    }
    if($flag){
        $resultJson = substr($resultJson , 0, -1); //마지막 콤마 제거
    }
    $resultJson = $resultJson.'] }';


    echo $resultJson;


?>