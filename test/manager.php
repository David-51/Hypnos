<?php

use API\Model\Entity\Administrators;
use API\Model\Entity\Bookings;
use API\Model\Entity\Establishments;
use API\Model\Entity\Managers;
use API\Model\Entity\Suites;
use API\Model\Entity\Users;
use Config\Autoloader;

require './config/Autoloader.php';
require_once './config/apiPathConfig.php';


Autoloader::register();

$user = new Users;
$user->setEntity('David@example.com', 'david', "grignon", "monpass");
$user->setEntityManager()->persistEntity();

$user->setFirstname('Anne-Sophie');
$user->em->updateEntity();

$user->setEmail('anneso@example.com');
$user->em->updateEntity();

$hotel = new Establishments;
$hotel->setEntity('Ma maison', 'Juvigny', '3 rue abbé aubert', 'wonderfull');
$hotel->setEntityManager()->persistEntity();

$manager = new Managers;
$manager->setEntity($user, $hotel);
$manager->persistManager();

$manager->setEmail('maya@example.com');
$manager->updateManager();

$admin = new Administrators;
$admin->setEntity($user);
$admin->persistAdmin();
?>
<h1>Test Booking</h1>
<?php

$suite = new Suites;
$suite->setEntity($hotel, 'Ma plus chambre', 'https://chezmoi.com', 'my wonderfull room', '40000');
$suite->setEntityManager()->persistEntity();

$book = new Bookings;
$book->setEntity($user, $suite, '2022-03-25', '2022-03-30');
$book->setEntityManager()->persistEntity();

$book->setCheckout('2022-04-15');
$book->em->updateEntity();

$book->setCheckin('2022-04-01');
$book->em->updateEntity();
?>
<hr>
<?php
$book->UpdateCalendar();

$book->setCheckout('2022-04-02');
$book->UpdateCalendar();

$book->setCheckout('2022-04-10');
$book->UpdateCalendar();
?>
<hr>
<h2>Get Dates</h2>
<?php
var_dump($suite->getDates());