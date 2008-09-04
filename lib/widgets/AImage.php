<?php
/**
 * AImage
 * A HTML image widget
 *
 * @package Alia
 * @subpackage Widgets
 */


/**
 * class AImage
 *
 * Represents an image.
 *
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Widgets
 * 
 */
class AImage extends AHTMLElement 
{

	function __construct($source,$alt=''){
		parent::__construct($text);
		$this->setTagName('image');
		$this->setLayout(new AElementLayout($this));
		$this->addAttribute('src')->setAttribute('src',$source);
		$this->addAttribute('alt');
		if($alt){
			$this->setAttribute("alt",$alt);
		}
	}
	
	function render(){
		return parent::render();
		
	}

} // end of AButton
?>
