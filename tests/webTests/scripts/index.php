<?php
//setup alia
error_reporting(E_ALL);
require_once '../../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");

AApplication::instance()->setFrontURL('/alia/tests/webTests/scripts/front.php');
require_once("/home/jordan/Doctrine-0.11.0/lib/Doctrine.php");
spl_autoload_register(array("Doctrine", "autoload"));
Doctrine_Manager::connection('mysql://root:elizabeth@localhost/test');
session_start();
$_SESSION['alia']=array();
$widget = new UserWidget();


Alia::setMainWidget($widget);

Alia::run();



?>
