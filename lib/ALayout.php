<?php
require_once 'ARenderableInterface.php';
require_once 'AWidgetCollection.php';


/**
 * ALayout
 *
 * The base class for all layouts
 *
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Core
 *
 */
abstract class ALayout extends AObject implements ARenderableInterface 
{


	/**
	 * Children widgets added to the layout
	 * 
	 * @var mixed
	 */
	private $__widgets= array();
	
	/**
	 * The main widget this layout lays out 
	 *
	 * @var AWidget
	 */
	private $widget;

	
	/**
	 * __construct 
	 * 
	 * @param AWidget $parentWidget 
	 * @return void
	 */
	public function __construct(AWidget $parentWidget){
		parent::__construct();
		$this->widget = $parentWidget;
	}

	
	/**
	 * Returns the main widget
	 * 
	 * @return void
	 */
	public function getMainWidget(){
		return $this->widget;
	}
	
	/**
	 * returns the children widget(s)
	 * 
	 * @return mixed the children widget(s)
	 */
	public function getWidgets() {
		return $this->__widgets;
	} // end of member function getWidgets


	/**
	 * getWidget 
	 * Returns one widget in the layout
	 * 
	 * @param mixed $key 
	 * @return void
	 */
	public function getWidget($key){
		return $this->__widgets[$key];
	}

	/**
	 * Adds a child widget
	 * 
	 * @param AWidget $widget 
	 * @return void
	 */
	public function addWidget(AWidget $widget, $key=null){
		if(!is_null($key)){
			$this->__widgets[$key]=$widget;
		}else{
			$this->__widgets[]=$widget;
		}
	}

	/**
	 * renders the widget, returns the output as a string
	 * 
	 * @return string
	 */
	public function render( ){
		return "default renderer";
	}

	/**
	 * generates HTML for the main widget's attributes
	 * 
	 * @return void
	 */
	public function getAttributeHTML(){
		$buffer='';
		foreach ($this->widget->getAttributes() as $k=>$v){
			if($v!='')$buffer.=" $k=\"$v\"";
		}
		return $buffer;
	}
	
	/**
	 * Clears all child widgets
	 *
	 */
	public function clearWidgets(){
		$this->__widgets = array();
	}

	/**
	 * Sets the widgets in the layout
	 * @param array $widgets An array of widgets
	 */
	public function setWidgets($widgets){
		if(!is_array($widgets)){
			throw new Exception('setWidgets method only accepts an array as a parameter.');
		}
		$this->__widgets=$widgets;
	}
	
	
	/**
	 * Clears all data in the object and attempts to remove all references to itself.
	 * Note that this object should not be used at this point, but should be unset.
	 */	public function clear(){
		$this->clearWidgets();
		unset($this->widget);
		parent::clear();
	}


} // end of ALayout
?>
