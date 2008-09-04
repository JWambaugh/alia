<?php
/**
 * Contains the AApplication class
 * @author Jordan CM Wambaugh <jordan.wambaugh@forrent.com> 
 * @package Alia
 * @subpackage Core
 */


/**
 * AApplication 
 * 
 * Provides application-level services for alia applications
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @author Jordan CM Wambaugh <jordan.wambaugh@forrent.com> 
 * @license 
 */
class AApplication
{
	/**
	 * @var string
	 */
	private $frontURL="/front.php";

	/**
	 * 
	 *
	 * @var AWidget
	 */
	private $mainWidget;


	static private $instanceObject=null;


	/**
	 * constructs the Alia object
	 *
	 */
	private function __construct(){
	

	}

	/**
	 * returns the instance of the AAplication object
	 *
	 * @return AApplication
	 */
	public function instance(){
		if(self::$instanceObject==null){
			self::$instanceObject = new AApplication();
		}
		return self::$instanceObject;
	}

	/**
	 * returns the HTML necisarry for Alia's AJAX support
	 * @returnstring the generated HTML
	 */
	public function getHeaders(){
		//echo count (AConnectionRegistry::instance()->getConnections());
		
		
		return "<script src = '{$this->frontURL}?jscript[]=jquery-1.2.3.min.js&jscript[]=Alia.js&jscript[]=validator.js'></script>
";
	}
	
	private function output($string){
		$script = AJScriptBuffer::instance()->getJScript();		
		$buffer= "<head>";
		$buffer.=$this->getHeaders();
		$buffer.="</head>
<body>$string
<script>
var AliaFrontURL = '$this->frontURL';
$script
</script>
</body>";

		return $buffer;
	}

	/**
	 * runs the application
	 */
	public function run(){
		Alia::startSessionOnce();
		ob_start();
		echo $this->output($this->mainWidget->render());
	}
	
	
	/**
	 * Sets the main application widget.
	 * @param AWidget the main widget for the application
	 */
	public function setMainWidget(AWidget $widget){
		$this->mainWidget=$widget;
	}

	/**
	 * Sets the url to alia's front controller
	 */
	public function setFrontURL($url){
		$this->frontURL = $url;
	}

	/**
	 * returns the URL to the front controller
	 */
	public function getFrontURL(){
		return $this->frontURL;
	}

	public function getMainWidget(){
	return $this->mainWidget;	
	}

} // end of AApplication
?>
