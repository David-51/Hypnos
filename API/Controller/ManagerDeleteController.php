<?php

use API\Model\Entity\Users;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(isset($_POST['id'])){
     
    $user = new Users;
    $response = $user->setEntityManager()->deleteEntity('users','id',$_POST['id']);

    if($response === false){
        http_response_code(404);
        echo json_encode('Something goes wrong');
    }
    else{
        echo json_encode($response);
        http_response_code(200);        
    }        

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}