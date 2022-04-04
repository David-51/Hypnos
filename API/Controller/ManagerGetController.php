<?php

use API\Model\Entity\Managers;

if(!isset($_SESSION['role']) && $_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(!isset($_GET['id'])){
    echo json_encode('bad Id request');
}

$id = htmlspecialchars($_GET['id']);

$manager = new Managers;
$response = $manager->getManager($_GET['id'])[0];

http_response_code(200);
echo json_encode($response);