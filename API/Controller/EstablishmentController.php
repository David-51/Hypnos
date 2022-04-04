<?php

use API\Model\Entity\Establishments;

if(!isset($_GET['id'])){
    echo json_encode('bad Id request');
}

$id = htmlspecialchars($_GET['id']);

$establishment = new Establishments;
$establishment->setId($id);
$result = $establishment->setEntityManager()->getEntity();

http_response_code(200);
echo json_encode($result);