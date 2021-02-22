<?php
/*
결과코드
1 : 광고제거 + 레벨100 쿠폰등록 성공
2 : 광고제거 쿠폰등록 성공
3 : 레벨 100 쿠폰등록 성공
-1 : isset 공백 에러
-2 : 유효하지 않은 쿠폰번호
-3 : 세션에 없는 유저가 요청을 시도함
-4 : 유효하지 않은 키값
-5 : 세션 상 이미 처리 완료한 유저가 재요청을 시도함
 */
$animals = array("crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
    "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer");

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

?>