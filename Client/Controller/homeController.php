<?php

use API\Model\Entity\Establishments;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

$establishments = new Establishments;
$list = $establishments->setEntityManager()->getEntity();



$view->setBody('home', $list);
echo $view->getContent();