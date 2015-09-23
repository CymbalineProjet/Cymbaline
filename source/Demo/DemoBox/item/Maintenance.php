<?php

namespace source\Demo\DemoBox\item;


/**
 * Description of Maintenance
 * 
 *
 * @author Thibault Jeannet
 */
class Maintenance {

    /**
	*#type=int#
	*#name=attr#
	*/
	private $isStop;

	/**
	*#type=int#
	*#name=attr#
	*/
	private $time;



    public function getIsStop() {
		return $this->isStop;
	}

	public function getTime() {
		return $this->time;
	}



    public function setIsStop($isStop) {
		$this->isStop = $isStop;
		return $this->isStop;
	}

	public function setTime($time) {
		$this->time = $time;
		return $this->time;
	}


}
