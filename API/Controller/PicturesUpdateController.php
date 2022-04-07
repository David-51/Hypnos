<?php

require_once 'Permission.php';
require_once 'recordImage.php';
require_once 'VerifyPermissionManagers.php';
// Verify datas

use API\Model\Entity\Pictures;
if(Permission('man')){    
    // if(true){
    if(isset($_POST['pictureId'])
    && isset($_POST['suiteId'])
    && !empty($_FILES['updatePicture'])){                   
        
        $_POST['suiteId'] = trim(strip_tags($_POST['suiteId']));
        $_POST['pictureId'] = trim(strip_tags($_POST['pictureId']));
        
        //Verify that Suites is owned by the right Manager
        if(VerifyPermissionManager($_SESSION['id'], $_POST['suiteId'])){
            
            // record picture and record url in database
            // create image at 640x426px
                            
            $image_name = record_image($_FILES['updatePicture'], 'Client/public/images');                                

            $picture_link = '/Client/public/images/'.$image_name;
            $picture = new Pictures;            
                    
            try{
                $response = $picture->setEntityManager()->updateEntity('id', $_POST['pictureId'], ['picture_link' => $picture_link]);
                if(!$response){
                    error_log(date('d-m-Y').' reponse is false'.PHP_EOL, 3, '/error_log.log');
                }
                $picture->setId($_POST['pictureId']);
                $picture_response = $picture->setEntityManager()->getEntity();

                $datalog = $picture_response;

                http_response_code(201);
                echo json_encode($picture_response);
            }
            catch(\Exception $e){
                http_response_code(400);
                error_log($e, 3, '/error_log.log');
            }                  
        }
        else{
            http_response_code(400);
            error_log('suite id = '.$_POST['suiteId'].' user_id = '.$_SESSION['id'],3, '/error_log.log');
            echo json_encode('No Permission');

        }
    
    }
}