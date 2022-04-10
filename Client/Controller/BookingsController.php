<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Suites;
use Client\Controller\Template;

if(!isset($_SESSION['lastname'])){
    $redirect = '/login?redirect=bookings';
    if(isset($_GET['suites'])){
        $_GET['suites'] = trim(strip_tags($_GET['suites']));
        $redirect .= '&suites='.$_GET['suites'];
    }

    header("Location: $redirect");
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

$view->setBody('bookings', $list_hotel);
echo $view->getContent();