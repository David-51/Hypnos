<?php
session_start();

use API\Assets\Autoloader;

require './Assets/Autoloader.php';
require './Config/pathConfig.php';

Autoloader::register();
http_response_code(202);

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
    default:
        echo json_encode('Mauvaise route...');
    }