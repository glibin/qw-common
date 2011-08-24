<?php
/**
* Basic object implementation
* 
* @author Vitaly Glibin
*/

class Qw_Common_Object extends Qw_Common_GetterSetter
{
    public function __construct($data = array())
    {
        parent::__construct();
        if (is_array($data))
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
    
    /**
    * Converts our class to simple stdClass object with recursive check for properties as objects
    * 
    * @return stdClass
    */
    public function toObject()
    {        
        $result = new stdClass();
        foreach($this->_object as $key => $value) {
            $result->{$key} = $this->_convertToObject($value);            
        }
        return $result;        
    }
    
    protected function _convertToObject($object) 
    {
        $result = null;
        
        if (is_object($object) && method_exists($object, 'toObject')) {
            $result = $object->toObject();
        }
        else if (is_array($object)) {
            $result = array();                
            foreach($object as $k => $item) {
                $result[$k] = $this->_convertToObject($item);
            }
        }
        else {
            $result = $object;
        }
        
        return $result;
    }
    
    /**
    * Converts our class to simple array with recursive check for properties as objects
    * 
    * @return array
    */
    public function toArray()
    {
        $result = array();
        foreach($this->_object as $key => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $result[$key] = $value->toArray();
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;        
    }
    
    /**
    * Converts our class to json string
    * Also used by Zend_Json then encoding objects
    * @see Zend_Json::encode
    * 
    * @return string
    * 
    */
    public function toJson()
    {
        return json_encode($this->toObject());
    }
    
    public function __clone() {
        $this->_object = clone $this->_object;
    }
    
    public function __destruct() {
        //unset($this->_object);
    }
}
