<?php
/**
 * class APushButton
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */



/**
 * class APushButton
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */

class APushButton extends AHTMLElement 
{

	function __construct($text){
		parent::__construct($text);
		$this->setTagName('button');
		$this->setInnerHTML($text);
		$this->setLayout(new AElementLayout($this) );
	}
	
	function render(){
		$buffer=parent::render();
		return $buffer;
	}

} // end of AButton
?>
