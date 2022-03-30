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
        }
        else{            
            $response = $entity->getEntitiesByClassName('Suites');
            $list = $response[0] === 'success' ? $response[1] : $response[0];                
            var_dump($response);
        }        
        // $view->setBody('SuitesbyEstablishment', $list);        
        break;
        
    default:
    $response = $entity->getEntitiesByClassName('Establishments');    
    $list = $response[0] === 'success' ? $response[1] : $response[0];                
    $view->setBody('EstablishmentsList', $list);
}
echo $view->getContent();


