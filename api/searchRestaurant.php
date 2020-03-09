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
  $url = "https://openapi.naver.com/v1/search/local.json?query=".$encText;

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
  $response_str = curl_exec ($ch);
  //echo $response_str."what?";
  $response = json_decode($response_str,true);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close ($ch);
  if($status_code == 200) {
	str_replace("<b>", "", $response); 
    str_replace("</b>", "", $response);

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
    for($i=0; $i < count($response['items']); $i++){

        $url2 = "https://dapi.kakao.com/v2/local/geo/transcoord.json?x=".$response['items'][$i]['mapx']."&y=".$response['items'][$i]['mapy']."&input_coord=KTM&output_coord=WGS84";

        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $url2);
        curl_setopt($ch2, CURLOPT_POST, false);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        $headers2 = array();
        $headers2[] = "Authorization: KakaoAK ".$kakaoRestAPIKey;
        curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
        $response_str2 = curl_exec ($ch2);
        //echo $response_str."what?";
        $response2 = json_decode($response_str2,true);
        $status_code2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);

        curl_close ($ch2);

      $response['items'][$i]['title'] = str_replace("<b>", "", $response['items'][$i]['title']);
      $response['items'][$i]['title'] = str_replace("</b>", "", $response['items'][$i]['title']);

      $sql = $sql."('".$response['items'][$i]['mapx']."-".$response['items'][$i]['mapy']."-".$response['items'][$i]['title']."', "; //store_id




      $sql = $sql."'".$response['items'][$i]['title']."', "; //store_name
      $sql = $sql."'".$response['items'][$i]['category']."', ";
      $sql = $sql."'".$response['items'][$i]['description']."', ";
      $sql = $sql."'".$response['items'][$i]['telephone']."', ";
      $sql = $sql."'".$response['items'][$i]['address']."', ";
      $sql = $sql."'".$response['items'][$i]['roadAddress']."', ";
      /*위에 카텍좌표계로 store_id를 만들어주고, 그 다음 위경도로 변환된 값들을 db에 저장한다..
      클라이언트는 카텍좌표계를 json 그대로 이어받아 id를 만들어 리뷰생성을 요청 할 수 있다
      정리 : store_id에는 카텍좌표계 조합의 id가 생성돼며, lat, lon에는 위경도로 변환된 값이 이용된다...
      이 lat, lon은 지도화면에서 json으로 조합되어 그대로 내려가며 클라이언트는 이것을 별도 연산없이 그대로 쓰면 된다!
      */
      if($status_code2 == 200) {
        //$response['items'][$i]['mapx'] = $response2['documents'][0]['x'];
        //$response['items'][$i]['mapy'] = $response2['documents'][0]['y'];
        $sql = $sql."'".(string)$response2['documents'][0]['x']."', ";
        $sql = $sql."'".(string)$response2['documents'][0]['y']."', ";
      }
      else{
        $sql = $sql."'".$response['items'][$i]['mapx']."', ";
        $sql = $sql."'".$response['items'][$i]['mapy']."', ";
      }

      $sql = $sql."'".date("Y-m-d H:i:s")."'), ";
    }
    $sql = substr($sql , 0, -2);
    $sql = $sql.";";
    if(count($response['items']) > 0){
      //$result = mysql_query($sql,$connect);
      $result = mysqli_query($connect, $sql);
      //$fields = mysql_num_fields($result);
      mysqli_close($connect);
    }


    /*
       $db_host = $config['dbhost'];
  $db_user_name = $config['dbusername'];
  $db_name = $config['dbname'];
  $db_pw = $config['dbpw'];
     */


    //출력
    //while($row = mysql_fetch_row($result)){
    //  echo $row[0].$row[1].$row[2];
    //}



    echo json_encode($response);
  } else {
//    echo "Error 내용:".$response;
	echo '{"lastBuildDate": "Thu, 09 Jan 2020 23:36:34 +0900","total": 12820,"start": 1,"display": 10,"items": [{"title": "네트워크에 문제가 있는 것 같습니다.","link": "","category": "지속적인 문제 발생 시 관리자에게 문의해주세요.","description": "","telephone": "","address": "","roadAddress": "","mapx": "0","mapy": "0"}]}';

  }

?>
