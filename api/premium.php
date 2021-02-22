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
    echo '{"result": "success", "code" : "1", "message" : "프리미엄 회원이 되신 것을 환영합니다."}';
}
else{
    echo '{"result": "error", "code" : "-2", "message" : "유효하지 않은 요청 입니다."}';
}


?>