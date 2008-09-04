<?php
/**
 * ATableCell.php
 * The file for ATableCell class.
 * 
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 */

/**
 * Include requirement
 */
require_once 'AHTMLElement.php';

/**
 * ATableCell class - a widget representing a single cell in a table.
 * This is a widget for the <TD> html element. 
 * @package Alia
 * @subpackage Widgets
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 *
 */
class ATableCell extends AHTMLElement {
	private $__text;
	
	public function __construct($text = ''){
		parent::__construct();
		echo "atablecell";
		$this->addAttribute("colspan");
		$this->addAttribute("rowspan");
		$this->setTagName('TD');	
		$this->__text=$text;
		$this->buildLayout();	
	
	}

	public function setText( $text ) {
		$this->__text=$text;
	} // end of member function setText

	public function getText( ) {
		return $this->__text;
	} // end of member function getText

	
	
	/**
	 * Builds the layout for the table cell. Override this method if you don't want an AElementLayout.
	 *
	 */
	public function buildLayout(){
		$this->setLayout(new AElementLayout($this) );
	}
	
}

?>
