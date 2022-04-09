<?php
require 'CleanArray.php';

// vérification du login

use API\Model\Entity\Bookings;

if(!isset($_SESSION['role'])){
    http_response_code(400);
    echo json_encode('Identification error');
    die();
}
if(isset($_POST['id'], )){
    
    $_POST = CleanArray($_POST);
    $user_id = $_SESSION['id'];
    // $user_id = '13685634-b6b9-11ec-b950-03a11caa0106';             

    $booking = new Bookings;
    // vérify 3 days to delete the book
    $booking = new Bookings;
    $entity = $booking->setId($_POST['id'])->setEntityManager()->getEntity();
    $today = new DateTime(date('Y-m-d'));
    $check_out = new DateTime($entity->date_checkout);
    $isAnnulable = $today->diff($check_out)->format('%r%a') >= 3 ? true : false;

    if(!$isAnnulable){
        http_response_code(200);
        echo json_encode('notAnnulable');
    }
    else{
        $response = $entity->setEntityManager()->deleteEntity('bookings', 'id', $_POST['id']);
        
        if(!$response){
            http_response_code(400);
            echo json_encode('Something goes wrong ...');
        }
        else{
            http_response_code(200);
            echo json_encode('deleted');
        }
    }    
}
else{
    http_response_code(400);
    echo json_encode('invalid paramaters');
}
