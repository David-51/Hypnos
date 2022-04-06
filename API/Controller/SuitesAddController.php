<?php
require 'CleanArray.php';
require 'Permission.php';
// Verify datas

// $_POST verification

use API\Model\Entity\Establishments;
use API\Model\Entity\Managers;
use API\Model\Entity\Suites;

if(Permission('man')){
// if(true){
    if(isset(
        $_POST['title'],
        $_POST['description'],    
        $_POST['link_to_booking'],
        $_POST['price'])){
         
        $_POST = CleanArray($_POST);
    
        $_POST['price'] = floor($_POST['price']*100);
    
        // info user
        $manager = new Managers;
    
        // id for test = c811ede4-b541-11ec-b950-03a11caa0106
        // $user = $manager->getManager('3945cf06-b5d5-11ec-b950-03a11caa0106')[0];
        $user = $manager->getManager($_SESSION['id'])[0];        
    
        try{
            if(!isset($_SESSION['id'])){
                throw new Exception('Invalid permission');                
                http_response_code(403);
            }
            $establishment = new Establishments;
            $establishment->setId($user->establishment_id);
            $establishment_entity = $establishment->setEntityManager()->getEntity();
            
            $suite = new Suites;
            $suite->setEntity($establishment_entity, $_POST['title'], $_POST['link_to_booking'], $_POST['description'], $_POST['price']);
            $response = $suite->setEntityManager()->persistEntity();
            var_dump($response);
        }
        catch(Exception $e){
            json_encode($e);            
            http_response_code();
            die();         
        }        
        http_response_code();
        $json = json_encode($response);
        echo $json;
     }
     else{
         http_response_code(403);
         echo json_encode('parameters error');
     }
}
