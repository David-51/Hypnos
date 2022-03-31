<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Suites;
use API\Model\Manager\Entity;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$view->setBody('SignIn', []);
echo $view->getContent();

