<?
/**
 * AElementLayout
 *
 * @package Alia
 * @subpackage Layouts
 */


/**
 * AElementLayout
 *
 * A very simple layout for widgets that represent a single element
 *
 * @package Alia
 * @subpackage Layouts
 *
 */
class AElementLayout extends ALayout
{

	public function render(){
		$widget=$this->getMainWidget();
		$buffer= "<".$widget->getTagName()." ".$this->getAttributeHTML();
		$buffer.= ($html=$widget->getInnerHTML()) ? ">$html</".$widget->getTagName().">" : " />";
		return $buffer;
	}

	public function addWidget(AWidget $widget,$key=null){
			if(!$widget instanceof AHTMLElement ){
				throw new Exception("widget is not of type AHTMLWidget!");
			}
			$this->__widgets=$widget;
	}

} // end of ASimpleLayout
?>
