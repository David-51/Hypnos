<?php
$start = microtime(true);

require './config/Autoloader.php';
require_once './config/apiPathConfig.php';

use API\Model\Entity\Administrators;
use API\Model\Entity\Establishments;
use API\Model\Entity\Managers;
use API\Model\Entity\Messages;
use API\Model\Entity\Users;
use Config\Autoloader;

Autoloader::register();
?>
<h1>Users Test</h1>
<h2>Création d'un user</h2>
<?php
$user = new Users;
var_dump($user->setEntity('david@example.com', 'David', 'moimeme', '---- Je suis un passsword ----'));
$user->setEntityManager()->persistEntity();
?>
<h2>Modifier quelques champs ...</h2>
<?php
var_dump(
    $user->setFirstname('Biloute'), 
    $user->setLastname('la biroute'),
    $user->setEmail('biloute@example.com'),    
    $user);
?>
<h2>Update le user</h2>
<?php
var_dump($user->em->updateEntity());
?>
<h2>Delete le user</h2>
<?php
var_dump($user->em->deleteEntity());
?>
<h2>Recréation du user</h2>
<?php
var_dump($user->em->persistEntity());
?>
<h2>Affichage de tous les users en BDD</h2>
<?php
var_dump($user->em->getEntity());
?>
<h2>Création d'un admin à partir du User</h2>
<?php
var_dump($admin = new Administrators);
?>
<h2>Hydratation de l'admin</h2>
<?php
var_dump($user);
var_dump($admin->setEntity($user));
?>
<h2>58 Persist Admin</h2>
<?php
var_dump($admin->persistAdmin());
?>

<h2>Modifier le prénom de l'admin</h2>
<?php

var_dump($user->setFirstname('Updated !'));

var_dump($user);
?>
<h2>Update Admin uniquement firstname</h2>
<?php
var_dump($user->setEntityManager()->updateEntity($user->email, ['firstname']));
?>
<h2>
    Mofification email de le l'utilisateur
</h2>
<?php
var_dump($user->setEmail('newEmail@example.com'));
?>
<h2>
    Update de lam mauvaise ligne (firstname), l'objet user doit contenir le nouveau mail mais l'array datas ne doit pas être modifié
</h2>
<?php
var_dump($user->em->updateEntity($user->email, ['firstname']));
?>
<h2>
    Update de l'entité User pour mettre à jour le mail cette fois-ci
</h2>
<?php
var_dump($user->em->updateEntity());
var_dump($user->setEmail('--newEmail@example.com---'));
var_dump($user->em->updateEntity());
?>
<h1>
    Les messages
</h1>
<h2>
    Création d'une entité message
</h2>
<?php
var_dump($message = new Messages);
?>
<h2>
    Hydratation de l'entité message
</h2>
<?php
var_dump($message->setEntity($user, 'Ceci est mon premier message, hello World !'));
?>
<h2>
    persist du message
</h2>
<?php
var_dump($message->setEntityManager()->persistEntity());
?>
<h2>Modification du message</h2>
<?php
var_dump($message->setMessage('Je suis une modification'));

var_dump($message->em->updateEntity());
?>
<?php
var_dump($message->em->deleteEntity());
var_dump($message);
?>
<h2>user</h2>
<?php
var_dump($user);
?>
<?php die(); ?>
<h2>Delete USER</h2>
<?php
var_dump($user->em->deleteEntity());
?>
<h2>
    Get Messages
</h2>
<?php
$message2 = new Messages;
$message2->setEntity($user, 'Je suis le second message de test');
$message2->setEntityManager()->persistEntity();
$message->em->deleteEntity();
var_dump($user->getMessages());
?>
<h2>
    Création d'un Manager Vide
</h2>
<?php
$manager = new Managers;
var_dump($manager);
?>
<h2>Création d'un hotel pour le manager</h2>
<?php
$hotel = new Establishments;
$hotel->setEntity('Le Magnifique', 'Juvigny', "3 rue abbé aubert", 'une superbe place pour s\'encanailller');
$hotel->setEntityManager()->persistEntity();
?>
<h2>Hydratation Manager</h2>
<?php
var_dump($manager->setEntity($user, $hotel));
?>
<h2>Persist Manager</h2>
<?php
var_dump($manager->setEntityManager()->persistEntity());
?>
<h2>
    Affichage de tous les managers
</h2>
<?php
$manager_list = $manager->setEntityManager()->getEntity();
?>
<h2>Affichage d'un manager de la liste</h2>
<?php

var_dump($manager_list[1][0]);
?>
<h2>Modification du manager</h2>
<?php
$manager->setEmail('MonAwesomeManager@example.com');
var_dump($manager->updateManager());



$finish = microtime(true) - $start;
echo 'finish in '. $finish .'ms';

