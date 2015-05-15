<?php

namespace source\Demo\DemoBox\item;


/**
 * Description of Test
 * 
 *
 * @author jaxx
 */
class Test {

	/**
     * #type=int#
     * #name=id#
     */
    private $id;

    /**
     * #type=string#
     * #name=label#
     */
    private $label;


    public function getId() {
         return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }
}
