<?php

use API\Model\Entity\Messages;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

$list = (new Messages)->setEntityManager()->getEntity();

$view->setBody('adminMessages', $list);

echo $view->getContent();


