<?php

use API\Model\Entity\Users;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

if(!isset($_SESSION['id'])){
    $redirect = '/login?redirect=bookings/list';    
    header("Location: $redirect");
    die();
}

$list = (new Users)->setId($_SESSION['id'])->getBookingsList();

// condition d'annulation
foreach($list as $element){
    $today = new DateTime(date('Y-m-d'));
    $check_in = new DateTime($element->date_checkin);
    $check_out = new DateTime($element->date_checkout);
    $element->annulation = $today->diff($check_in)->format('%r%a') >= 3 ? true : false;
    $element->done = $today->diff($check_out)->format('%r%a') <= 0 ? true : false;

}

$view->setBody('bookingsList', $list);

echo $view->getContent();


