<h1>API</h1>
<?php

require_once '../config/apiPathConfig.php';
$request_uri = $_SERVER['REQUEST_URI'];

var_dump($_GET);

var_dump($request_uri);

$uri_table = array_slice(explode('/', $request_uri), 2);

// Home Router

switch ($uri_table[0]){
    case 'establishments':
        echo 'establishments...';
        // require './Controller/establishmentsController.php';
        // code
        break;
    case 'suites':
        echo 'suites...';
        //code
        break;
    case 'admins':
        //code
        break;
    case 'managers':
        //code
        break;
    case 'users' :
        // code
        break;
    case 'bookings':
        // code
        break;
    case 'pictures':
        // code
        break;
    case 'messages':
        // code
        break;
    default:
}
