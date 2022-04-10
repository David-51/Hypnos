<?php
session_start();

use API\Assets\Autoloader;

require './Config/pathConfig.php';
require './Assets/Autoloader.php';

http_response_code(202);
Autoloader::register();

switch (strtolower($_GET['main'])) {
    case 'booking':                
        switch ($_GET['level2']){
            case 'delete':
                http_response_code(400);
                require './Controller/BookingDeleteController.php';
                break;
            default:
            require './Controller/BookingController.php';
        }        
        break;
    case 'pictures':
        switch ($_GET['level2']){
            case 'add':                       
                require './Controller/PicturesAddController.php';
                break;
            case 'update':
                require './Controller/PicturesUpdateController.php';
                break;
            case 'delete':
                require './Controller/PicturesDeleteController.php';
                break;
                default:
                http_response_code(400);
                echo json_encode('Pictures bad request');
        }
        break;
    case 'create-account':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './Controller/CreateAccountController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'send-message':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './Controller/SendMessageController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './Controller/LoginController.php';
        }
        else{
            echo json_encode('Request Method Error');
        }
        break;
    case 'establishment':
        switch ($_GET['level2']){
            case 'update':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/EstablishmentUpdateController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/EstablishmentDeleteController.php';
                }
                break;
            case 'add':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                              
                    require './Controller/EstablishmentAddController.php';
                }
                break;
            case 'suites':                                            
                require './Controller/EstablishmentSuitesController.php';
                
                break;

            default:
                require './Controller/EstablishmentController.php';        
                break;
        }
        break;
    case 'manager':
        switch ($_GET['level2']){
            case 'add':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/ManagerAddController.php';
                }
                break;
            case 'update':                
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/ManagerUpdateController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/ManagerDeleteController.php';
                }
                break;
            default:
            if(isset($_GET['id'])){
                require './Controller/ManagerGetController.php';            
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
                require './Controller/MessagesDoneController.php';
                break;
            case 'delete':
                require './Controller/MessagesDeleteController.php';
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
                    require './Controller/SuitesAddController.php';
                }
                break;
            case 'delete':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/SuitesDeleteController.php';
                }
                break;
            case 'update':
                if($_SERVER['REQUEST_METHOD'] === 'POST'){                    
                    require './Controller/SuitesUpdateController.php';
                }
                break;                
            default:
            require './Controller/SuitesController.php';            
        }
    break;
    default:
    echo json_encode('Mauvaise route...');
    http_response_code(403);
}
