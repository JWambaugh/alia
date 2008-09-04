<?php
/**
 * AIntValidatorRule 
 * 
 * @uses AValidatorRule
 * @package Alia
 * @subpackage Validator
 * @version $id$
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */



/**
 * AIntValidatorRule 
 * 
 * @uses AValidatorRule
 * @package Alia
 * @package Validator
 * @version $id$
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */
class AIntValidatorRule extends AValidatorRule{
	
	/**
	 * Returns the name of the rule type 
	 * 
	 * @access public
	 * @return void
	 */
	function getTypeName(){
		return "int";
	}

	/**
	 * Validates $value based on the set options
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function validate($value){
		$options = $this->getOptions();

		if(!is_int($value)){
			if($value!='' &&!ctype_digit($value) ){
				return new AValidatorViolation(0x2001,$this->getKey().' is not a valid whole number.',$this);
			}
		}

		if($options['required'] && is_null($value)){
			return new AValidatorViolation(0x2002,$this->getKey().' is required.',$this);
		}
		
		if($options['maxValue']){
			if($value>$options['maxValue']){
				return new AValidatotViolation(0x2003,$this->getKey().' must be less than or equal to '.$options['maxValue'],$this);
			}
		}

		if($options['minValue']){
			if(strlen($value)<$options['minValue']){
				return new AValidatotViolation(0x2004,$this->getKey().' must be more than or equal to '.$options['minValue'].'.',$this);
			}
		}

		
		if(is_array($options['allowableValues'])){
			$found=false;
			foreach($options['allowableValues'] as $av){
				if($av===$value){$found=true;break;}
			}
			if(!$found)return new AValidatorViolation(0x2005,$this->getKey()."Does not contain an allowable value. ");
		}

	}
	
}


