<?php

use API\Model\Entity\Managers;
use API\Model\Entity\Users;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['establishment'], $_POST['email'], $_POST['id'])){
    
    $user = new Users;
    $user->setEntityManager()->updateEntity('id', $_POST['id'], [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email']
    ]);

    $manager = new Managers;
    $response = $manager->setEntityManager()->updateEntity('user_id', $_POST['id'], [
        'establishment_id' => $_POST['establishment']
    ]);    
    

    if($response === false){
        http_response_code(404);
        echo json_encode('Something goes wrong');
    }
    else{
        echo json_encode($manager->getManager($_POST['id'])[0]);
        http_response_code(201);        
    }        

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}