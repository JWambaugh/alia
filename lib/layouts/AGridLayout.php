<?php
/**
 * AGridLayout
 *
 * @package Alia
 * @subpackage Layouts
 */

/**
 * Lays out the widgets in a grid
 *
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Layouts
 */
class AGridLayout extends ALayout
{

	private $col=0;
	private $rows=0;
	
	/**
	 * adds widgets to the layout.
	 *
	 * @param AWidget $widget the parent widget
	 * @param int $row the row (starting at 0)
	 * @param int $col the column (starting at 0)
	 * @param int|null $colspan Number of columns the widget spans. Optional.
	 */
	public function addWidget(AWidget $widget, $row,$col,$colspan=null){

		$row=(int)$row;
		$col=(int)$col;
		if($colspan){
			$colspan=(int)$colspan;
		}
		$this->__widgets[$row][$col]['widget']=$widget;
		$this->__widgets[$row][$col]['colspan']=$colspan;
	}
	
	
	
	/**
	 * Renders the 
	 *
	 * @return string
	 */
	public function render(){
		//get the max number of columns
		$max=0;
		foreach ($this->__widgets as $row){
			if(($x=max(array_keys($row)))>$max){
				$max = $x;
			}
		}
		$max++;
		//render the table
		$buffer="\n<table".$this->getAttributeHTML().">";
		$rows=max(array_keys($this->__widgets))+1;
		for($x=0;$x<$rows;$x++){
			$buffer.= "\n<tr>";
			for($y=0;$y < $max;$y++){
				$buffer.="\n<td";
				//prevent annoying notice errors with this if
				if(isset($this->__widgets[$x][$y])){
					$buffer.=($span=$this->__widgets[$x][$y]['colspan']) ? " colspan='$span'>" : ">";
					if(is_object(($text=$this->__widgets[$x][$y]['widget'])))$buffer.=$text->render();
				}
				if ($span)$y+=($span-1);
				$buffer.="</td>";
			}
			$buffer.="\n</tr>";
		}
		$buffer.="\n</table>";
		return $buffer;
	}

} // end of AGridLayout
?>
