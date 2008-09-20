<?php
/**
 * Main include for Alia
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @since 2-25-08
 * @package Alia
 */





/**
 * Load Dependancies
 */
require_once 'ALoader.php';
require_once 'AObject.php';
require_once 'AConnection.php';
require_once 'AApplication.php';
Alia::setLibPath(dirname(__FILE__));

/**
 * Facade for main Alia interface. 
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Core
 * @since 2-25-08
 */
class Alia{
	
	
	/**
	 * Connects a slot (javascript, PHP, or both) to a signal.
	 * @author Jordan Wambaugh <jordan@wambaugh.org>
 	 * @since 2-25-08
	 * @param AObject The object emitting the signal
	 * @param string The signal being emitted from the object
	 * @param AObject|null The object receiving the signal (null id none)
	 * @param string|null The method of the object (the slot) to receive the signal
	 * @param string|null The javascript to execute when the signal is emitted (if any) 
	 * @return null
	 * @access public
	 */
	public static function connect($source,  $signal, $target,  $slotMethod ,$jscript=null) {
		$connection =new AConnection($target,$slotMethod,$source,$signal,$jscript);
		AConnectionRegistry::instance()->addConnection($connection);
		if($source !=="*"){
			$source->addConnection($connection);
		}
	} // end of member function connect

	
	/**
	 * Helper function to start the AApplication
	 *
	 * Execute this function to render your application. 
	 * This is usually the last function called in an Alia application.
	 */
	public static function run(){
		AApplication::instance()->run();
	}
	
	/**
	 * Sets the main widget for the application
	 *
	 * @param AWidget $mainWidget
	 */
	public static function setMainWidget(AWidget $mainWidget){
		AApplication::instance()->setMainWidget($mainWidget);
	}

	
	/**
	 * Sets the location of Alia's lib directory into the loader.
	 *
	 * This is normall done automatically, based off the location of Alia.php
	 * 
	 * @param mixed $path 
	 * @static
	 * @access public
	 * @return void
	 */
	public static function setLibPath($path){
		ALoader::instance()->setLibPath($path);
	}

	/**
	 * loads the alia front code - essential for ajax funcitonality
	 *
	 * The front script handles all ajax calls and javascript includes required for Alia.
	 * It is essential to have a front script in your document root, normally called "front.php" 
	 * (a different name may be used, but front.php is the default. See AApplication for 
	 * information on how to change it). This script should include Alia.php and then call this function.
	 * everything else will be handled by Alia fro that point.
	 */
	public static function loadFront(){
		ALoader::instance()->includeFile('AliaFront.php');
	}

	
	/**
	 * Sends javascript to the output buffer.
	 *
	 * Call this function when you want to send javascript to the client to be executed.
	 * 
	 * @param string $script 
	 * @access public
	 * @return void
	 */
	public static function sendJScript($script){
		AJScriptBuffer::instance()->addJScript($script);
	}


	/**
	 * Adds a search path to Alia's loader (to automatically load your custom widgets, etc) 
	 *
	 * @param mixed $path 
	 * @static
	 * @access public
	 * @return void
	 */
	public static function addIncludePath($path){
		ALoader::instance()->addPathToBeginning($path);
	}


	/**
	 * Starts the session, only if it hasn't been started already 
	 * 
	 * @access public
	 * @return void
	 */
	public static  function startSessionOnce(){
		if(!session_id()){
			session_start();
		}
	}


	public static function clear(){
		self::startSessionOnce();
		AObjectRegistry::instance()->clearAllObjects();
		$_SESSION['alia']=null;
	}
}

?>
