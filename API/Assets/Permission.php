<?php

function Permission(string $role){
    if(!isset($_SESSION['role'])){
        http_response_code(403);         
        echo json_encode('No permission');
        return false;

    }else if($_SESSION['role'] !== $role){
        http_response_code(403);
        echo json_encode('No permission');
        return false;
    }
    else{
        return true;
    }
}