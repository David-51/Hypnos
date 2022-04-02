<?php
// Verify datas

// $_POST verification

use API\Model\Entity\Messages;

if(isset(
    $_POST['firstname'],
    $_POST['lastname'],    
    $_POST['email'],
    $_POST['subject'],
    $_POST['message'])){
        
        $message = new Messages;

        try{
            
            $message->setEntity($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['subject'], $_POST['message']);
            $response = $message->persistMessage();
        }
        catch(Exception $e){
            json_encode($e);            
            http_response_code();
            die();         
        }        
        http_response_code();
        $json = json_encode($response);
        echo $json;
 }
 else{
     echo 'You can\'t do that thing';
 }
