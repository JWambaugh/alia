<?php
/**
 * Autoloader for Alia
 *
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 */



/**
 * 
 */
require_once 'ASingletonInterface.php';

$loader = ALoader::instance();
$loader->addPathToEnd(".");

/**
 * A class/file loader for Alia	
 * @author Jordan Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @subpackage Core
 */
class ALoader {
	static private $instanceObject=null;
	private $paths=array();
	private $libPath;

	private $replacements=array();


	/**
	 * returns the instance of the ALoader object
	 *
	 * @return ALoader
	 */
	public function instance(){
		if(self::$instanceObject==null){
			self::$instanceObject = new ALoader();
		}
		return self::$instanceObject;
	}
	
	
	public function loadClass($class){
		foreach ($this->paths as $path){
		
			if(file_exists($path."/$class.php")){
				include$path."/$class.php";
			}
		}
	}


	/**
	 * includes a file once
	 *
	 * @param string $fileName
	 */
	public function includeFileOnce($fileName){
		require_once($this->getFilePath($fileName));
	}


	/**
	 * includes a file
	 *
	 * @param string $fileName
	 */
	public function includeFile($fileName){
		$path=$this->getFilePath($fileName);
		require $path;
		return ;
	}

	/**
	 * returns the full path to the file
	 *
	 * @param string $fileName
	 */
	public function getFilePath($fileName){

		foreach ($this->replacements as $replacement){
			$fileName = str_replace($replacement[0],$replacement[1],$fileName);
		}

		foreach ($this->paths as $path){
			//echo $path."/$fileName"."<br>";
			if(file_exists($path."/$fileName")){
				return $path."/$fileName";
			}
		}
		throw new Exception("File '$fileName' not found in any paths!");
	}


	/**
	 * get the contents of a file
	 *
	 * @param string $fileName
	 * @return string
	 */
	public function getFileContents($fileName){
		return file_get_contents($this->getFilePath($fileName));
		
	}

	
	/**
	 * adds a path to the beginning of the path list. paths in the beginning are searched first.
	 *
	 * @param string $path
	 */
	public function addPathToBeginning($path){
		if(!is_dir($path)){
			throw new Exception("specified path $path does not exist");
		}
		array_unshift($this->paths,$path);
	}

	/**
	 * Adds a path to the end of the path list. paths added to the end are searched last.
	 *
	 * @param unknown_type $path
	 */
	public function addPathToEnd($path){
		if(!is_dir($path)){
			throw new Exception("specified path $path does not exist");
		}
		array_push($this->paths,$path);
	}

	/**
	 * sets the path to the alia libray
	 * @param string $path
	 */
	public function setLibPath($path){
		$this->libPath = $path;
		$this->addPathToEnd($this->libPath);
		$this->addPathToEnd($this->libPath."/layouts");
		$this->addPathToEnd($this->libPath."/widgets");
		$this->addPathToEnd($this->libPath."/validator");
	}

	
	/**
	 * addReplacement
	 * Adds a string replacement rule to the loader.
	 * All instances of $search will be replaced with $replace while loading paths.
	 * 
	 * @param mixed $search 
	 * @param mixed $replace 
	 * @access public
	 * @return void
	 */
	public function addReplacement($search, $replace){
		$this->replacements[]=array($search,$replace);
	}

}
spl_autoload_register((array(ALoader::instance(),'loadClass')));

