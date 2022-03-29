<?php
session_start();

use Assets\Autoloader;

require './Client/Assets/Autoloader.php';
require './Client/Config/pathConfig.php';

Autoloader::register();

switch ($_GET['main']) {
    case 'connect':
        require 'SignInController.php';
        break;
        
        default:
        echo "<h1>Erreur Hypnos Home</h1> ";
    }