<?php

use API\Model\Entity\Establishments;
use Client\Controller\Template;

if(!isset($_SESSION['lastname'])){
    header('Location: /login&redirect=bookings');
    die();
}

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

// Choose Establishments
$establishement = new Establishments;
// $establishement_list = $establishement->getAll();


$view->setBody('Bookings', []);
echo $view->getContent();