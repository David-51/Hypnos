<?php

use API\Model\Entity\Managers;
use API\Model\Entity\Users;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['establishment'], $_POST['email'], $_POST['password'])){
    
    // first, create User
    $user = new Users;
    $user->setEntity($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], 'man');
    $user->setEntityManager()->persistEntity();
    

    // second, create Manager
    $manager = new Managers;
    
    $manager->setEntity($user->id, $_POST['establishment']);
    
    $response = $manager->setEntityManager()->persistEntity();

    if($response === false){
        http_response_code(404);
        echo json_encode('Something goes wrong');
    }
    else{
        $return = json_encode($manager->getManager());        
        http_response_code(201);
        echo $return;
    }        

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}