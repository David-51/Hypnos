<?php
require 'CleanArray.php';
require 'Permission.php';
// Verify datas

// $_POST verification

use API\Model\Entity\Managers;
use API\Model\Entity\Suites;

if(Permission('man')){
    
// if(true){
    if(isset(
        $_POST['id'],
        $_POST['title'],
        $_POST['description'],    
        $_POST['link_to_booking'],
        $_POST['price'])){
         
        $_POST = CleanArray($_POST);
    
        $_POST['price'] = $_POST['price']*100;
        
        //Verify that Suites is owned by the right Manager
        $manager = new Managers;
        $current_manager = $manager->getManager($_SESSION['id']);
        // $current_manager = $manager->getManager('3945cf06-b5d5-11ec-b950-03a11caa0106');
                    
        if(is_object($current_manager[0])){
            $manager_establishment_id = $current_manager[0]->establishment_id;
        }
        else{
            http_response_code(403);
            die();
        }        
        
        $suite = new Suites;
        $suite->setId($_POST['id']);
        $suite_establishment = $suite->setEntityManager()->getEntity();
        
        
        if(!is_object($suite->setEntityManager()->getEntity())){
            http_response_code(403);
            echo json_encode('No permission 44');
            die();
        }else{            
            $suite_establishment_id = $suite_establishment->establishment_id;    
        }

        // If the right manager with the right suite update
        if($manager_establishment_id === $suite_establishment_id){
            
            $response = $suite->setEntityManager()->updateEntity('id', $_POST['id'], 
                [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'link_to_booking' => $_POST['link_to_booking'],
                    'price' => $_POST['price']
                ]);
                if($response === true){
                    http_response_code(201);
                    
                    // return the new entity
                    $new_suite = new Suites;
                    $new_suite->setId($_POST['id']);
    
                    $new_response = $new_suite->getSuite();
                    echo json_encode($new_response);
                }
                else{
                    http_response_code(202);

                }
        }
        else{
            http_response_code(403);
            echo json_encode('No permission');
        }
    }
    else{
        http_response_code(202);
        echo json_encode('invalid paramters');
    }   
}
