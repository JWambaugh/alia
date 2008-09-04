<?php

class AJScriptEncoder{
	

	public static function encode($string){
		$buff=str_replace(array('"',"'"),array('%dq;','%sq;'),$string);
		return $buff;
	}


}




?> 
