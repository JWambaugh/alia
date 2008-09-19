<?php
/**
 * AObject.php - The file for the AObject class
 *  
 * 
 * @author Jordan Wambaugh
 */



require_once 'ASignalDefinition.php';
require_once 'AConnection.php';
require_once 'AObjectRegistry.php';
require_once 'Alia.php';

/**
 * class AObject - The base class for all objects with signal/slot functionality
 * 
 * The AObject class is the base class for all widgets, and any other objects with signal/slot functionality.
 * If you want to create your own object that will emit signals, it must extend AObject, or one of its subclasses.
 * 
 * 
 * @package Alia
 * @subpackage Core
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 */
abstract class AObject
{
	 /*** Attributes: ***/

	/**
	 * an array containing all signal deffinitions
	 * @access private
	 * @var array
	 * 
	 */
	private $__signalDefinitions=array();

	/**
	 * An array containing all connections to this object
	 * @var AConnection
	 * @access private
	 */
	private $__connections=array();

	/**
	 * The unique ID of the object. This value is assigned by AObjectRegistry
	 * @access private
	 */
	private $__objectID;

	/*
	 * adds the object to the object registry. All subclasses must call this.
	 */
	public function __construct(){
		AObjectRegistry::instance()->addObject($this);
	}
	



	/*
	 * returns the object's unique ID
	 */
	public function getObjectID(){
		return $this->__objectID;
	}
	
	/*
	 * sets the object's unique ID
	 */
	public function setObjectID($id){
		$this->__objectID = $id;
	}
	
	/**
	 * Defines a signal that other objects my connect slots to.
	 * @author Jordan Wambaugh <jordan@wambaugh.org>
	 * @param string name 
	 * @param int parameterCount 
	 * @return null
	 * @access public
	 */
	public function defineSignal( $name,  $parameterCount =0) {
		$this->__signalDefinitions[]=new ASignalDefinition($name,$parameterCount);
	} // end of member function defineSignal


	/**
	 * emit() - Emits a signal from this object to all connected slots
	 * 
	 * @author Jordan Wambaugh <jordan@wambaugh.org>
	 * @param string $signalName The name of the signal to emit
	 * @param array $args the arguments to send with the signal
	 * @return null
	 * @access public
	 */
	public function emit( $signalName,$args=array()) {
		if(!$this->__hasSignalDefinition($signalName)){
			throw new Exception("Signal '$signalName' does not exist in class '".get_class($this)."'.");
		}
		$signalName=(string)$signalName;
		
		foreach ($this->__connections as $connection){
			if($connection->getSignalName() == $signalName){
				//if we have a slot method in the connection, execute it. 
				if($connection->getSlotMethod()!=null){
					call_user_func_array(array(&$connection->targetObject,$connection->getSlotMethod()),$args);
				}
				//if there is javascript in the connection, send javascript to client
				if($connection->getJavascript()!=null){
					Alia::sendJScript($connection->getJavascript());
				}
			   }
		  }
	} // end of member function emit


	/**
	 * Adds a slot connection
	 *
	 * @param AConnection $connection The connection to add
	 */
	public function addConnection(AConnection $connection){
		if(!$this->__hasSignalDefinition($connection->getSignalName())){
			throw new Exception("Signal '".$connection->getSignalName()."' does not exist in class '".get_class($this)."'.");
		}
		$this->__connections[]=$connection;
	}
	
	
	
	/**
	 * Returns true if there is a connection to a signal specified by $signalName 
	 *
	 * @param string $signalName The name of the signal to search for
	 * @return bool True if there is a connection to the signal $signal
	 */
	public function hasConnection($signal){
		foreach ($this->__connections as $connection){
			if($connection->getSignalName() == $signal){
				return true;
			}
		}
		return false;
	}
	
	/**
	 *
	 * @param string $name
	 * @return bool True if the signal is defined in the object
	 */
	private function __hasSignalDefinition($name){
		foreach ($this->__signalDefinitions as $definition) {
			if($definition->getName()){
				return true;
			}
		}
		return false;
	}

	public function clearConnections(){
		AConnectionRegistry::instance()->clearConnections($this);
		unset($this->__connections);
	}
	
	/**
	 * Clears all data in the object and attempts to remove all references to itself.
	 * Note that this object should not be used at this point, but should be unset.
	 */
	public function clear(){
		  $this->clearConnections();
		  unset($this->__connections);
		  unset($this->__objectID);
		  unset($this->__signalDefinitions);
		  AObjectRegistry::instance()->clearObject($this);
	}
	
	function __destruct(){
	}
	
} // end of AObject
?>
