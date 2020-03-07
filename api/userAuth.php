<?php

/*
세션이 유지 중인지 확인하기 위함
 */

session_start();
if($_SESSION['userId'] == null && $_SESSION["tmpUserId"] == null){
    echo '{"result": "success", "code": "-1", "message": ""}';
}else{
    echo '{"result": "success", "code": "1", "message": ""}';
}


?>