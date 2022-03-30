<?php

use API\Controller\Establishments;
use API\Model\Entity\Establishments as EntityEstablishments;

$establishments = new Establishments(new EntityEstablishments);
$establishments->getEtablishments();

$list = $establishments->list;

var_dump($list);