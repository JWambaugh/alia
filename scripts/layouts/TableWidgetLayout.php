<?php


class TableWidgetLayout extends LayoutGenerator{
	public function generate($columns){
	
		$buffer="<table {%attributes%} >\n<tr>";
		
		foreach($columns as $column=>$vals){
			$column=$vals['name'];
			$buffer.='<th>'.$column."</th>\n";
		}
		$buffer.="<tr>\n";

		$buffer.='<? foreach($this->getWidgets() as $widget){
			if(! $widget instanceof APushButton)echo $widget->render();
		}?>
		<tr>
		<td>{prevButton}</td>
		<td>{nextButton}</td>
		</tr>
		</table>';

		return $buffer;
	}
	
}



?>  
