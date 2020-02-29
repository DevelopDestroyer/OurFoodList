<?php
  $config = parse_ini_file('../config.ini', true);

  $client_id = $config['naverSearchClientId'];
  $client_secret = $config['naverSearchSecret'];

  $encText = urlencode($_GET['keyword']); //검색할 Text를 url인코딩
 
  /*요청 변수(query, display, start, sort... 네이버 참고)
    json ver: https://openapi.naver.com/v1/search/book.json?...
    xml ver : https://openapi,naver.com/v1/search/book.xml?...
  */
  $url = "https://openapi.naver.com/v1/search/local.json?query=".$encText;
 
//  $url = "https://openapi.naver.com/v1/search/blog.xml?query=".$encText; // xml 결과
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "X-Naver-Client-Id: ".$client_id;
  $headers[] = "X-Naver-Client-Secret: ".$client_secret;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  //echo "status_code:".$status_code."";
  curl_close ($ch);
  if($status_code == 200) {
	str_replace("<b>", "", $response); 
    str_replace("</b>", "", $response);
    echo $response;
  } else {
//    echo "Error 내용:".$response;
	echo '{"lastBuildDate": "Thu, 09 Jan 2020 23:36:34 +0900","total": 12820,"start": 1,"display": 10,"items": [{"title": "네트워크에 문제가 있는 것 같습니다.","link": "","category": "지속적인 문제 발생 시 관리자에게 문의해주세요.","description": "","telephone": "","address": "","roadAddress": "","mapx": "0","mapy": "0"}]}';

  }

?>
