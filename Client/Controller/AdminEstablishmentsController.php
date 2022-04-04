<?php

use API\Model\Entity\Establishments;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$list = (new Establishments)->setEntityManager()->getEntity();              
$view->setBody('AdminEstablishments', $list);

echo $view->getContent();


