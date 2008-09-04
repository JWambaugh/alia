<?php
/**
 *  
 */

/**
 * Javascript output buffer for Alia 
 * 
 * A singleton object for storing and retrieving generated javascript.
 * @uses ASingletonInterface
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @copyright 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class AJScriptBuffer implements ASingletonInterface{
	
	static private $instanceObject=null;
	
	private $jscript = array();
	
	
	private function __construct(){
			}
	
	
	/**
	 * returns the instance of the javascript buffer
	 *
	 * @return AJscriptBuffer
	 */
	public function instance(){
		if(!self::$instanceObject){
			self::$instanceObject = new AJscriptBuffer();
		}
		return self::$instanceObject;
	}
	
	
	public function addJScript($script, $prepend = false){
		if(!$prepend)$this->jscript[]=$script;
		else array_unshift($this->jscript,$script);
	}
	
	
	public function getJScript(){
		$buffer = '';
		foreach ($this->jscript as $script){
			$buffer.="\n".$script;
		}
		
		return $buffer;
	}
	
	
	
}


?>
