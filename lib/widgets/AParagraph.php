<?php

/**
 * class AParagraph
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 *
 */

/**
 * class AParagraph
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */
class AParagraph extends AHTMLElement 
{

	function __construct($text){
		parent::__construct();
		$this->setTagName('p');
		$this->setLayout(new AElementLayout($this) );
		$this->setInnerHTML($text);
	}
	
	function render(){
		return parent::render();
		
	}

} // end of AButton
?>
