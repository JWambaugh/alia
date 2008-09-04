<?
/**
 * ASingleWidgetLayout
 *
 * @package Alia
 * @subpackage Layouts
 */


/**
 * ASimpeLayout
 *
 * @package Alia
 * @subpackage Layouts
 */


class ASingleWidgetLayout extends ALayout
{

	/**
	 * render 
	 * Randers the widget
	 * 
	 * @access public
	 * @return void
	 */
	public function render(){
		$text ='';
		if($this->__widgets[0] instanceof AWidget)$text=$this->__widgets[0]->render();
		return "<div".$this->getAttributeHTML().">$text</div>";
	}


	/**
	 * addWidget 
	 * 
	 * @param mixed $widget 
	 * @access public
	 * @return void
	 */
	public function addWidget($widget,$key=null){
		$this->__widgets[0] = $widget;
	}


} // end of ASimpleLayout
?>
