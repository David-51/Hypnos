<?php

use API\Model\Entity\Managers;
use API\Model\Entity\Suites;

function VerifyPermissionManager($user_id, $suite_id){

    $manager = new Managers;
        $current_manager = $manager->getManager($user_id);
        // $current_manager = $manager->getManager('89e057a6-b5ee-11ec-b950-03a11caa0106');                    

        if(is_object($current_manager[0])){
            $manager_establishment_id = $current_manager[0]->establishment_id;
        }
        else{
            http_response_code(403);
            return false;
        }                
        $suite = new Suites;
        $suite->setId($suite_id);
        $suite_establishment = $suite->setEntityManager()->getEntity();
        
        if(!is_object($suite->setEntityManager()->getEntity())){
            http_response_code(403);
            echo json_encode('No permission 44');
            return false;
        }else{            
            $suite_establishment_id = $suite_establishment->establishment_id;    
        }
        // If the right manager with the right suite update
        if($manager_establishment_id === $suite_establishment_id){
            return true;
        }
        else{
            return false;
        }
}