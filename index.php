<?php
session_start();
require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Manager\Database;
use API\Model\Entity\Establishments;
use API\Model\Manager\Entity;
use Config\Autoloader;

Autoloader::register();
?>
<h1>Home</h1>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, repellendus.
<?php
$hotel = new Establishments('le montreal', 'Paris', '3 rue des champs', 'awesome place');


$em = new Entity($hotel);

$db = Database::getConnection();
var_dump($em->getEntity());

class test {
    public string $id;
    public string $name;
    public string $city;
    public string $adress;
    public string $description;
}


// $sth = $db->prepare("SELECT * FROM establishments");
// $sth->execute();
// $result = $sth->fetchAll(PDO::FETCH_CLASS, 'test');

// var_dump($result);