<?php

namespace Config;

class Autoloader
{
    static function register(){
        // echo "autoloader <br>";
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    static function autoload($class_name){
        $result = substr($class_name, strrpos($class_name, '\\') + 1);        
        require_once $result . '.php';        
    }
}