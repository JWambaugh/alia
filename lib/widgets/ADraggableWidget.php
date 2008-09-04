<?php
/**
 *
 */


/**
 * A widget Decorator that allows widgets to be made draggable
 */
class ADraggableWidget extends AWidgetDecorator{
	
	function __construct(AWidget $widget){
		parent::__construct($widget);
		Alia::sendJScript("new Draggable('".$widget->getAttribute('id')."',{onEnd: function(draggable,mouseEvent){".AJScript::emit('moved',$this)."}});");
	}
	
}


