<?php
require 'CleanArray.php';
require 'Permission.php';
// Verify datas

// $_POST verification

use API\Model\Entity\Managers;
use API\Model\Entity\Suites;

if(Permission('man')){
// if(true){
    if(isset($_POST['id'])){
         
        $_POST = CleanArray($_POST);        
        
        //Verify that Suites is owned by the right Manager
        $manager = new Managers;
        // $current_manager = $manager->getManager('3945cf06-b5d5-11ec-b950-03a11caa0106')[0];        
        $current_manager = $manager->getManager($_SESSION['id']);        

        if(is_object($current_manager[0])){
            $manager_establishment_id = $current_manager[0]->establishment_id;
        }
        else{
            http_response_code(404);
            die();
        }        
        $suite = new Suites;
        $suite->setId($_POST['id']);
        $suite_establishment = $suite->setEntityManager()->getEntity();
        
        if(is_object($suite_establishment)){
            $suite_establishment_id = $suite_establishment->establishment_id;
        }
        else{
            http_response_code(403);
            die();
        }

        if($manager_establishment_id === $suite_establishment_id){            
            
            $response = $suite->setEntityManager()->deleteEntity('suites', 'id', $_POST['id']);        
            // info user
            if($response === true){
                http_response_code(200);
                echo json_encode('deleted');
            }
            else{            
                // 202
                http_response_code(403);
                echo json_encode($response);
            }                
            
        }
        else{
            http_response_code(403);
            echo json_encode('No Permission');
        }

    }
    else{
        http_response_code(202);
        echo json_encode('Invalid parameters');
    }
}
