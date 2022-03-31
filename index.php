<?php
session_start();

use Assets\Autoloader;

require './Client/Assets/Autoloader.php';
require './Client/Config/pathConfig.php';

Autoloader::register();
// var_dump($_GET);

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
    case 'home':
        require 'HomeController.php';
        break;
    case 'send':
        echo "send message";
        die();
        require 'SendMessagesController.php';
        break;
    default:
        require 'HomeController.php';    
    }