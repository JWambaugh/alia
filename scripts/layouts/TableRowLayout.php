<?php


class TableRowLayout extends LayoutGenerator{
	public function generate($columns){
	
		$buffer="<tr {%attributes%} >\n";
		foreach($columns as $column=>$vals){
		$column=$vals['name'];
			$buffer.='<td>{'.$column."}</td>\n";
		}
		$buffer.="<td>{_saveButton}</td>\n<td>{_deleteButton}</td></tr>";
		return $buffer;
	}
	
}



?>  
