<?php

use API\Model\Entity\Messages;

if(!isset($_SESSION['role'])){
    http_response_code(403);
    echo json_encode('No permission');
}else if($_SESSION['role'] !== 'adm'){
    http_response_code(403);
    echo json_encode('No permission');
}

if(!isset($_GET['id'])){
    echo json_encode('bad Id request');
}

$id = htmlspecialchars($_POST['id']);

$message = new Messages;
$response = $message->setEntityManager()->deleteEntity('messages', 'id', $_POST['id']);

http_response_code(200);
echo json_encode($response);