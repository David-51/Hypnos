<?php

use API\Assets\Autoloader;
use API\Model\Entity\Users;

session_start();

require './Assets/Autoloader.php';
require './Config/pathConfig.php';

Autoloader::register();

switch (strtolower($_GET['main'])) {
    case 'create-account':
        // if($_SERVER['REQUEST_METHOD'] === 'POST'){
            require './controller/CreateAccountController.php';
        // }
        // else{
        //     echo 'Request Method Error';
        // }
        break;
    
    default:
        echo 'je suis une erreur';    
    }