<?php
session_start();

$route = explode('/', $_SERVER['REQUEST_URI']);

switch ($route) {
    case $route[1] == 'Establishment':
        require('./test/EstablishmentTest.php');        
    break;    
    default:
    echo "<h1>Home</h1>";
}