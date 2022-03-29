<?php

namespace API\Model\Manager;

class Database
{
    const DSN = 'mysql:dbname=hypnos;host:127.0.0.1';
    const USERNAME = 'admin';
    const PASSWORD = 'admin';
    
    public static $pdo = null;
    
    private static function connect() :\PDO
    {
        if(!(self::$pdo)){                        
            try{
                self::$pdo = new \PDO(self::DSN, self::USERNAME, self::PASSWORD);                
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            catch(\PDOException $e){
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