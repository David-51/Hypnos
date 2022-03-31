<?php

use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$view->setBody('Home', []);
echo $view->getContent();