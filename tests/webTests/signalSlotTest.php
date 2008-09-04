<?php
//setup alia
error_reporting(E_ALL);
require_once '../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");
ALoader::instance()->addPathToEnd(dirname(__FILE__));
AApplication::instance()->setFrontURL('/alia/tests/webTests/front.php');



session_start();
$_SESSION['alia']=array();


$widget = new testWidget();


Alia::connect($widget,'SomthingHappend',null,null,AJScript::alert('somthing happend!'));
$widget->emit('SomthingHappend');


Alia::setMainWidget($widget);

Alia::run();



?>
