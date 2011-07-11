<?php
/**
* Class implements get/set functionality
* 
* @author Vitaly Glibin
*/

class Qw_Common_GetterSetter {
    /**
    * Object wich contains all our properties
    * 
    * @var stdClass
    */
    protected $_object;
    
    public function __construct()
    {
        $this->_object = new stdClass();
    }
    
    /**
    * Setting param
    * 
    * @param string $name parameter name
    * @param mixed $value
    */
    public function __set($name, $value)
    {
        $this->_object->{$name} = $value;
    }
    
    /**
    * Getting param
    * 
    * @param string $name
    */
    public function __get($name)
    {
        if (isset($this->_object->{$name})) {
            return $this->_object->{$name};
        }
        
        return null;
    }
    
    /**
    * Check if property is set
    * 
    * @param string $name
    */
    public function __isset($name)
    {
        return isset($this->_object->{$name});
    }
    
    /**
    * Unset property value
    * 
    * @param string $name
    */
    public function __unset($name)
    {
        unset($this->_object->{$name});
    }
}
