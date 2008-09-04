<?php
/**
 *
 */



/**
 *
 */
class AWindow extends AHTMLElement{
	
	/**
	 * @var string
	 */
	private $title;
	
	private $draggable = false;
	
	/**
	 * @var AWidget
	 */
	private $mainWidget;
	
	/**
	 *
	 */
	public function __construct(){
		parent::__construct();
		$this->defineSignal('moved');
		$this->setLayout(new AWindowLayout($this));
	}
	
	/**
	 *
	 */
	public function getTitle(){
		return $this->title;
	}
	
	/**
	 * @return AWidget the main widget
	 */
	public function getMainWidget(){
		return $this->mainWidget;
	}
	
	/**
	 * @param string $title
	 */
	public function setTitle($title){
		$this->title = (string)$title;
	}
	
	/**
	 *
	 * @param AWidget $widget The widget to set as the main wisget in the window
	 */
	public function setMainWidget(AWidget $widget){
		$this->mainWidget = $widget;
	}
	
	public function toggleDraggable(){
		if($this->draggable){
			
		}else{
			$this->draggable = true;
			Alia::sendJScript("new Draggable('".$this->getAttribute('id')."',{handle: '".$this->getAttribute('id')."Title', onEnd: function(draggable,mouseEvent){".AJScript::emit('moved',$this)."}});");
		}
	}


}
?>
