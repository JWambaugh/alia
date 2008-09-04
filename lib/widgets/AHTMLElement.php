<?php
/**
 * AHTMLElement
 *
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @package Alia
 * @subpackage Widgets 
 */



/**
 * Abstract class for all HTML Element widgets
 * defines attributes and signals common to most elements
 *
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @package Alia
 * @subpackage Widgets
 * @signal clicked() Emitted when the widget is clicked
 * @signal mouseOver() Emitted when the mouse hovers over the widget
 * @signal mouseOut() Emitted when the mouse leaves the widget
 * @signal mouseDown() Emitted when the mouse button is pressed down on the widget
 * @signal mouseUP() Emitted when the mouse button is released from the wwidget
 * @signal dblClicked() Emitted when the widget is double-clicked
 * @signal focus() Emitted when the widget gets keyboard focus
 * @signal keyPressed() Emitted when a key is pressed within the widget
 * @signal keyUp() Emitted when a key is released
 * @signal mouseMove() Emitted when the mouse moves over the widget
 */
abstract class AHTMLElement extends AWidget
{
	/**
	 * The inner html (if any)
	 *
	 * @var unknown_type
	 */
	private $innerHTML;
	
	/**
	 * The name of the html tag
	 *
	 * @var unknown_type
	 */
	private $tagName;
	
	/**
	 * 
	 *
	 */
	public function __construct(){
		parent::__construct();
		
		$this->addAttribute('style');
		$this->addAttribute('title');
		$this->addAttribute('class');
		$this->addAttribute('style');
		$this->addAttribute('lang');		
		
		//define the signals for this object
		$this->defineSignal("clicked",0);
		$this->defineSignal("mouseOver",0);
		$this->defineSignal("mouseOut",0);
		$this->defineSignal("mouseDown",0);
		$this->defineSignal("mouseUp",0);
		$this->defineSignal("dblClicked",0);
		$this->defineSignal("focus",0);
		$this->defineSignal("keyPressed",0);
		$this->defineSignal("keyUp",0);
		$this->defineSignal("mouseMove",0);
	}

	/**
	 * set the event attributes, but only if we have a connection (save page weight)
	 *
	 * @return string
	 */
	public function render(){
		
		
		//generate emitions, but only if we have a connection to the slot.
		
		if($this->hasConnection('clicked')){
			$this->addAttribute('onclick')->setAttribute('onclick',AJScript::emit('clicked',$this));
		}
		
		if($this->hasConnection('mouseOver')){
			$this->addAttribute('onmouseover')->setAttribute('onmouseover',AJScript::emit('mouseOver',$this));
		}
		
		if($this->hasConnection('mouseOut')){
			$this->addAttribute('onmouseout')->setAttribute('onmouseout',AJScript::emit('mouseOut',$this));
		}
		
		if($this->hasConnection('mouseDown')){
			$this->addAttribute('mouseDown')->setAttribute('mouseDown',AJScript::emit('mouseDown',$this));
		}
		
		
		if($this->hasConnection('mouseUp')){
			$this->addAttribute('mouseUp')->setAttribute('mouseUp',AJScript::emit('mouseUp',$this));
		}
		
		if($this->hasConnection('dblClicked')){
			$this->addAttribute('dblClicked')->setAttribute('mouseDown',AJScript::emit('dblClicked',$this));
		}
		
		if($this->hasConnection('mouseOut')){
			$this->addAttribute('mouseOut')->setAttribute('mouseOut',AJScript::emit('mouseOut',$this));
		}
		
		if($this->hasConnection('focus')){
			$this->addAttribute('focus')->setAttribute('focus',AJScript::emit('focus',$this));
		}
		
		
		if($this->hasConnection('keyPressed')){
			$this->addAttribute('keyPressed')->setAttribute('keyPressed',AJScript::emit('keyPressed',$this));
		}
		
		if($this->hasConnection('keyUp')){
			$this->addAttribute('keyUp')->setAttribute('keyUp',AJScript::emit('keyUp',$this));
		}
		
		if($this->hasConnection('mouseMove')){
			$this->addAttribute('mouseMove')->setAttribute('mouseMove',AJScript::emit('mouseMove',$this));
		}
		
		$buffer = parent::render();
		return $buffer;
	}
	
	/**
	 * Sets the name of the tag
	 *
	 * @param string $name
	 */
	public function setTagName($name){
		$this->tagName=$name;
	}
	
	
	/**
	 * returns the name of the tag
	 *
	 * @return string
	 */
	public function getTagName(){
		return $this->tagName;
	}
	
	/**
	 * sets the inner HTML
	 *
	 * @param string $html
	 */
	public function setInnerHTML($html){
		$this->innerHTML=$html;
	}
	
	/**
	 * returns the inner HTML
	 *
	 * @return string
	 */
	public function getInnerHTML(){
		return $this->innerHTML;
	}
	
	

} // end of AHTMLElement
?>
