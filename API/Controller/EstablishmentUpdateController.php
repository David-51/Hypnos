<?php

use API\Model\Entity\Establishments;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(isset($_POST['name'], $_POST['city'], $_POST['description'], $_POST['adress'], $_POST['id'])){
    
    $establishement = new Establishments;
    $establishement->setId(htmlspecialchars($_POST['id']));
    
        $establishement->setEntityManager()->updateEntity(
            'id',
            $_POST['id'], 
            [
                'name' => $_POST['name'],
                'city' => $_POST['city'],
                'adress' => $_POST['adress'],
                'description' => $_POST['description']        
            ]);    
    echo json_encode($establishement->setEntityManager()->getEntity());

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}