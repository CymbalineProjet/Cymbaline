<?php

namespace Cymbaline\Administration\item;

use Cymbaline\Generator\interfaces\ItemCRUD;


/**
 * Description of Tasks
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet thibault.jeannet@gmail.com
 */
class Tasks implements ItemCRUD {

    /**
     * DBManager(name=id;type=int;null=false)
     * Form(type=integer;required=true)
     */
    private $id;
	
	/**
     * DBManager(name=content;type=string)
     * Form(type=text;required=true)
     */
    private $content;
	
	/**
     * DBManager(name=flag;type=bool)
     * Form(type=bool;required=false)
     */
    private $flag;
    
    /**
     * DBManager(name=date;type=datetime;default=now)
     * Form(type=datetime;required=true)
     */
    private $date;
	
	/**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return Tasks
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Tasks
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
	
	/**
     * Set flag
     *
     * @param bool $flag
     * @return Tasks
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return bool 
     */
    public function getFlag()
    {
        return $this->flag;
    }
    
    /**
     * Set date
     *
     * @param mixed $date
     * @return Date
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return mixed 
     */
    public function getDate()
    {
        return $this->date;
    }
	
}
