<?php
require 'CleanArray.php';
require 'Permission.php';
// Verify datas

// $_POST verification

use API\Model\Entity\Pictures;
use API\Model\Entity\Suites;

$suite = new Suites;

if(isset($_GET['id'])){
    CleanArray($_GET);
    $suite->setId($_GET['id']);
    $response = $suite->getSuite();
    http_response_code(200);
    echo json_encode($response);
}
else{
    $response = $suite->setEntityManager()->getEntity();
    foreach($response as $object){
        $picture = new Pictures;
        $object->pictures = $object->setEntityManager()->getChilds($picture);
    }
    http_response_code(200);
    echo json_encode($response);
}