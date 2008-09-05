<?php


class DefaultLayout extends LayoutGenerator{
	public function generate($columns){
		$buffer="<div {%attributes%} >\n";
		foreach($columns as $column=>$vals){
			$column = $vals['name'];
			$buffer.=$column.' {'.$column."}\n<br>\n";
		}
		$buffer.="{_saveButton}\n</div>";
		return $buffer;
	}
	
}



