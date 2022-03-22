<?php

// créer des entities à la racine conduit à double l'entité à cause de la redirection htaccess

session_start();
require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Entity\Establishments;
use API\Model\Manager\Entity;
use Config\Autoloader;

Autoloader::register();
?>
<h1>Test page</h1>
<h4>Récupérer la liste de tous les hotels</h4>
<?php
$hotel = new Establishments;
$hotel->setEntity('**** Le Sublime ****', 'Juvigny', '3 rue de abbé aubert', 'un truc vraiment génial');
$em = new Entity($hotel);
$em->getEntity();
// var_dump($hotel);
?>
<hr>
<h4>Modifier le nom d'un hotel et persister</h4>
<?php
$hotel->setName('--- Le Mervailleur ---');
$em->persistEntity();
// var_dump($hotel);
?>
<h2>test</h2>


