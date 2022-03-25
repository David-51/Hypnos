<?php

use API\Model\Entity\Administrators;
use API\Model\Entity\Establishments;
use API\Model\Entity\Managers;
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
$hotel->setEntity('Ma maison', 'Juvigny', '3 rueabbé aubert', 'wonderfull');
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

$date1 = new DateTime('2022-03-25');
$date2 = new DateTime('2022-03-28');

var_dump(date_diff($date1, $date2)->d);



