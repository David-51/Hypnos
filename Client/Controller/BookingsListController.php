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
                 
$view->setBody('bookingsList', $list);

echo $view->getContent();


