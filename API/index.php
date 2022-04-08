<?php
session_start();

use API\Assets\Autoloader;

require './Config/pathConfig.php';
require './Assets/Autoloader.php';

http_response_code(202);
Autoloader::register();

switch (strtolower($_GET['main'])) {
    case 'booking':                
        require './controller/BookingController.php';
        break;
    case 'pictures':
        switch ($_GET['level2']){
            case 'add':                       
                require './controller/PicturesAddController.php';
                break;
            case 'update':
                require './controller/PicturesUpdateController.php';
                break;
            case 'delete':
                require './controller/PicturesDeleteController.php';
                break;
                default:
                http_response_code(400);
                echo json_encode('Pictures bad request');
        }
        break;
    case 'create-account':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './controller/CreateAccountController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'send-message':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './controller/SendMessageController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './controller/LoginController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'establishment':
        switch ($_GET['level2']){
            case 'update':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/EstablishmentUpdateController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/EstablishmentDeleteController.php';
                }
                break;
            case 'add':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                              
                    require './controller/EstablishmentAddController.php';
                }
                break;
            case 'suites':                                            
                require './controller/EstablishmentSuitesController.php';
                
                break;

            default:
                require './controller/EstablishmentController.php';        
                break;
        }
        break;
    case 'manager':
        switch ($_GET['level2']){
            case 'add':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/ManagerAddController.php';
                }
                break;
            case 'update':                
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/ManagerUpdateController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/ManagerDeleteController.php';
                }
                break;
            default:
            if(isset($_GET['id'])){
                require './controller/ManagerGetController.php';            
            }
            else{
                echo json_encode('no enough parameters');                
                http_response_code(403);
            }
        }
        break;
    case 'messages':
        switch ($_GET['level2']){
            case 'done':
                require './controller/MessagesDoneController.php';
                break;
            case 'delete':
                require './controller/MessagesDeleteController.php';
                break;
            default:
            http_response_code(403);
            echo json_encode('invalid parameters');
        }
        break;
    case 'suites':
        switch ($_GET['level2']){
            case 'add':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/SuitesAddController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/SuitesDeleteController.php';
                }
                break;
            case 'update':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './controller/SuitesUpdateController.php';
                }
                break;                
            default:
            require './controller/SuitesController.php';            
        }
    break;
    default:
    echo json_encode('Mauvaise route...');
    http_response_code(403);
}
if(isset($message)){
    logger($message);
}