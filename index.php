<?php
session_start();
require './config/Autoloader.php';

use API\Model\Manager\DatabaseManager;
use API\Model\Entity\EstablishmentEntity;
use API\Model\Manager\EntityManager;
use Config\Autoloader;

?>
<h1>Home</h1>

<?php

require_once './config/apiPathConfig.php';

Autoloader::register();
DatabaseManager::getConnection();

$hotel = new EstablishmentEntity('palace', 'paris','ici', 'lorem ipsum');

$em = new EntityManager($hotel);
var_dump($em->getEntityName());