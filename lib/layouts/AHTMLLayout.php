<?php
/**
 *AHTMLLayout
 *
 * @package Alia
 * @subpackage Layouts
 */

/**
 * AHTMLLayout
 *
 * @package Alia
 * @subpackage Layouts
 */

class AHTMLLayout extends ALayout
{
	
	private $templateFile;
	
	function __construct($object,$templateFile=''){
		parent::__construct($object);
		$this->setTemplateFile($templateFile);
	}
	
	public function render(){
		ob_start();
		$path=ALoader::instance()->getFilePath($this->templateFile);
		require $path;
		$buffer = ob_get_clean();
		//ob_end_clean();
		
		$buffer = str_replace('{%attributes%}',$this->getAttributeHTML(),$buffer);
		foreach($this->getWidgets() as $key=>$widget){
			
			$buffer = str_replace('{'.$key.'}',$widget->render(),$buffer);
		}

		return $buffer;
	}

	
	public function setTemplateFile($fileName){
		$this->templateFile = $fileName;
	}
	

} // end of AHTMLLayout
?>
