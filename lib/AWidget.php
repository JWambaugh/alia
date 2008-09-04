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
	
	
	
	/*** Methods ***/
	public function __construct(){
		$this->addAttribute('id');
		parent::__construct();
	}



	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $layout
	 * @return AWidget
	 */
	public function setLayout( $layout ) {
		if(isset($this->__layout)){
			unset($this->__layout);
		}
		$this->__layout=$layout;
		return $this;
	} // end of member function setLayout



	public function render( ){
		if($this->__layout){
			return $this->__layout->render();
		}else{
			throw new Exception("Cannot render without a layout!");
		}
	}

	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @return AWidget
	 */
	public function addAttribute($name){
		$this->__attributes[$name]='';
		return $this;
	}
	
	/**
	 * Enter description here...
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
	 * Enter description here...
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
	
	
	
	public function getAttributes(){
		return $this->__attributes;
	}
	
	
	public function getLayout(){
		return $this->__layout;
		
	}
	
	
	public function setObjectID($id){
		parent::setObjectID($id);
		$this->setAttribute('id',$id);
	}

	public function redraw(){
		$script =AJScript::updateDiv($this->getAttribute('id'),$this->render());
		AJScriptBuffer::instance()->addJScript("Validator.clear();\n".$script,true);
	}


	public function clear(){
		  if($layout=$this->getLayout()){
			   $layout->clear();
		  }
		  unset($this->layout);
		  unset($this->__attributes);
		  parent::clear();
	}
	
	public function __destruct(){
		  $this->clear();
	}
	

} // end of AWidget
?>
