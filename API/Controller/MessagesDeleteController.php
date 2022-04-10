<?php
require 'CleanArray.php';
require 'Permission.php';

use API\Model\Entity\Messages;

if(Permission('adm')){

    if(!isset($_POST['id'])){
        echo json_encode('bad Id request');
        die();
    }else{
        CleanArray($_POST);
        $id = htmlspecialchars($_POST['id']);
        
        $message = new Messages;
        $response = $message->setEntityManager()->deleteEntity('messages', 'id', $_POST['id']);
        
        if($response){
            http_response_code(200);
            echo json_encode('delete');
        }
        else{
            http_response_code(202);
            echo json_encode('something goes wrong');
        }
    }
}
else{
    echo json_encode('bad permission');
}