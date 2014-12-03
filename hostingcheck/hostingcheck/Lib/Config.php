<?php
/**
 * Hostingcheck_Config
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Config
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_Config
{
    /**
     * Config instance
     * 
     * @var Hostingcheck_Config
     */
    protected static $_instance;
    
    /**
     * The config array
     * 
     * @var array
     */
    protected $_config;
    
    
    /**
     * Constructor
     */
    protected function __construct()
    {
        include(HOSTINGCHECK_BASEPATH . 'settings.php');
        $this->_config = $settings;
    }
    
    /**
     * Protect clone
     */
    protected function __clone()
    {}
    
    /**
     * Get an instance
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    /**
     * Get a part of the config
     * 
     * @param string $key
     * @param mixed $default
     *     The default value if key not in config
     * 
     * @return mixed
     */
     public function get($key, $default = null)
     {
         if(!isset($this->_config[$key])) {
             return $default;
         }
         
         return $this->_config[$key];
     }
}
