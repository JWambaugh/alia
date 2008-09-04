<?php
/**
 *
 */


/**
 * An extendable widget decorator that does nothing. Extend it to create decorators that do things! 
 */
class AWidgetDecorator extends AWidget{
	
	protected $__childWidget;
	
	function __construct(AWidget $widget){
		$this->__childWidget = $widget;
		parent::__construct();
		
		
	}
	
	/**
	 * Passes any method calls to the child widget
	 */
	function __call($name,$args){
		call_user_func_array(array(&$this->__childWidget,$name),$args);
	}
	
	/**
	 * Sets the layout on the child widget
	 *
	 * @param unknown_type $layout
	 * @return AWidget
	 */
	public function setLayout( $layout ) {
		$this->__childWidget->setLayout($layout);
		return $this;
	} // end of member function setLayout


	/**
	 * Calls render on the child widget
	 */
	public function render( ){
		return $this->__childWidget->render();
	}

	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @return AWidget
	 */
	public function addAttribute($name){
		$this->__childWidget->addAttribute($name);
		return $this;
	}
	
	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @return string
	 */
	public function getAttribute($name){
		return $this->__childWidget->getAttribute($name);
	}
	
	
	/**
	 * Enter description here...
	 *
	 * @param string $name
	 * @param string $value
	 * @return AWidget
	 */
	public function setAttribute($name, $value){
		$this->__childWidget->setAttribute($name,$value);
		return $this;
	}
	
	
	
	public function getAttributes(){
		return $this->__childWidget->getAttributes();
	}
	
	
	public function getLayout(){
		return $this->__childWidget->getLayout();
		
	}
	
	
	public function setObjectID($id){
		parent::setObjectID($id);
	}

	public function redraw(){
		$this->__childWidget->redraw();
	}
	
}


