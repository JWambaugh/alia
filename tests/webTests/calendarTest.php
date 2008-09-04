<?php
//setup alia
error_reporting(E_ALL);
require_once '../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");

AApplication::instance()->setFrontURL('/alia/tests/webTests/front.php');



session_start();
$_SESSION['alia']=array();

//create a login widget
$widget = new ACalendar();

//create a window
$window = new AWindow();

$window->setTitle('Calendar');
$window->setMainWidget($widget);
$window->toggleDraggable();
$window->setAttribute('style','width:250px;border-style: ridge');



Alia::setMainWidget($window);

Alia::run();


