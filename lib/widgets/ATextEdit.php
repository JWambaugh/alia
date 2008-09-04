<?php
/**
 * class ATextEdit
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */

/**
 * class AButton
 *
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wamabugh.org>
 *
 */
class ATextEdit extends AHTMLElement {

	function __construct($text=''){
		parent::__construct($text);
		$this->setTagName("textarea");
		$this->setInnerHTML($text);
		$this->setLayout(new AElementLayout($this) );
	}
	
	function render(){
		return parent::render();
		
	}

} // end of AButton
