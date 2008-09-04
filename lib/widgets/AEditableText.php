<?php
/**
 * AEditableText.php
 * The file for AEditableText class.
 * 
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */


/**
 * AEditableText class - a widget representing a single editable text element
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 *
 */
class AEditableText extends AWidget{
	
	private$__text;
	private $editLayout;
	private $editWidget;
	private $textLayout;
	private $textWidget;
	private $mode;
	
	function __construct($text){
		parent::__construct();
		
		$this->defineSignal('leaveEdit');
		$this->defineSignal('enterEdit');
		
		//setup the textLayout
		$this->textLayout = new ASingleWidgetLayout($this);
		$this->textWidget = new AParagraph($text);
		$this->textWidget -> defineSignal('clicked');
		$this->textWidget->addAttribute('onclick')->setAttribute('onclick','editableText.toggle(this.parentNode);');
		$this->textLayout->addWidget($this->textWidget);
		
		
		$this->mode = 'text';
		$this->setLayout($this->textLayout);
		$this->__text = $text;
		
		$this->addJavascript();
		
	}

	
	
	function setText($text){
		$this->__text = $text;
	}

	function getText(){
		return $this->__text;
	}

	
	private function addJavascript(){
		$enterEditEmit = AJScript::emit('enterEdit',$this,'element.firstChild.innerHTML');
		$leaveEditEmit = AJScript::emit('leaveEdit',$this,'element.firstChild.value');
		
		$script = <<<end
var editableText = new function(){
	this.toggle= function(element){
		
		switch(element.firstChild.tagName){
			case 'P':
				$enterEditEmit
				this.editable(element);
				break;
			case 'INPUT':
				$leaveEditEmit 
				this.text(element);
				break;
		}
	}
	
	this.editable =  function(element){
		element.innerHTML = '<input type = "text" value = "'+element.firstChild.innerHTML+'" onblur="editableText.toggle(this.parentNode);"/>';
		element.firstChild.focus();
	}
	
	this.text= function(element){
		element.innerHTML = '<p onclick="editableText.toggle(this.parentNode);">'+element.firstChild.value+'</p>';
		
	}
} 
end;
		AJScriptBuffer::instance()->addJScript($script);
	}

}

