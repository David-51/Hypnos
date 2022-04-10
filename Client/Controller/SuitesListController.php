<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Suites;
use API\Model\Manager\Entity;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$entity = new Entity();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $suite = new Suites;
    $suite->setId($id);
    $props = $suite->getSuite();    

    $establishment_name = $props->setEntityManager()->getChilds(new Establishments, true)[0]->name;    
    $view->setBody('suites', [$establishment_name, $props]);
}else{
    $list = (new Establishments)->getAllSuites();                       
    $view->setBody('suitesByEstablishment', ['Toute les suites...', '', $list]);
}
echo $view->getContent();


