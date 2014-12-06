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

        // We support only the hostingcheck prefix.
        if ($path[0] !== 'Hostingcheck') {
            return;
        }

        // Construct the file path.
        $base = HOSTINGCHECK_BASEPATH;
        switch ($path[1]) {
            case 'Test':
                break;

            default:
                $path[0] .= DIRECTORY_SEPARATOR . 'Lib';
                break;
        }
        $file = $base . implode(DIRECTORY_SEPARATOR, $path) . '.php';

        include $file;
    }
}
