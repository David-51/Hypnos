<?php

$path = [
    'API/model/Entities',
    'API/model/Manager',
    'API/Model',
    'API/Controller'
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
