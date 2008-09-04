<?php
//setup alia
error_reporting(E_ALL);
require_once '../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");
AApplication::instance()->setFrontURL('/alia/tests/webTests/front.php');

session_start();
$_SESSION['alia']=array();


$widget = new loginWidgettestWidget();


Alia::setMainWidget($widget);

Alia::run();



?>
