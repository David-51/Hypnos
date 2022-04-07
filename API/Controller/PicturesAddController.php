<?php

require 'Permission.php';
require 'recordImage.php';
// Verify datas

use API\Model\Entity\Managers;
use API\Model\Entity\Pictures;
use API\Model\Entity\Suites;


if(Permission('man')){    
// if(true){
    if(isset($_POST['id']) && !empty($_FILES['addPicture'])){                        
        $_POST['id'] = trim(strip_tags($_POST['id']));

        //Verify that Suites is owned by the right Manager
        $manager = new Managers;
        $current_manager = $manager->getManager($_SESSION['id']);
        // $current_manager = $manager->getManager('89e057a6-b5ee-11ec-b950-03a11caa0106');                    

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
            // record picture and record url in database
            
            // create image at 640x426px                     
            $image_name = record_image($_FILES['addPicture'], 'Client/public/images');

            $picture_link = '/Client/public/images/'.$image_name;
            $picture = new Pictures;
            $picture->setEntity($suite, $picture_link);

            try{
                $picture->setEntityManager()->persistEntity();
                http_response_code(201);
                echo json_encode($picture);
            }
            catch(\Exception $e){
                http_response_code(400);
                error_log($e, 3, '../../error_log.log');
            }                  
        }
    }else{        
        http_response_code(400);
    }
}