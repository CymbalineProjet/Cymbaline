<?php

namespace Cymbaline\Administration\item;


/**
 * Description of Tasks
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet thibault.jeannet@gmail.com
 */
class Tasks {

    /**
     * #type=int#
     * #name=id#
     */
    private $id;
	
	/**
     * #type=string#
     * #name=content#
     */
    private $content;
	
	/**
     * #type=bool#
     * #name=flag#
     */
    private $flag;
    
    /**
     * #type=datetime#
     * #name=date#
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
     * Set id
     *
     * @return integer 
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
