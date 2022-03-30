<?php

use API\Model\Entity\Establishments;
use API\Model\Entity\Pictures;
use API\Model\Entity\Suites;
use API\Model\Manager\Entity;
use Client\Controller\Template;

$view = new Template;
$view->setHeader('headerTemplate');
$view->setFooter('footerTemplate');
$view->setNavbar('navbarTemplate');


$entity = new Entity();

switch ($_GET['level2']) {
    case 'suites':
        if(isset($_GET['id'])){
            $establishment = new Establishments;
            $establishment->setId($_GET['id']);

            $em = new Entity($establishment);            
            $entity = $em->getEntity();           
            $list = $em->getJoinEntity(new Suites, new Pictures);
            $view->setBody('SuitesByEstablishment', [$entity->name, $entity->city, $list]);                        
        }
        else{                        
            $list = (new Suites)->setEntityManager()->getJoinEntity(new Pictures);
            $view->setBody('SuitesByEstablishment', ['Toute les suites...', '', $list]);
            
        }                
        break;
        
    default:
    
    $list = (new Establishments)->setEntityManager()->getEntity();                  
    $view->setBody('EstablishmentsList', $list);
}
echo $view->getContent();


