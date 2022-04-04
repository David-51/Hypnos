<?php

use API\Model\Entity\Establishments;

// if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
//     http_response_code(403);
//     echo json_encode('No permission');
// }

if(isset($_POST['id'])){
    
    $establishement = new Establishments;
    $establishement->setEntityManager()->deleteEntity('establishments', 'id', $_POST['id']);
    http_response_code(200);    
    echo json_encode('entity deleted');

}else {
    http_response_code(403);
    echo json_encode('Invalid parameters numbers ...');
}