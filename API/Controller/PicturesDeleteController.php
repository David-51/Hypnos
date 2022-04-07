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
            
            $picture = new Pictures;            
                    
            try{
                $response = $picture->setEntityManager()->deleteEntity('pictures', 'id', $_POST['pictureId']);
                if($response){
                    http_response_code(200);
                    echo json_encode('deleted');
                }
                else{
                    http_response_code(202);
                    $message = 'Cant delete that';
                    echo json_encode($message);
                }
            }
            catch(\Exception $e){
                http_response_code(400);                
            }                  
        }
        else{
            http_response_code(400);            
            echo json_encode('No Permission');
        }
    
    }else{
        $message = 'invalid parameters';
        http_response_code(400);
        echo json_encode($message);
    }
}