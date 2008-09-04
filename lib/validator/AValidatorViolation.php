<?php

/**
 * A violation of a validator rule
 *
 */
class AValidatorViolation{

	private $code;

	private $message;


	private $rule;



	public function __construct($code,$message,$rule){
		$this->code=$code;
		$this->message=$message;
		$this->rule = $rule;
	}


	public function getMessage(){
		return $this->message;
	}

	public function getRule(){
		return $this->rule;
	}







	public function getCode(){
		return $this->code;
	}


}



?> 
