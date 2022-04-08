<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Suites;
use Client\Controller\Template;

if(!isset($_SESSION['lastname'])){
    header('Location: /login&redirect=bookings');
    die();
}
if(isset($_GET['suites'])){
    $suite = new Suites;
    $suite->setId($_GET['suites']);
}

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

// Choose Establishments
$establishments = new Establishments;
$list_hotel = $establishments->setEntityManager()->getEntity();

// $establishement_list = $establishement->getAll();

$view->setBody('Bookings', $list_hotel);
echo $view->getContent();