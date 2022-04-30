<?php
namespace API\Model\Manager;

class Database
{
     
    public static $pdo = null;
    
    private static function connect() :\PDO
    {
        if(!(self::$pdo)){                        
            try{                             
                self::$pdo = new \PDO($_ENV['BDD_DSN'], $_ENV['BDD_USERNAME'], $_ENV['BDD_PASSWORD']);                
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(\PDOException $e){
                http_response_code(404);
                echo "Error de connexion <br>". $e;
            }
            return self::$pdo;
        }
        else {            
            // echo "connecté";
            return self::$pdo;
        }
    }

    public static function getConnection() :\PDO
    {
        return self::connect();
    }
}
