<?php
/**
 * ATimer.php
 * File for ATimer class - the Alia Javascript Timer
 * 
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * 
 */


/**
 * Alia Javascript timer
 * 
 * ATimer is a javascript timer for Alia applications. 
 * If the timer is set to singleshot, the timer will run once, and once $interval has passed, the timeout signal will be emitted.
 * If the timer's singleshot is set to false, the timer will continue to run every $interval milliseconds.
 * 
 * Note that this is a javascript timer: the timer will not actually start until the data is sent back to the client.
 * @author Jordan CM Wambaugh <jordan@wambaugh.org>
 * @package Alia
 * @signal timeout Emitted every time the timer times out (every interval)
 */
class ATimer extends AObject{
	
	/**
	 * Milliseconds till timeout is emitted
	 * @var int
	 * @see setInterval()
	 */
	private $interval;
	
	/**
	 * Whether the timer is singleshot or not.
	 * singleshot timers only run once. 
	 * If this is set to false, the timer will continue to emit the timeout signal continuosly every $interval number of milliseconds.
	 *
	 * @var bool
	 */
	private $singleshot = false;
	
	/**
	 * Whether the timer is currently running
	 *
	 * @var bool
	 */
	private $active=false;
	
	public function __construct($interval=null,$singleshot = false){
		parent::__construct();
		$this->defineSignal('timeout');

		
		$this->setInterval( $interval);
		$this->setSingleShot($singleshot);
		
		//define our timer variable in javascript
		Alia::sendJScript('var '.$this->getObjectID()."Timer = new function(){this.timer = null;this.singleshot=".($this->singleshot==true?'true':'false').";}" );
		Alia::connect($this,'timeout',null,null,'if('.$this->getObjectID().'Timer.singleshot==false){'.$this->getObjectID()."Timer.timer = setTimeout(\"".AJScript::emit('timeout',$this)."\",{$this->interval});}");
		
	}
	
	
	/**
	 * sets the intervals between timeouts (in milliseconds)
	 *
	 * @param unknown_type $interval
	 * @see $interval
	 */
	public function setInterval($interval){
		$this->interval = $interval;
	}
	
	/**
	 * Sets whether the timer should repeat or just run once.
	 *
	 * @param bool $val true if only runs once, false to run repeatedly
	 */
	public function setSingleShot($val){
		$this->singleshot = (bool)$val;
	}
	
	/**
	 * stops the timer
	 *
	 */
	public function stop(){
		if($this->active == false){
			return ;
		}
		$this->active=false;
		Alia::sendJScript('clearTimeout('.$this->getObjectID()."Timer.timer);");
	}
	
	/**
	 * Starts the timer
	 *
	 */
	public function start(){
		if($this->interval==null){
			throw new Exception("Cannot start timer with null or 0 interval.");
		}
		Alia::sendJScript($this->getObjectID()."Timer.timer = setTimeout(\"".AJScript::emit('timeout',$this)."\",{$this->interval});");
		$this->active=true;
	}
	
	
	
}