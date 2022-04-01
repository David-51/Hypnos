<?php
// Verify datas

use API\Model\Entity\Users;

// $_POST verification
if(isset(
    $_POST['firstname'],
    $_POST['lastname'],    
    $_POST['email'],
    $_POST['password'],
    $_POST['confirm-password']) 
    && $_POST['password'] === $_POST['confirm-password']){
        
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
        echo '<h1>ceci est ma réponse</h1>';
        var_dump($response);        
     
 }
 else{
     echo 'You can\'t do that thing';
 }
