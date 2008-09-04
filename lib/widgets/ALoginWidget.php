<?php
/**
 * 
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */

/**
 * ALoginWidget
 * 
 * A widget for username/password prompt
 * 
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 * @signal loginPushed - Emitted when the user completes the form
 */

class ALoginWidget extends AWidget {
	private $validator;	


	function __construct(){
		parent::__construct();
		$this->defineSignal('loginPushed');
		
		$layout = new AGridLayout($this);
		$this->setLayout($layout);
		
		
		
		$layout->addWidget(new AHTMLText("User Name:"),0,0);
		$userName = new ALineEdit();
		$layout->addWidget($userName,0,1);
		
		$layout->addWidget(new AHTMLText("Password:"),1,0);
		$password = new ALineEdit();
		$password->setAttribute('type','password');
		$layout->addWidget($password,1,1);
		
		$button = new APushButton('Login');
		$layout->addWidget($button,2,0,2);
		
		
		
		//make our connection to the button.
		//when to button is clicked, emit a new signal with our login information.
		Alia::connect($button,'clicked',null,null,AJScript::emit('loginPushed',$this,array(AJScript::formElementValue($userName),AJScript::formElementValue($password))));

		//add some validation!
		$this->validator = new AValidator();
		$this->validator->add($userName->getAttribute('id'), 'string', array('minLength'=>4, "required"=>true));
		$this->validator->add($password->getAttribute('id'), 'string', array('minLength'=>4, "required"=>true));
		$this->validator->sendJScript();
		//Alia($button,'clicked','trigger');
	}
	
}
