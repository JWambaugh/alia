<?php
/**
 * AValidatorRule 
 * 
 * @abstract
 * @package Alia
 * @subpackage Validator
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */




/**
 * Abstract class for Validator Rules 
 * 
 * A validator rule class provides validation for a certain type of data.
 * @abstract
 * @package Alia
 * @subpackage Validator
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */
abstract class AValidatorRule{
	private $_key;
	
	private $_options;


	private $_id;
	
	abstract public function validate($value);

	
	abstract public function getTypeName();

	public function __construct($key, $options=null, $id=null){
		$this->_key=$key;
		$this->_options=$options;
		$this->_id = $id;
	}

	public function getKey(){
		return $this->_key;
	}


	public function getOptions(){
		return $this->_options;
	}


	/**
	 * Generates the client-side validation javascript and returns it as a string
	 *
	 */
	public function getJScript(){
		$x=0;
		$id= $this->_id ===NULL ? $this->_key : $this->_id;
		$buffer= "Validator.add('$id','".$this->getTypeName()."',{";
		foreach((array)$this->_options as $k=>$v){
			if($x++ > 0)$buffer.=", ";
			$buffer.=$k.": ".$v;
		}
		$buffer.='});';
		return $buffer;
	}
}
