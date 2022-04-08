<?php

use API\Model\Entity\Establishments;

$establishment = new Establishments;
    if(!isset($_GET['id'])){
        http_response_code(400);        
    }
    else{
        $establishment->setId($_GET['id']);
        $suite = $establishment->getSuites();
        
        http_response_code(200);
        echo json_encode($suite);

    }