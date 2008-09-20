<?php
/**
 *  
 */

/**
 * Javascript helper
 *
 * Provides static methods for generating commonly-used javascript.
 * Because AJScript's methods are static, this class need not be instantiated. 
 *
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @copyright 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class AJScript{
	
	public static function convert($string){
		$params = func_get_args();
		array_shift($params);
		foreach ($params as $k=>$param){
			if(! $param instanceof AWidget){
				throw new Exception("parameter $k is not an instance of AObject!");
			}
			$count =1;
			$string= str_replace('?',$param->getObjectID(),	$string,$count);
		}
	}
	
	public static function object(AObject $object){
		return ("document.getElementById('".$object->getObjectID()."')");
	}
	
	public static function formElementValue(AObject $object){
		return ("document.getElementById('".$object->getObjectID()."').value");
	}
	
	
	/**
	 * generates javascript for emiting a signal from an object
	 *
	 * @param unknown_type $signal
	 * @param AObject $object
	 * @param null|array|string $params the parameter(s) to be passed with the signal
	 * @return unknown
	 */
	public static function emit($signal,AObject $object,$params = null){
		$paramText='';
		if($params!==null){
			//if params was passed as a single string, convert to an array
			if(is_string($params)){
				$params = array($params);
			}
			
			$paramText=", new Array(";
			$count = 0;
			foreach ($params as $param){
				if($count++ > 0){
					$paramText.=',';
				}
				$paramText.=$param;
			}
			$paramText.=")";
		}
		$buffer = "Alia.emit('".$object->getObjectID()."', '$signal'$paramText);";
		return $buffer;	
	}
	
	
	public static function renderConnection($connection){
		$buffer='';
		/*echo "<pre>";
		print_r($connection->getSource());
		echo "</pre>";*/
		$target="";
		if(is_object($connection->getTarget())){
			$target = $connection->getTarget()->getObjectID();
		}
		$script = "null";
		if($connection->getJavascript()){
			$script='function(params){'.$connection->getJavascript().'}';
		}

		if($connection->getSource()==="*"){
			$sourceId='*';
		} else {
			$sourceId=$connection->getSource()->getObjectID();
		}

		$buffer.="\n".'Alia.addConnection(new AConnection("'.$sourceId.'", "'.$connection->getSignalName().'", "'.$target.'", "'.$connection->getSlotMethod().'","'.$connection->getConnectionID().'",'.$script.'));';
		return $buffer;
	}
	
	public static function alert($text){
		$text = str_replace("\"","\\\"",$text);
		return "alert(\"$text\");";
	}
	
	public static function updateDiv($div, $innerHTML){
		$innerHTML = str_replace(array("'","\n"),array("\'",""),$innerHTML);
		return "Alia.replaceElementWithHTML(document.getElementById('$div'),'$innerHTML');";
	}
	
	
}
