<?php
/**
 *  
 */

require_once 'AObject.php';


/**
 * AConnectionRegistry 
 * 
 * @package Alia
 * @subpackage Core
 * @version $id$
 * @copyright 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org> 
 * @license 
 */
class AConnectionRegistry
{

	/**
	 *
	 * @var ArrayObject
	 */
	public $connections;
	
	static private $instanceObject=null;
	
	private $IDCounter=0;
	
	private function __construct(){
		$this->connections = array();
	}
	
	
	/**
	 * returns the instance of the Alia object
	 *
	 * @return AConnectionRegistry
	 */
	public function instance(){
		Alia::startSessionOnce();
		//prevent notices
		if(!isset($_SESSION['alia']['connectionRegistry']))$_SESSION['alia']['connectionRegistry']=null;
		
		if($_SESSION['alia']['connectionRegistry'] == null){
			$_SESSION['alia']['connectionRegistry'] = new AConnectionRegistry();
		}
		return $_SESSION['alia']['connectionRegistry'];
	}
	
	public function addConnection(AConnection $connection){
		$this->generateID($connection);
		$this->connections[]=$connection;
		Alia::sendJScript(AJScript::renderConnection($connection));
	}
	
	public function getConnections(){
		return $this->connections;
	}
		
	
	/**
	 * Assigns an AObject a unique ID
	 *
	 * @param AObject $object
	 */
	private function generateID(AConnection $connection){
		$id='connection'.$this->IDCounter++;
		$connection->setConnectionID($id);
	}
	
	
	public function getConnectionByID($id){
		foreach ($this->connections as $connection){
			if($connection->getConnectionID() == $id ){
				return $connection;
			}
		}
	}

	/**
	* Wipes out all connections. Dangerous!
	**/
	public function clearAllConnections(){
		$this->connections = new ArrayObject();
	}
	

	public function clearConnections($widget){
		foreach($this->connections as $k=>$v){
			if($v->getTarget()===$widget || $v->getSource() === $widget){
				$this->connections[$k]->clear();
				unset($this->connections[$k]);
			}
		}
	}



} // end of AObjectRegistry
?>
