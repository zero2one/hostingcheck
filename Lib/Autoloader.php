<?php
/**
 * Hostingcheck_Autoloader
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Autoloader
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_Autoloader {
    /**
     * Constructor registers itself to the autoload registry
     */
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    
    /**
     * The loader method
     */
    private function loader($className) {
        $parts = explode('_', $className);
        
        // we don't need the hostingcheck_ prefix
        $replace = array(0 => HOSTINGCHECK_BASEPATH);
        
        // add the Lib to the core libraries
        $tests = array('Test', 'Tests');
        if($parts[1] !== 'Tests') {
            $replace[0] .= DIRECTORY_SEPARATOR . 'Lib';
        }
        
        $path = array_replace($parts, $replace);
        
        // construct the file path
        $file = implode(DIRECTORY_SEPARATOR, $path) . '.php';
        include $file;
    }
}