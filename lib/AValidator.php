<?php
/**
 *  File for the AValidator class
 */


/**
 * Provides easy validation of html forms and other data. 
 * 
 * @uses AObject
 * @package Alia
 * @subpackage Validator
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */
class AValidator extends AObject{
	
	private $rules=array();

	const IGNORE_MISSING_KEYS = 1;

	function __construct(){
		
	}

	/**
	 * Adds a new validation rule to a filed with name/id of $key.
	 *
	 */
	function add($key,$type,$options=null, $id=null){

		switch($type){
			case 'string':
				$rule = new AStringValidatorRule($key,$options,$id);
				break;
			case 'int':
				$rule = new AIntValidatorRule($key,$options,$id);
				break;
			default:
				throw new Exception("Unkown type '$type'");
		}

		$this->rules[]=$rule;
	}

	
	/**
	 * Validate array of data
	 * 
	 * Validates $array. The keys in $array must have a rule established with the same key name.
	 * If a rule is not found for a specific key, an exception is thrown. This behavior can be disabled
	 * by passing AValidator::IGNORE_MISSING_KEYS as an option.
	 *
	 * @param Array $array the array of data to validate
	 * @param int $options a bitmask of options. (currently only AValidator::IGNORE_MISSING_KEYS is valid)
	 */
	function validate($array,$options=0){
		$violations=array();
		foreach($array as $k=>$v){
			$found=false;
			foreach($this->rules as $rule){
				if($rule->getKey()==$k){
					$found=$rule;
					break;
				}
			}
			if(!$found && !($options & self::IGNORE_MISSING_KEYS)){
				throw new Exception("No rule found for key '$k' in provided array.");
			}else{
				$ret=$found->validate($v);
				if(is_object($ret)){
					$violations[]=$ret;
				}
			}
		
		}

		if(count($violations)){
			return $violations;
		}

		return true;

	}

	/**
	 * Returns the javascript that will validate based on registered validation rules
	 */
	function getJScript(){
		
		$buffer='';
		foreach ($this->rules as $rule){
			$buffer.=$rule->getJScript()."\n";
		}
		return $buffer;
	}

	/**
	 * Generates javascript validation code based off the added rules, and sends it to the javascript output buffer.
	 *
	 */
	function sendJScript(){
		Alia::sendJScript($this->getJScript());
	}






} 

