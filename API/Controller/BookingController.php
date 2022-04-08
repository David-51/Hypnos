<?php
require 'CleanArray.php';

// vérification du login

use API\Model\Entity\Bookings;

if(!isset($_SESSION['role'])){
    http_response_code(400);
    echo json_encode('Identification error');
    die();
}
if(isset($_POST['establishment'], 
$_POST['suites'],
$_POST['checkin'],
$_POST['checkout'])){
    
    $_POST = CleanArray($_POST);
    $user_id = $_SESSION['id'];
    // $user_id = '13685634-b6b9-11ec-b950-03a11caa0106';
             
    $booking = new Bookings;
    $booking->setEntity($user_id, $_POST['suites'], $_POST['checkin'], $_POST['checkout']);
    // Verify disponibility of date
    $bookedCalendar = $booking->getBookedCalendars();
    $wish = WishBooking($_POST['checkin'], $_POST['checkout']);
    
    $isBookable = empty(array_intersect($bookedCalendar, $wish));
    
    if($isBookable){
        try{        
            $response = $booking->bookingPersist();
    
            if($response === false){
        
                echo json_encode('something goes wrong');
            }else{
                http_response_code(201);
                echo json_encode('success');
            }
        }
        catch(\Exception $e){
            $message = $e;
        }
    }
    else{
        http_response_code(202);
        echo json_encode('notempty');
    }
}
function WishBooking($date_checkin, $date_checkout){
    
    $nights = date_diff(new \DateTime($date_checkin), new \DateTime($date_checkout))->days;
    
    $calendar = [];
    for($i=0; $i < $nights; $i++){
      $checkin = new \DateTime($date_checkin);
      $calendar[] = date('Y-m-d', $checkin->add(new DateInterval('P'.$i.'D'))->getTimestamp());
    }
  return $calendar;
  }