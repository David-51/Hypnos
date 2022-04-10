<?php

$path = [
    // need add ../ because the entry API/index is one level higher
    '../API/Model/Entities',
    '../API/Model/Manager',
    '../API/Model',
    '../API/Controller',
    '../API/Assets'
];

function addpath($path){    
    foreach($path as $value) {        
        set_include_path(
            get_include_path().PATH_SEPARATOR.$value
        );
    }
    
}
addpath($path);
