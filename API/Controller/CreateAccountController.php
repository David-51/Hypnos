<?php
// Verify datas
require 'CleanArray.php';
use API\Model\Entity\Users;

// $_POST verification
if(isset(
    $_POST['firstname'],
    $_POST['lastname'],    
    $_POST['email'],
    $_POST['cgu'],
    $_POST['password'],
    $_POST['confirm-password']) 
    && $_POST['password'] === $_POST['confirm-password']){

        // security for datas
        $_POST = CleanArray($_POST);
        if($_POST['cgu'] !== 'on'){
            http_response_code(403);
            echo json_encode('Vous devez accepter les CGUs');
            die();
        }
        
        $user = new Users;
        try{
            $user->setEntity($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], 'use');                    
        }
        catch(Exception $e){
            http_response_code(403);
            echo json_encode($e->getMessage());            
            die();         
        } 
        $response = $user->persistUser();            
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['role'] = 'use';
        $_SESSION['id']= $response['id'];

        http_response_code();
        $json = json_encode($response);        
        echo $json;
 }
 else{
     http_response_code(403);
     echo json_encode('You can\'t do that thing');
 }
