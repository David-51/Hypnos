<?php
session_start();

$route = explode('/', $_SERVER['REQUEST_URI']);

switch ($route) {
    case $route[1] == 'test':
        require('test.php');
    break;

    default:
    echo "<h1>Home</h1>";
}