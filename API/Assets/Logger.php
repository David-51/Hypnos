<?php
function logger($message = null){
    $datas = date('d-m-Y h:i:s').' ';
    $datas .= $message;
    if($message !== null){
        file_put_contents('logApi.log', $datas, FILE_APPEND);
    }
}