<?

class ASortableList extends AWidget{
	public function __construct(){
		parent::__construct();
		$this->setLayout(new ASimpleLayout($this));
		Alia::sendJScript('Sortable.create("'.$this->getObjectID().'", {dropOnEmpty:true, constraint:false,tag:"div"});');
		
	}
	
	
	
}



?>