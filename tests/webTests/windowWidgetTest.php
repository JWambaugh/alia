<?php
//setup alia
error_reporting(E_ALL);
require_once '../../lib/Alia.php';
//Alia::setLibPath("./alia/lib");
ALoader::instance()->addPathToEnd(dirname(__FILE__));
AApplication::instance()->setFrontURL('/alia/tests/webTests/front.php');



session_start();
$_SESSION['alia']=array();


$mainWidget = new ASortableList();


for($x=0;$x<10;$x++){
	//create a window
	$window = new AWindow();

	$window->setTitle('Login Window (drag me!)');
	$window->setMainWidget(new ALoginWidget());
	//$window->toggleDraggable();
	$window->setAttribute('style','width:250px;border-style: ridge; float:left');
	
	$mainWidget->getLayout()->addWidget($window);
}

Alia::setMainWidget($mainWidget);

Alia::run();


