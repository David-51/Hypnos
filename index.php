<?php
session_start();
require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Manager\Database;
use API\Model\Entity\Establishments;
use API\Model\Manager\Entity;
use Config\Autoloader;

?>
<h1>Home</h1>

<?php

Autoloader::register();
Database::getConnection();

$hotel = new Establishments('Un beau machin', 'paris','ici', 'lorem ipsum');

$em = new Entity($hotel);
$em->persistEntity();

var_dump($hotel->id);
