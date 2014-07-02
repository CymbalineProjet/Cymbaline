<?php

namespace Cymbaline\Generator\item;


/**
 * Description of Todo
 * 
 *
 * @author Thibault Jaxx Floyd Jeannet thibault.jeannet@gmail.com
 */
class Todo {

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
     * @return Todo
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
     * @return Todo
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
     * @return Matchs
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
	
	/**
	* Hydrate un objet
	*
	*/
	public function hydrate(\stdClass $todo) {
        
        $_todo = new Todo();
        foreach($todo as $attr => $value) {          
            $attribut = "set".ucfirst($attr);
            $_todo->$attribut($value);        
        }
        
        return $_todo;
    }
    
	/**
	* Hydrate tous les objets
	*
	*/
    static function hydrateAll(array $todos) {
        
        $todo = new \stdClass();
        $e = new Todo();
        
        foreach($todos as $attr => $value) {            
            foreach($value as $id => $valeur) {                
                if(!is_int($id)) {                 
                    $todo->{$id} = $valeur;
                }
            }
			
            $todos[$attr] = $e->hydrate($todo);
            unset($todo);
            $todo = new \stdClass();
        }
        
        return $todos;      
    }
    
}
