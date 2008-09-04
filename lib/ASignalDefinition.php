<?php
require_once 'AObject.php';


/**
 * ASignalDefinition 
 * 
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @copyright 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class ASignalDefinition
{

	
	private $name;
	
	private $parameterCount;
	
	
	
	/**
	 * 
	 * @param string name 
	 * @param int parameterCount 
	 * @param AObject object 
	 * @return 
	 * @access public
	 */
	public function __construct($name, $parameterCount=0) {
		$this->name=(string)$name;
		$this->parameterCount=(int)$parameterCount;
	} // end of member function __construct

	public function getName(){
		return $this->name;
	}
	
	public function getParameterCount(){
		return $this->parameterCount;
	}


} // end of ASignalDefinition
?>
