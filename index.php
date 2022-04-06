<?php
session_start();

use API\Model\Entity\Administrators;
use Assets\Autoloader;

require './Client/Assets/Autoloader.php';
require './Client/Config/pathConfig.php';

Autoloader::register();


switch (strtolower($_GET['main'])) {
    case 'test':
        require './test/test.php';
        break;
    case 'connect':
        require 'SignInController.php';
        break;
    case 'establishments':
        require 'EstablishmentsListController.php';
        break;
    case 'suites':
        require 'SuitesListController.php';
        break;
    case 'carousel':
        require 'test/carousel.html';
        break;
    case 'signin':
        require 'SignInController.php';
        break;
    case 'login':
        require 'LogInController.php';
        break;
    case 'logout':
        session_destroy();
        header('Location: /login');        
        break;
    case 'home':
        require 'HomeController.php';
        break;
    case 'send-messages':
        require 'SendMessagesController.php';
        break;
    case 'bookings':
        require 'BookingsController.php';
        break;
    // Administrators
    case 'admin':
        if($_SESSION['role'] !== 'adm'){
            header('Location: /');            
        }
        switch ($_GET['level2']){
            case 'establishments':
                require 'AdminEstablishmentsController.php';
                break;
            case 'managers':
                require 'AdminManagersController.php';
                break; 
            case 'messages':
                require 'AdminMessagesController.php';
                break;

            default :
            require 'AdminEstablishmentsController.php';
        

        }
    break;
    case 'manager':
        if($_SESSION['role'] !== 'man'){
            header('Location: /');
        }
        switch ($_GET['level2']){
            case 'test':
                break;

            default:
                require 'ManagerSuitesController.php';

        }        
        
    default:
        require 'HomeController.php';    
    }