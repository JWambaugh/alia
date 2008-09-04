<?php

/**
 * AHTMLText
 *
 * @package Alia
 * @subpackage Widgets
 */




/**
 * AHTMLText
 *
 * @package Alia
 * @subpackage Widgets
 */

class AHTMLText extends AWidget
{

	private $__text;

	public function __construct($text=''){
		parent::__construct();
		$this->__text=$text;
	}

	public function setText( $text ) {
		$this->__text=$text;
	} // end of member function setText

	public function getText( ) {
		return $this->__text;
	} // end of member function getText
	
	function render(){
		return $this->getText();
	}

}

?>
