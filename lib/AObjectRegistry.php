<?php
/**
 * @package Alia
 * @subpackage Core
 */


require_once 'AObject.php';

if(!isset($_SESSION)){$_SESSION=array();}



/**
 * A Singleton registry for all AObject objects 
 * 
 * All AObject subclasses that call parent::__construct() will be automatically added to this registry.
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @copyright 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class AObjectRegistry
{

	private $objects;
	
	private $IDCounter=0;
	
	
	static private $instanceObject=null;
	
	
	
	/**
	 * __construct 
	 * 
	 * @return void
	 */
	private function __construct(){
		$this->objects = array();
	}
	
	
	/**
	 * returns the instance of the Alia object
	 *
	 * @return Alia
	 */
	public function instance(){
		Alia::startSessionOnce();
		//prevent notices
		if(!isset($_SESSION['alia']['objectRegistry']))$_SESSION['alia']['objectRegistry']=null;
		
		if($_SESSION['alia']['objectRegistry']==null){
			$_SESSION['alia']['objectRegistry'] = new AObjectRegistry();
		}
		return $_SESSION['alia']['objectRegistry'];
	}
	
	/**
	 * Adds an AObject to the index, and assigns it a unique ID
	 *
	 * @param AObject $object
	 */
	public function addObject(AObject $object){
		$this->objects[]=$object;
		$this->generateID($object);
	}
	
	/**
	 * returns an ArrayObject containing all AObjects
	 *
	 * @return ArrayObject
	 */
	public function getObjects(){
		return $this->objects;
	}
	
	
	/**
	 * Assigns an AObject a unique ID
	 *
	 * @param AObject $object
	 */
	private function generateID(AObject $object){
		$id=get_class($object).$this->IDCounter++;
		$object->setObjectID($id);
	}
	
	
	/**
	 * Returns the object of id $id, if it exists.
	 * 
	 * @param mixed $id 
	 * @return AObject|false the found object or false if not found
	 */
	public function getObjectByID($id){
		foreach ($this->objects as $object){
			if($object->getObjectID() == $id ){
				return $object;
			}
		}
		return false;
	}
	
	/**
	 * Removes the object from the registry.
	 */
	public function clearObject($object){
		foreach ($this->objects as $k=>$o){
			if($o === $object ){
				unset($this->objects[$k]);	
			}
		}
	}
	
} // end of AObjectRegistry
?>
