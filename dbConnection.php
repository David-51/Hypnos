<?php
namespace dbConnection;

class DbConnection
{
    /**
     * constant to configure the PDO connection to database
     * refer to https://www.php.net/manual/fr/pdo.construct.php
     */

    // const DSN = 'mysql:dbname=hypnos;host:127.0.0.1;charset=UTF8';
    // const USERNAME = 'uername';
    // const PASSWORD = 'password';
    const DSN = 'mysql:dbname=hypnos;host:127.0.0.1;charset=UTF8';
    const USERNAME = 'admin';
    const PASSWORD = 'admin';
}