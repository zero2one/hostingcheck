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
        $path = explode('_', $className);

        // We support only the hostingcheck prefix.
        if ($path[0] !== 'Hostingcheck') {
            return;
        }

        // Construct the path.
        $base = HOSTINGCHECK_BASEPATH;
        switch ($path[1]) {
            case 'Test':
                break;

            default:
                $path[0] .= DIRECTORY_SEPARATOR . 'Lib';
                break;
        }

        // construct the file path
        $file = $base . implode(DIRECTORY_SEPARATOR, $path) . '.php';
        include $file;
    }
}