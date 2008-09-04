<?php

error_reporting(E_ALL);
require_once '../../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");

AApplication::instance()->setFrontURL('/alia/tests/webTests/scripts/front.php');
require_once("/home/jordan/Doctrine-0.11.0/lib/Doctrine.php");
spl_autoload_register(array("Doctrine", "autoload"));
Doctrine_Manager::connection('mysql://root:elizabeth@localhost/test');
$arr= unserialize(file_get_contents('/tmp/session'));
print_r($arr);



?> 
