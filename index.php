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
<h4>Créer une entité Hotel</h4>
<?php
var_dump($hotel = new Establishments);
?>
<hr>
<h4>SetEntity Hotel</h4>
<?php
var_dump($hotel->setEntity('**** Le Sublime ****', 'Juvigny', '3 rue de abbé aubert', 'un truc vraiment génial'));
?>
<hr>
<h4>Créer un EntityManager Hotel</h4>
<?php
var_dump($em = new Entity($hotel));
?>
<hr>
<h4>
    getEntity Hotel
</h4>
<?php
var_dump($em->getEntity());
?>
<hr>
<h4>Modifier le nom d'un hotel et persister</h4>
<?php
var_dump($hotel->setName('--- Le Mervailleur ---'));
?>
<h4>
    Persite le l'entité Hotel via EntityManager
</h4>
<?php
var_dump($em->persistEntity());
?>
<h2>test</h2>


