<?php

use API\Model\Entity\Suites;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');

$list = (new Suites)->getManagerSuites($_SESSION['id']);

$view->setBody('managerSuites', $list);

echo $view->getContent();


