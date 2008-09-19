<?php
require_once 'Alia.php';

if(isset($_GET['jscript'])&&count($_GET['jscript'])){
	header('Cache-Control: public, max-age=9000');
	foreach($_GET['jscript'] as $script){
		readfile( ALoader::instance()->getFilePath("jscript/$script"));
	}
	exit;
}
//error_reporting(0);

Alia::startSessionOnce();
if(isset($_REQUEST['triggeredConnections']) && is_array($_REQUEST['triggeredConnections']))
foreach ($_REQUEST['triggeredConnections'] as $conn){
	$params = explode('-|-',$conn);
	$conn = $params[0];
	//shift the name of the connection out of the params
	array_shift($params);
	$connection = AConnectionRegistry::instance()->getConnectionByID($conn);
	if(is_object($connection)){
		call_user_func_array(array(&$connection->targetObject,$connection->getSlotMethod()),$params);
	}else{
		throw new Exception("Connection of ID '{$conn}' not found!");
	}
}

$buffer = AJScriptBuffer::instance()->getJScript();
if($buffer != ''){
	echo $buffer;
}

//file_put_contents('/tmp/session',serialize($_SESSION['alia']));

?>
