<?php

use API\Model\Entity\Establishments;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(isset($_POST['name'], $_POST['city'], $_POST['description'], $_POST['adress'])){
    
    $establishment = new Establishments;
    $establishment->setEntity($_POST['name'], $_POST['city'], $_POST['adress'], $_POST['description']);
    $establishment->setEntityManager()->persistEntity();
        
    echo json_encode($establishment->setEntityManager()->getEntity());

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}