<?php
session_start();

use API\Assets\Autoloader;

require './Config/pathConfig.php';
require './Assets/Autoloader.php';

http_response_code(202);
Autoloader::register();

switch (strtolower($_GET['main'])) {
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
    default:
    http_response_code(403);
        echo json_encode('Mauvaise route...');
    }