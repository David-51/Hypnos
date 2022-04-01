<?php
namespace API\Assets;

class Autoloader
{
    static function register(){        
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    static function autoload($class_name){
        
        $explode = array_reverse(explode('\\', $class_name));
        $class = implode('',array_slice($explode, 0, 2));       
        
        require_once $class . '.php';        
    }
}