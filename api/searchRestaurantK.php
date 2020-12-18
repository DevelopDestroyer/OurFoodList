<?php
  $config = parse_ini_file('../config.ini', true);
  $client_id = $config['naverSearchClientId'];
  $client_secret = $config['naverSearchSecret'];
  $db_host = "localhost";
  //$db_host = $config['dbhost'];
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];
  $kakaoRestAPIKey = $config['kakaoRestAPIKey'];
  //$response = array();

  $encText = urlencode($_GET['keyword']); //검색할 Text를 url인코딩
 
  /*요청 변수(query, display, start, sort... 네이버 참고)
    json ver: https://openapi.naver.com/v1/search/book.json?...
    xml ver : https://openapi,naver.com/v1/search/book.xml?...
  */
  $url = "https://dapi.kakao.com/v2/local/search/keyword.json?query=".$encText."&category_group_code=FD6";

  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "Authorization: KakaoAK ".$kakaoRestAPIKey;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response_str = curl_exec ($ch);
  //echo $response_str."what?";
  $response = json_decode($response_str,true);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close ($ch);
  if($status_code == 200) {
    //db저장
    $connect = mysqli_connect($db_host, $db_user_name, $db_pw, $db_name);
    //$connect = mysql_connect($db_host,$db_name,$db_pw);
    $db = mysqli_select_db($connect, $db_name) or die('DB Connect failure!!!!');
    //$db = mysql_select_db($db_name,$connect);

    if ($connect->connect_error) {
      die("Connection failed: " . $connect->connect_error);
      return;
    }
    //$sql = "set names euckr";
    //쿼리문 전송 및 가져오기
    $sql = "replace into STORE_MST (store_id, store_name, category, description, telephone, address, roadaddress, lon, lat, create_date) values ";

    //<b> 제거
    for($i=0; $i < count($response['documents']); $i++){
      $sql = $sql."('".$response['documents'][$i]['id']."', "; //store_id
      $sql = $sql."'".$response['documents'][$i]['place_name']."', "; //store_name
      $sql = $sql."'".$response['documents'][$i]['category_name']."', ";
      $sql = $sql."'".$response['documents'][$i]['place_url']."', "; //디스크립
      $sql = $sql."'".$response['documents'][$i]['phone']."', ";
      $sql = $sql."'".$response['documents'][$i]['address_name']."', ";
      $sql = $sql."'".$response['documents'][$i]['road_address_name']."', ";
      $sql = $sql."'".$response['documents'][$i]['x']."', ";
      $sql = $sql."'".$response['documents'][$i]['y']."', ";


      $sql = $sql."'".date("Y-m-d H:i:s")."'), ";
    }
    $sql = substr($sql , 0, -2);
    $sql = $sql.";";
    if(count($response['documents']) >= 0){
      //$result = mysql_query($sql,$connect);
      $result = mysqli_query($connect, $sql);
      //$fields = mysql_num_fields($result);
      //mysqli_close($connect);
    }



    $ch2 = curl_init();
    $url2 = "https://dapi.kakao.com/v2/local/search/keyword.json?query=".$encText."&category_group_code=CE7";
    curl_setopt($ch2, CURLOPT_URL, $url2);
    curl_setopt($ch2, CURLOPT_POST, false);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    $headers2 = array();
    $headers2[] = "Authorization: KakaoAK ".$kakaoRestAPIKey;
    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
    $response_str2 = curl_exec ($ch2);
    $response2 = json_decode($response_str2,true);
    $status_code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);

    curl_close ($ch2);

    //2차로는 카페 검색도 해본다..
    if($status_code2 == 200) {
      $sql = "replace into STORE_MST (store_id, store_name, category, description, telephone, address, roadaddress, lon, lat, create_date) values ";

      //<b> 제거
      for($i=0; $i < count($response2['documents']); $i++){
        $sql = $sql."('".$response2['documents'][$i]['id']."', "; //store_id
        $sql = $sql."'".$response2['documents'][$i]['place_name']."', "; //store_name
        $sql = $sql."'".$response2['documents'][$i]['category_name']."', ";
        $sql = $sql."'".$response2['documents'][$i]['place_url']."', "; //디스크립
        $sql = $sql."'".$response2['documents'][$i]['phone']."', ";
        $sql = $sql."'".$response2['documents'][$i]['address_name']."', ";
        $sql = $sql."'".$response2['documents'][$i]['road_address_name']."', ";
        $sql = $sql."'".$response2['documents'][$i]['x']."', ";
        $sql = $sql."'".$response2['documents'][$i]['y']."', ";


        $sql = $sql."'".date("Y-m-d H:i:s")."'), ";
      }
      $sql = substr($sql , 0, -2);
      $sql = $sql.";";

      if(count($response['documents']) >= 0){
        $result = mysqli_query($connect, $sql);
        mysqli_close($connect);
      }
    }

    $response['documents'] = array_merge($response['documents'], $response2['documents']);

    echo json_encode($response);
  } else {
//    echo "Error 내용:".$response;
	echo '{"lastBuildDate": "Thu, 09 Jan 2020 23:36:34 +0900","total": 12820,"start": 1,"display": 10,"documents": [{"place_name": "네트워크에 문제가 있는 것 같습니다.","link": "","category_name": "지속적인 문제 발생 시 관리자에게 문의해주세요.","place_url": "","phone": "","address_name": "","road_address_name": "","x": "0","y": "0"}]}';

  }

?>
