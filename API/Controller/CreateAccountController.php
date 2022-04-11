<?php
// Verify datas
require 'CleanArray.php';
use API\Model\Entity\Users;

// $_POST verification
if(isset(
    $_POST['firstname'],
    $_POST['lastname'],    
    $_POST['email'],
    $_POST['password'],
    $_POST['confirm-password']) 
    && $_POST['password'] === $_POST['confirm-password']){

        // security for datas
        $_POST = CleanArray($_POST);
        $user = new Users;
        try{
            $user->setEntity($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], 'use');
            $response = $user->persistUser();            
        }
        catch(Exception $e){
            $status = http_response_code(403);
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
