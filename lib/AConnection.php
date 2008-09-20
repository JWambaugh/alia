<?php
/**
 *  
 */

require_once 'AConnectionRegistry.php';
require_once 'ASignalDefinition.php';


/**
 * AConnection 
 * 
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class AConnection
{

	 /*** Attributes: ***/

	/**
	 * The target object (the object with the slot)
	 *
	 * @var AObject
	 */
	public $targetObject;
	
	
	/**
	 * the method to be exicuted when a signal is emitted
	 *
	 * @var string
	 */
	private $targetMethod;
	
	
	/**
	 * The name of the signal connected to
	 * @access string
	 */
	private $signalName;
	
	/**
	 * the source AObject
	 *
	 * @var AObject
	 */
	private $sourceObject;

	private $connectionType;
	
	private $connectionID;
	
	private $javascript;
	
	const PHP_CONNECION = "0";
	
	const JSCRIPT_CONNECTION = "1";
	
	
	public function __construct($target,$method,$source,$signal,$script=null){
		if($target!==null){
			$this->setTarget($target,$method);
		}
		$this->setJavascript($script);
		$this->setSignalName($signal);
		$this->sourceObject = $source;
	}
	
	public function getJavascript(){
		return $this->javascript;
	}
	
	public function setJavascript($script){
		$this->javascript=$script;
	}
	
	public function getTarget(){
		return $this->targetObject;
	}
	
	
	public function getSource(){
		return $this->sourceObject;
	}
	
	public function getSlotMethod(){
		return $this->targetMethod;
	}

	/**
	 * sets the target slot
	 *
	 * @param AObject $target
	 * @param unknown_type $method
	 */
	function setTarget(AObject $target,$method){

		$this->targetObject=$target;
		$method=(string)$method;
		if(!method_exists($target,$method)){
			throw new Exception("Method '$method' does not exist in object of class '".get_class($target)."'.");
		}
		$this->targetMethod = $method;
	}
	
	function setSignalName($name){
		$this->signalName=$name;
	}
	
	function getSignalName(){
		return $this->signalName;
	}
	
	function setConnectionID($id){
		$this->connectionID=$id;
	}
	
	function getConnectionID(){
		return $this->connectionID;
	}

	function clear(){
		  unset($this->sourceObject);
		  unset($this->targetObject);
	}
	
} // end of AConnection
?>
