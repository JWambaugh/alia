<?php
error_reporting(E_ALL);
include '../../../lib/Alia.php';
require_once("/home/jordan/Doctrine-0.11.0/lib/Doctrine.php");
spl_autoload_register(array("Doctrine", "autoload"));
Doctrine_Manager::connection('mysql://root:elizabeth@localhost/test');
Alia::loadFront();

?>
