<?
/**
 * ASimpleLayout
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


class ASimpleLayout extends ALayout
{

	private $separator;
	public function render(){
		$buffer="";
		$x =0;
		if(count($this->getWidgets()>0))
			foreach ($this->getWidgets() as $widget){
				$buffer.="\n".$widget->render();
				if($this->separator && $x++ > 0)$buffer.=$this->separator;
			}
		return "<div".$this->getAttributeHTML().">".$buffer."</div>";
	}

	public function setSeparator($sep){
		$this->separator= $sep;
	}

} // end of ASimpleLayout
?>
