<?php
require 'CleanArray.php';
require 'Permission.php';

use API\Model\Entity\Messages;

if(Permission('adm')){
    if(!isset($_POST['id'])){
        http_response_code(403);
        echo json_encode('bad Id request');        
    }
    else{
        CleanArray($_POST);
    
        $id = htmlspecialchars($_POST['id']);
        
        $message = new Messages;
        $response = $message->setEntityManager()->updateEntity('id', $_POST['id'], ['done' => $_POST['done']]);
        
        if($response){
            http_response_code(200);
            echo json_encode($response);
        }
        else{
            http_response_code(202);
            echo json_encode('something goes wrong');
        }
    }
}