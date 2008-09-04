<?php
/**
 * AStringValidatorRule 
 * 
 * @uses AValidatorRule
 * @package Alia
 * @subpackage Validator
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */



/**
 * AStringValidatorRule 
 * 
 * @uses AValidatorRule
 * @package Validator
 * @copyright 2008 Jordan CM Wambaugh
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */
class AStringValidatorRule extends AValidatorRule{

	function getTypeName(){
		return 'string';
	}
	
	/**
	 * Validates $value based on set options
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function validate($value){
		$options = $this->getOptions();
		if(isset($options['required']) && $value==''){
			return new AValidatorViolation(0x1001,$this->getKey().' is required.',$this);
		}
		
		if(isset($options['maxLength'])){
			if(strlen($value)>$options['maxLength']){
				return new AValidatorViolation(0x1002,$this->getKey().' must be less or equal to than '.$options['maxLength'].' characters long.',$this);
			}
		}

		if(isset($options['minLength'])){
			if(strlen($value)<$options['minLength']){
				return new AValidaortViolation(0x1003,$this->getKey().' must be more than or equal to '.$options['minLength'].' characters long.',$this);
			}
		}

		if(isset($options['illegalCharacters'])){
			$len=strlen($options['illegalCharacters']);
			for($x=0;$x<$len;$x++){
				if(strpos($value,$options['illegalCharacters'][$x])!==false){
					return new AValidatorViolation(0x1004,$this->getKey()." must not conatin any instances of '{$options['illegalCharacters'][$x]}'");
				}
			}
		}
		
		if(isset($options['allowableValues'])){
			$found=false;
			foreach($options['allowableValues'] as $av){
				if($av===$value){$found=true;break;}
			}
			if(!$found)return new AValidatorViolation(0x1005,$this->getKey()."Does not contain an allowable value. ");
		}

		if(isset($options['regex'])){
			if(!preg_match($options['regex'],$value)){
				return new AValidatorViolation(0x1005,$this->getKey()."Does not contain an allowable value. ");

			}
		}


	}
	
}


