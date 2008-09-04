<?php
class loginWidgettestWidget extends AWidget {
	function __construct(){
		parent::__construct();
		
		//create a new layout for this widget
		$layout = new ASimpleLayout($this);
		$this->setLayout($layout);
	
		//create a window
		$window = new AWindow();
		
		//add our window to the layout
		$layout->addWidget($window);
		
		$window->setTitle('Login Window');
		
		//make the window dragable
		$window->setAttribute('style','width:250px;border-style: ridge; float:left');
		
		
		//create our login widget
		$loginWidget = new ALoginWidget();
		
		//add our login widget to the window
		$window->setMainWidget($loginWidget);
		
		//Connect the 'loginPushed' signal to our loginUser slot
		//now whenever the user clicks the login button, out loginUser method will be called,
		//and passed the login information (The loginUser signal sends the login info when emitted)
		Alia::connect($loginWidget,'loginPushed',$this,'loginUser');
		
		
	}
	
	//just send a simple alert box with the username and password
	function loginUser($user,$password){
		/** LOG THE USER IN....**/
		
		Alia::sendJScript(AJScript::alert("user named \"$user\" logged in with password '$password'"));
	}
}
?>
