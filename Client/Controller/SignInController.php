<?php

// définition des contents Header / Body / Footer

use Client\Controller\Template;

$view = new Template;

// $view->setHeader('headerTemplate', []);
// $view->setFooter('footerTemplate', []);
// $view->setBody('')
?>
<?= $view->getContent(); ?>


