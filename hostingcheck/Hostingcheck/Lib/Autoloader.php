<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Class Hostingcheck_Autoloader
 *
 * Autoloader provider for the hostingcheck project.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Autoloader {
    /**
     * Constructor registers itself to the autoload registry.
     */
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }
    
    /**
     * The loader method.
     *
     * @param string $className
     *      The name of the class that needs to be automatically loaded.
     */
    private function loader($className) {
        $path = explode('_', $className);
        $file = null;

        // List of class "namespaces" we support.
        $whitelist = array(
            'Hostingcheck' => 'Lib',
            'Check' => null,
        );

        // Autoload Hostingcheck classes.
        if ($path[0] === 'Hostingcheck') {
            // Construct the file path.
            $path[0] .= DIRECTORY_SEPARATOR . 'Lib';
            $file = implode(DIRECTORY_SEPARATOR, $path) . '.php';
        }

        // Autoload Check classes.
        if ($path[0] === 'Check') {
            $path[-1] = 'Hostingcheck';
            ksort($path);
            $file = implode(DIRECTORY_SEPARATOR, $path) . '.php';
        }

        if ($file) {
            include HOSTINGCHECK_BASEPATH . $file;
        }
    }
}
