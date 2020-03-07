<?php

/*
세션이 유지 중인지 확인하기 위함
-1 : 로그인중이아님
1 : 비회원 로그인
2 : 실회원 로그인
 */

session_start();
if($_SESSION['userId'] == null && $_SESSION["tmpUserId"] == null){
    echo '{"result": "success", "code": "-1", "message": ""}';
}else{
    if($_SESSION['userId'] == null)
        echo '{"result": "success", "code": "1", "message": ""}';
    else
        echo '{"result": "success", "code": "2", "message": ""}';
}


?>