<?php
$start = microtime(true);
// créer des entities à la racine conduit à double l'entité à cause de la redirection htaccess

require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Entity\Establishments;
use API\Model\Entity\Suites;
use API\Model\Manager\Entity;
use Config\Autoloader;

Autoloader::register();
?>
<h1>Test page</h1>
<H2>Route</H2>
<?php
var_dump($_SERVER['REQUEST_URI']);
?>
<hr>
<H2>Créer une entité Hotel</H2>
<?php
var_dump($hotel = new Establishments);
?>
<hr>
<H2>SetEntity Hotel</H2>
<?php
var_dump($hotel->setEntity('**** Le Sublime ****', 'Juvigny', '3 rue de abbé aubert', 'un truc vraiment génial'));
?>
<hr>
<H2>Créer un EntityManager Hotel</H2>
<?php
var_dump($em = new Entity($hotel));
?>

<hr>
<H2>
    getEntity Hotel
</H2>
<?php
    var_dump($em->getEntity());
?>

<hr>
<H2>Modifier le nom d'un hotel et persister</H2>
<?php
    var_dump($hotel->setName('--- Le futur supprimé ---'));
?>
<H2>
    Persite le l'entité Hotel via EntityManager
</H2>
<?php
    var_dump($em->persistEntity());
?>
<hr>
<h2>
    Delete Entity
</h2>
<?php
    var_dump($em->deleteEntity());
?>
<hr>

<h1>Suites</h1>
<h2>Créer une suite</h2>
<?php
    var_dump($suite = new Suites);
?>
<hr>

<h2>SetEntity de la suite</h2>
<?php
    var_dump($suite->setEntity($hotel, 'La Chambre du bonheur', 'https://awesome.com', 'lorem ipsum dolore', '30000'));
?>
<hr>
<h2>Ajout ET Setting d'une seconde suite</h2>
<?php
    $second_suite = new Suites;
    var_dump($second_suite->setEntity($hotel, 'The Dungeon', 'https://awesome.com', 'lorem ipsum dolore', '30000'));
?>
<hr>
<h2>
    Affichage des 2 suites
</h2>
<?php
var_dump($hotel->suites);
?>
<hr>
<h2>Remove the first suite</h2>
<?php
var_dump($suite->removeSuite());


$finish = microtime(true) - $start;;
echo 'finish in '. $finish .'ms';