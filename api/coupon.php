<?php
/*
결과코드
1 : [premium] 광고제거 + 레벨100 쿠폰등록 성공
2 : [removeAd] 광고제거 쿠폰등록 성공
3 : [level100] 레벨 100 쿠폰등록 성공
100 : [APPREVIEW] 앱리뷰 남길 시 지급
101 : [HUMOR] 웃대 프로모션 이벤트, 광고제거 + 레벨30
-1 : isset 공백 에러
-2 : 유효하지 않은 쿠폰번호
-3 : 세션에 없는 유저가 요청을 시도함
-4 : 카운팅이 완료된 키값
-5 : 세션 상 이미 처리 완료한 유저가 재요청을 시도함
 */
$animals = array("crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
    "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer");

$config = parse_ini_file('../config.ini', true);
$db_host = "localhost";
$db_user_name = $config['dbusername'];
$db_name = $config['dbname'];
$db_pw = $config['dbpw'];

$connect = mysqli_connect($db_host, $db_user_name, $db_pw, $db_name);
$db = mysqli_select_db($connect, $db_name) or die('DB Connect failure!!!!');

if ($connect->connect_error) {
    //db커넥션 에러
    die("Connection failed: " . $connect->connect_error);
    return;
}

//쿠폰 유효성 검사
$isRealCoupon = false;
$thisCouponKey = null;
$thisProductId = null;
$totalAmount = 0;
$remainingAmount = 0;

$sql = "select coupon_seq, product_id, total_amount, remaining_amount from COUPON_MST where coupon_key = '".$_GET['couponId']."'";
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_row($result)) {
    $isRealCoupon = true;
    $thisCouponKey = $row[0];
    $thisProductId = $row[1];
    $totalAmount = $row[2];
    $remainingAmount = $row[3];
}

if($isRealCoupon == false){
    echo '{"result": "error", "code" : "-2", "message" : "유효하지 않은 쿠폰번호 입니다."}';
    return;
}

//횟수 체크
if($remainingAmount <= 0){
    echo '{"result": "error", "code" : "-4", "message" : "이용이 종료된 쿠폰번호 입니다."}';
    return;
}

//유저가 로그인했는지 확인
session_start();
if($_SESSION["userId"] == null){
    echo '{"result": "error", "code" : "-3", "message" : "로그인하지 않은 사용자 입니다."}';
    return;
}


//요청한 유저가 이미 사용한 쿠폰인지 체크
$isAlreadyUseUser = false;
$sql = "select history_seq, memo from PREMIUM_HISTORY where user_id = '".$_SESSION["userId"]."'";
//상품코드;;설명;;쿠폰코드;;인코딩코드
$result = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_row($result)) {
    $rowArray = explode(";;", $row[1]);
    if($rowArray[2]==$thisCouponKey){
        $isAlreadyUseUser = true;
        break;
    }
}
if($isAlreadyUseUser == true){
    echo '{"result": "error", "code" : "-5", "message" : "이미 사용한 쿠폰 입니다."}';
    return;
}

/////////////////////////////////
///이하부터 사용 처리 가능///////////
/// /////////////////////////////

//프리미엄유저 쿠폰
if($thisProductId == 1){
    $timestamp = time();
    $animalKey = floor(substr($timestamp, -2) / 10) + substr($timestamp, -1);
    $timestamp = $timestamp + 681248369;
    $timestamp = $timestamp * 2;
    $timestamp = $timestamp - 14325;

    //레벨업처리
    $sql = "select level from USER_MST where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);
    $user_level = 0;
    while ($row = mysqli_fetch_row($result)) {
        $user_level = $row[0];
    }
    $user_level = $user_level + 100;
    $sql = "update USER_MST set status_cd = 'P', update_date = '".date("Y-m-d H:i:s")."', level = '".$user_level."' where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);

    //사용처리
    $sql = "update COUPON_MST set remaining_amount = ".($remainingAmount-1)." where coupon_key = '".$_GET['couponId']."'";
    $result = mysqli_query($connect, $sql);

    //이력남기기
    $sql = "insert into PREMIUM_HISTORY (user_id, memo, created) values ('".$_SESSION["userId"]."', '1;;프리미엄 쿠폰(레벨100 + 광고제거);;".$thisCouponKey.";;".$timestamp.';'.$animals[$animalKey]."','".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($connect, $sql);

    echo '{"result": "success", "code" : "1", "message" : "프리미엄 쿠폰을 사용하였습니다.", "key" : "'.$timestamp.';'.$animals[$animalKey].'"}';
}

else if($thisProductId == 100){
    //레벨업처리
    $sql = "select level from USER_MST where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);
    $user_level = 0;
    while ($row = mysqli_fetch_row($result)) {
        $user_level = $row[0];
    }
    $user_level = $user_level + 20;
    $sql = "update USER_MST set update_date = '".date("Y-m-d H:i:s")."', level = '".$user_level."' where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);

    //사용처리
    $sql = "update COUPON_MST set remaining_amount = ".($remainingAmount-1)." where coupon_key = '".$_GET['couponId']."'";
    $result = mysqli_query($connect, $sql);

    //이력남기기
    $sql = "insert into PREMIUM_HISTORY (user_id, memo, created) values ('".$_SESSION["userId"]."', '100;;앱리뷰;;".$thisCouponKey.";;.','".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($connect, $sql);

    echo '{"result": "success", "code" : "100", "message" : "앱리뷰 쿠폰 적용이 완료 되었습니다.", "key" : ""}';
}

//웃대 프로모션 쿠폰
else if($thisProductId == 101){
    $timestamp = time();
    $animalKey = floor(substr($timestamp, -2) / 10) + substr($timestamp, -1);
    $timestamp = $timestamp + 681248369;
    $timestamp = $timestamp * 2;
    $timestamp = $timestamp - 14325;

    //레벨업처리
    $sql = "select level from USER_MST where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);
    $user_level = 0;
    while ($row = mysqli_fetch_row($result)) {
        $user_level = $row[0];
    }
    $user_level = $user_level + 30;
    $sql = "update USER_MST set update_date = '".date("Y-m-d H:i:s")."', level = '".$user_level."' where user_id = '".$_SESSION["userId"]."'";
    $result = mysqli_query($connect, $sql);

    //사용처리
    $sql = "update COUPON_MST set remaining_amount = ".($remainingAmount-1)." where coupon_key = '".$_GET['couponId']."'";
    $result = mysqli_query($connect, $sql);

    //이력남기기
    $sql = "insert into PREMIUM_HISTORY (user_id, memo, created) values ('".$_SESSION["userId"]."', '1;;프리미엄 쿠폰(레벨30 + 광고제거);;".$thisCouponKey.";;".$timestamp.';'.$animals[$animalKey]."','".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($connect, $sql);

    echo '{"result": "success", "code" : "1", "message" : "프리미엄 쿠폰을 사용하였습니다.", "key" : "'.$timestamp.';'.$animals[$animalKey].'"}';
}

/*
  if($_GET['couponId'] == 'taeho'){
      $timestamp = time();
      $animalKey = floor(substr($timestamp, -2) / 10) + substr($timestamp, -1);
      $timestamp = $timestamp + 681248369;
      $timestamp = $timestamp * 2;
      $timestamp = $timestamp - 14325;



      echo '{"result": "success", "code" : "1", "message" : "프리미엄 쿠폰을 사용하였습니다.", "key" : "'.$timestamp.';'.$animals[$animalKey].'"}';
  }
  else{
      echo '{"result": "error", "code" : "-2", "message" : "유효하지 않은 쿠폰번호 입니다."}';
  }
*/

?>