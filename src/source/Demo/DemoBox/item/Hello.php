<?php

namespace source\Demo\DemoBox\item;


/**
 * Description of Hello
 * 
 *
 * @author Jaxx
 */
class Hello {

    /**
	*#type=int#
	*#name=attr#
	*/
	private $id;

	/**
	*#type=int#
	*#name=attr#
	*/
	private $label;

	/**
	*#type=int#
	*#name=attr#
	*/
	private $slug;



    public function getId() {
		return $this->id;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getSlug() {
		return $this->slug;
	}



    public function setId($id) {
		$this->id = $id;
		return $this->id;
	}

	public function setLabel($label) {
		$this->label = $label;
		return $this->label;
	}

	public function setSlug($slug) {
		$this->slug = $slug;
		return $this->slug;
	}


}
