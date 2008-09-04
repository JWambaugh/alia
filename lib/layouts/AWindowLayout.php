<?php

class AWindowLayout extends ALayout{
	
	public function render(){
		
		return "<div ".$this->getAttributeHTML()."><div style='cursor:move;background-color:lightblue' id ='".$this->getMainWidget()->getObjectID()."Title'>".$this->getMainWidget()->getTitle()."</div><div id ='".$this->getMainWidget()->getObjectID()."Content'>".$this->getMainWidget()->getMainWidget()->render()."</div></div>";
	}
	
}


