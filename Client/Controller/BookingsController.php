<?php

use API\Model\Entity\Establishments;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

// Choose Establishments
$establishments = new Establishments;
$list_hotel = $establishments->setEntityManager()->getEntity();

$view->setBody('bookings', $list_hotel);
echo $view->getContent();