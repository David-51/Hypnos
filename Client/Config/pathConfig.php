<?php

$path = [
    'Client/Assets',
    'Client/Controller',
    'Client/public/views',  
    'Client/public/css'  
];

function addpath($path){    
    foreach($path as $value) {        
        set_include_path(
            get_include_path().PATH_SEPARATOR.$value
        );
    }
    // echo get_include_path();
}
addpath($path);