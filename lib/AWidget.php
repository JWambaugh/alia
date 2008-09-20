<?
/**
 * AWidget.php
 * The file for the AWidget class
 */
require_once 'AObject.php';
require_once 'AWidgetCollection.php';
require_once 'ARenderableInterface.php';
require_once 'ALayout.php';


/**
 * AWidget - The base class for all wi
 * 
 * All widgets extend this class. Awidget extends AObject, so all widgets inhererit connection/slot functionality from AObject.
 * All custom widgets should extend this class, or any other class extending AWidget.
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Widgets
 */
abstract class AWidget extends AObject implements ARenderableInterface
{

	 /*** Attributes: ***/
	/**
	 * The widget's layout
	 *
	 * @var ALayout
	 */
	private $__layout;

	/**
	 * The HTML attributes of the widget
	 *
	 * @var array
	 */
	private $__attributes=array();
	
	private $__display=true;	
	
	/*** Methods ***/
	
	
	public function __construct(){
		$this->addAttribute('id');
		parent::__construct();
	}



	
	/**
	 * Sets the layout in charge of rendering the widget
	 *
	 * @param ALayout $layout
	 * @return AWidget
	 */
	public function setLayout( $layout ) {
		if(isset($this->__layout)){
			unset($this->__layout);
		}
		$this->__layout=$layout;
		return $this;
	} // end of member function setLayout


	/**
	 * Renders the widget
	 *
	 * The default action is to ask the layout to render it.
	 *
	 * @return string The rendered HTML
	 */
	public function render( ){
		if(!$this->__display){
			return " ";
		}
		if($this->__layout){
			return $this->__layout->render();
		}else{
			throw new Exception("Cannot render without a layout!");
		}
	}

	/**
	 * Prepares the widget to accept a new attribute
	 *
	 * as of 9/4/2008 accepts an optional parameter to set it to a value at the same time
	 * @param string $name
	 * @param string $value - Optional
	 * @return AWidget
	 */
	public function addAttribute($name, $value=false){
		$this->__attributes[$name]='';
		if($value !== false){
			 $this->setAttribute($name,$value);
		}
		return $this;
	}
	
	/**
	 * returns the value of a specified attribute
	 *
	 * @param string $name
	 * @return string
	 */
	public function getAttribute($name){
	if(!is_string($this->__attributes[$name])){
			throw new exception("This widget does not have an attribute of name '$name'");
		}
		return $this->__attributes[$name];
	}
	
	
	/**
	 * sets the value of a specified attribute
	 *
	 * you must call addAttribute to add the attribute before you can set it.
	 *
	 * @param string $name
	 * @param string $value
	 * @return AWidget
	 */
	public function setAttribute($name, $value){
		if(!is_string($this->__attributes[$name])){
			throw new exception("This widget does not have an attribute of name '$name'");
		}
		$this->__attributes[$name]=(string)$value;
		return $this;
	}
	
	
	/**
	 * Returns all attributes of the widget
	 *
	 * @return array
	 */
	 
	public function getAttributes(){
		return $this->__attributes;
	}
	
	/**
	 * returns the layout object, if there is one
	 *
	 * @return ALayout|false
	 */
	public function getLayout(){
		return $this->__layout;
		
	}
	
	/**
	 * Sets the object's ID
	 *
	 * This method is automatically called by AObjectRegistry. It should not be used other than that.
	 */
	public function setObjectID($id){
		parent::setObjectID($id);
		$this->setAttribute('id',$id);
	}

	 /**
	  * invokes javascript to redraw the widget on the page.
	  *
	  * Call this function to update a widget's display via ajax.
	  */
	public function redraw(){
//		if($this->__display){
			$script =AJScript::updateDiv($this->getAttribute('id'),$this->render());
			AJScriptBuffer::instance()->addJScript("Validator.clear();\n".$script,true);
//		}
	}

	public function setDisplay($val){
		$this->__display=$val;
	}

	 /**
	  * prepares the object to be unset
	  *
	  * attempts to remove all internal references to itself in Alia.
	  * Call this method before calling unset on an object.
	  */
	public function clear(){
		  if($layout=$this->getLayout()){
			   $layout->clear();
		  }
		  unset($this->layout);
		  unset($this->__attributes);
		  parent::clear();
	}
	
	public function __destruct(){
	}
	

} // end of AWidget
?>
