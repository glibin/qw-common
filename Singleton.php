<?php 

/**
 * Base singleton class
 * 
 * Базовый класс-синглтон
 * 
 * @author Glibin Vitaly <glibin.v@gmail.com>
 * @version 0.1
 * @package common
 * @subpackage classes
 *
 */

abstract class Qw_  Common_Singleton
{
    /**
     * Instance of this class
     * 
     * Переменная, хранящаяя экземпляра данного класса
     * 
     * @static
     * @var private
     */
    private static $_instance = array();
    
    /**
     * Class constructor
     * 
     * Конструктор
     * 
     * 
     * @access protected
     *
     */
    protected function __construct() {
          
    }
    
    /**
     * Singleton method to get class instance 
     * 
     * Метод-синглтон для получения экземпляра класса
     * 
     * @static
     * @return class 
     */ 
    public static function getInstance()
    {
        $classname = get_called_class();
        
        if( !isset( self::$_instance[$classname] ) )
            self::$_instance[$classname] = new $classname();

        return self::$_instance[$classname];
    }
        
    /**
     * Disable cloning of the class
     * 
     * Предотвращает клонирование экземпляра класса
     *
     */
    public function __clone()
    {
        trigger_error(get_class($this).' clone failed', E_USER_ERROR);
    }
}
