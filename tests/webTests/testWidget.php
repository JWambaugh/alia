<?php
class testWidget extends AWidget {
	function __construct(){
		parent::__construct();
		$this->defineSignal('SomthingHappend');
		$layout = new ASimpleLayout($this);
		$this->setLayout($layout);
	}
	
	function doSomthing(){
		Alia::sendJScript(AJScript::alert('Did somthing!'));
	}
}

?>