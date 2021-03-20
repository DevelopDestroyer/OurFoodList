<?php
/*
결과코드
1 : 광고제거 + 레벨100 프리미엄 성공
2 : 광고제거 프리미엄 성공
3 : 레벨 100 프리미엄 성공
-1 : isset 공백 에러
-2 : 유효하지 않은 쿠폰번호
-3 : 세션에 없는 유저가 요청을 시도함
-4 : 유효하지 않은 키값
-5 : 세션 상 이미 처리 완료한 유저가 재요청을 시도함
 */
$config = parse_ini_file('../config.ini', true);
$db_host = "localhost";
$db_user_name = $config['dbusername'];
$db_name = $config['dbname'];
$db_pw = $config['dbpw'];

$animals = array("crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
    "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer");

$timestamp = time();
$param = explode(";", $_GET['code']);
$decTime = $param[0] + 14325;
$decTime = floor($decTime / 2);
$decTime = $decTime - 681248369;

$animalCodeFlag = false;
$animalKey = floor(substr($decTime, -2) / 10) + substr($decTime, -1);
for($i = 0; $i < 20; $i++){
    if($param[1] == $animals[$animalKey] &&
        $animalKey == $i){
        $animalCodeFlag = true;
        break;
    }
}

if($timestamp < $decTime + 120 &&
    $timestamp > $decTime - 120 &&
    $animalCodeFlag == true
){
    session_start();
    $targetId = null;
    if($_SESSION["userId"] != null){
        $targetId = $_SESSION["userId"];
    }
    else if($_GET['targetUserId'] != null) {
        $targetId = $_GET['targetUserId'];
    }

    if($_SESSION["userId"] == null && $_GET['targetUserId'] == null){
        echo '{"result": "error", "code" : "-3", "message" : "로그인이 안된 유저 입니다."}';
    }
    else if ($_SESSION["premium_code"] != null &&
        $decTime == $_SESSION["premium_code"]){
        echo '{"result": "error", "code" : "-5", "message" : "이미 처리된 건 입니다."}';
    }
    else {
        $_SESSION["premium_code"] = $decTime;
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
        $sql = "select level from USER_MST where user_id = '".$targetId."'";
        $result = mysqli_query($connect, $sql);
        $user_level = 0;
        while ($row = mysqli_fetch_row($result)) {
            $user_level = $row[0];
        }
        $user_level = $user_level + 100;
        $sql = "update USER_MST set status_cd = 'P', update_date = '".date("Y-m-d H:i:s")."', level = '".$user_level."' where user_id = '".$targetId."'";
        $result = mysqli_query($connect, $sql);

        //상품코드;;설명;;코드원본;;디코드코드
        $sql = "insert into PREMIUM_HISTORY (user_id, memo, created) values ('".$targetId."', '0;;프리미엄(광고제거, 레벨+100) 결제 완료;;".$_GET['code'].";;".$decTime."', '".date("Y-m-d H:i:s")."')";
        $result = mysqli_query($connect, $sql);

        echo '{"result": "success", "code" : "1", "message" : "프리미엄 회원이 되신 것을 환영합니다."}';
    }
}
else{
    echo '{"result": "error", "code" : "-2", "message" : "유효하지 않은 요청 입니다."}';
}


?>