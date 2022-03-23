<?php
$start = microtime(true);
// créer des entities à la racine conduit à double l'entité à cause de la redirection htaccess

require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Entity\Establishments;
use API\Model\Entity\Pictures;
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
    Delete Entity - entity $hotel deleted
</h2>
<?php
    var_dump($em->deleteEntity());    
?>
<hr>
<h2>
    Recréation de l'entité hotel et persist
</h2>
<?php
$em = new Entity($hotel);
$hotel->setName('MOn nouveau HOTEL');
var_dump($em->persistEntity());
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
    var_dump($suite->setEntity($hotel, 'Le test de 18h27', 'https://awesome.com', 'lorem ipsum dolore', '30000'));
?>
<hr>
<h2>Ajout ET Setting d'une seconde suite</h2>
<?php
    $second_suite = new Suites;
    var_dump($second_suite->setEntity($hotel, 'The Dungeon', 'https://awesome.com', 'lorem ipsum dolore', '30000'));
?>
<hr>
<h2>
    Persist des suites
</h2>
<?php
    $un = $suite->setEntityManager();
    var_dump($un->persistEntity());

    $deux = $second_suite->setEntityManager();
    $deux->persistEntity();
?>
<h2>Voir les suites</h2>
<?php
    var_dump($hotel->getSuites());
?>
<h2>
    Voir l'hotel
</h2>
<?php
    
    var_dump($hotel);
?>
<hr>
<h2>Remove the first suite</h2>
<?php
    $un->deleteEntity();
?>
<hr>
<h2>Afficher toutes les suites</h2>
<?php

// $newSuite = new Suites;
var_dump($em->getChilds($suite));

?><hr><?php
var_dump($hotel->getSuites());
?>
<h2>Persist Suite dans la BDDD</h2>
<?php

$my_hotel = new Establishments();
$my_hotel->setEntity('Le magnifique', 'Juvigny', '3 rue abbé abbert', 'ma maison');
$em_my_hotel = new Entity($my_hotel);

$em_my_hotel->persistEntity();

$my_suites = new Suites;
$my_suites->setEntity($my_hotel, 'La lovely suite', 'https://booking.com', 'lorem hypsum dolore', 35000);
$em_my_suites = new Entity($my_suites);

$em_my_suites->persistEntity();

var_dump($my_hotel->getSuites());
?>
<hr>
<h1>Test des Pictures_link</h1>
<h2>création de picture link</h2>
<?php
var_dump($picture = new Pictures);
?>
<hr>
<h2>Set Picture Link</h2>
<?php
var_dump($my_suites->id);
var_dump($picture->setEntity($my_suites, 'https://picsum.photos/200/300'));
?>
<hr>
    <h2>Persist Picture link</h2>
<hr>
<?php
var_dump($em_picture = $picture->setEntityManager()->persistEntity());
?>
<hr>
<h2>Création de 3 links supplémentaires (4 au total)</h2>
<?php
$first_link = new Pictures();
$first_link->setEntity($my_suites, 'https://picsum.photos/200/300')->setEntityManager()->persistEntity();
$second_link = new Pictures();
$second_link->setEntity($my_suites, 'https://picsum.photos/200/300')->setEntityManager()->persistEntity();
$third_link = new Pictures();
$third_link->setEntity($my_suites, 'https://picsum.photos/200/300')->setEntityManager()->persistEntity();
?>
<hr>
<h2> affichage Picture link</h2>
<?php
    var_dump($my_suites->getLinks());

?>
 <h2>Delete first Picture link (reste 3)</h2>
<?php
var_dump($first_link->em->deleteEntity());
?>
<hr>
<h2>Affichage des 3 links</h2>
<?php

var_dump($my_suites->getLinks());
var_dump($my_suites);

$finish = microtime(true) - $start;
echo 'finish in '. $finish .'ms';