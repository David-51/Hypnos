<?php
session_start();

// $message = date('d-m-Y'). ' '.$_SERVER['REQUEST_URI'].PHP_EOL;
// error_log($message, 3, './error_log.log');

$route = explode('/', $_SERVER['REQUEST_URI']);

switch ($route) {
    case $route[1] == 'Establishment':
        require('./test/EstablishmentTest.php');        
        break;
    case $route[1] == 'Users':
        require('./test/UserTest.php');
        break;
        case $route[1] == "managers":
            require('./test/manager.php');
            break;     
    default:
    echo "<h1>Home</h1>";
}