<?php

namespace API\Model\Manager;

use dbConnection\DbConnection;

class Database
{

    const DSN = DbConnection::DSN;
    const USERNAME = DbConnection::USERNAME;
    const PASSWORD = DbConnection::PASSWORD;
     
    public static $pdo = null;
    
    private static function connect() :\PDO
    {
        if(!(self::$pdo)){                        
            try{
                self::$pdo = new \PDO(self::DSN, self::USERNAME, self::PASSWORD);                
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
