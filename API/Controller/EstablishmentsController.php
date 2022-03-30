<?php 

namespace API\Controller;

use API\Model\Entity\Establishments as EstablishementsEntity;
use API\Model\Entity\Suites;
use API\Model\Manager\Entity;

class Establishments
{
    // public function __construct(EstablishementsEntity $establishments)
    // {
    //     $this->establishments = $establishments;
    // }

    // public function getEstablishments(){
    //     $response = $this->establishments->setEntityManager()->getEntities();
    //     return $this->list = $response[0] === 'success' ? $response[1] : 'error';        
    // }
    
    // public function getSuitesByEstablishment($id = null) {
    //     $suites = new Suites;
    //     $response = $id ? $suites->setEntityManager()->getEntities(['*'], 'establishment_id', $id) : $suites->setEntityManager()->getEntities();
        
    //     $test = new Entity();
                      
    //     // return $this->list = $response[0] === 'success' ? $response[1] : 'error';        
    // }
}