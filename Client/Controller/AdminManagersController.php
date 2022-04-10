<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Managers;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$list = (new Managers)->getManagers();
$hotels = (new Establishments)->setEntityManager()->getEntity();

$view->setBody('adminManagers', [$list, $hotels]);

echo $view->getContent();


