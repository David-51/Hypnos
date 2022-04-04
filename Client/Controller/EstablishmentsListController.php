<?php

use API\Model\Entity\Establishments;
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

            $list = $establishment->getSuites();
            
            $entity = $establishment->setEntityManager()->getEntity();
            
            
            $view->setBody('SuitesByEstablishment', [$entity->name, $entity->city, $list]);                        
        }
        else{                        
            $list = (new Establishments)->getAllSuites();                       
            $view->setBody('SuitesByEstablishment', ['Toute les suites...', '', $list]);            
        }                
        break;
        
    default:
    
    $list = (new Establishments)->setEntityManager()->getEntity();                  
    $view->setBody('EstablishmentsList', $list);
}
echo $view->getContent();


