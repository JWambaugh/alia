<?php
//setup alia
error_reporting(E_ALL);
require_once '../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");

AApplication::instance()->setFrontURL('/alia/tests/webTests/front.php');



session_start();
$_SESSION['alia']=array();


$widget = new testWidget();

$timer = new ATimer(9000);

$buton = new APushButton('stop timer');
Alia::connect($buton,'clicked',$timer,'stop');
$widget->getLayout()->addWidget($buton,20,20);
$timer->start();
Alia::connect($timer,'timeout',null,null,AJScript::alert('hello world'));
Alia::setMainWidget($widget);

Alia::run();



?>