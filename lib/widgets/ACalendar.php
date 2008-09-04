<?php
/**
 * @author Jordan CM Wambaugh
 * @package Alia
 * @subpackage Widgets
 *
 */


/**
 *
 *@author Jordan CM Wambaugh
 * @package Alia
 * @subpackage Widgets
 * 
 *
 */
class ACalendar extends AWidget{
	
	private  $months = array(1=>array('January',31)
			,2=>array('February',28)
			,3=>array('March',31)
			,4=>array('April',30)
			,5=>array('May',31)
			,6=>array('June',30)
			,7=>array('July',31)
			,8=>array('August',31)
			,9=>array('September',30)
			,10=>array('October',31)
			,11=>array('November',30)
			,12=>array('December',31));
	private $month;
	
	public function __construct(){
		$this->month = 3;
		
	}
	
	public function render(){
		
		$buffer= "<div style ='overflow:hidden;'><div>{$this->months[$this->month][0]}</div>";

		for($x=1;$x<=$this->months[$this->month][1];$x++){
			$buffer.="<div style='float:left;width:14%;'>$x</div>";
		}
		$buffer.="</div>";
		return $buffer;
	}

}


