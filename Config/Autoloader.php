<?php

namespace Config;

class Autoloader
{
    static function register(){        
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    static function autoload($class_name){
        $explode = array_reverse(explode('\\', $class_name));        
        $class = implode('',array_slice($explode, 0, 2));        
        
        // var_dump($class_name);
        // var_dump($explode);
        // var_dump($class);
                        
        $result = substr($class_name, strrpos($class_name, '\\') + 1);   
        require_once $class . '.php';        
    }
}