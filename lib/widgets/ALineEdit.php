<?php
/**
 * ALineEdit
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */



/**
 * class ALineEdit
 * 
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */
class ALineEdit extends AHTMLElement 
{

	function __construct($text=''){
		parent::__construct($text);
		$this->setTagName("input");
		$this->setLayout(new AElementLayout($this) );
		$this->addAttribute('type')->setAttribute('type','text');
		$this->addAttribute('value');
		$this->addAttribute('maxlength');
		if($text){
			$this->setAttribute('value',$text);
		}
	}
	
	function render(){
		return parent::render();
		
	}

}
?>
