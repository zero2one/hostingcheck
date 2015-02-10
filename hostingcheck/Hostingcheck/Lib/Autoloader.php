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

        switch ($path[0]) {
            case 'Hostingcheck':
                $file = $this->hostingcheckFile($path);
                break;

            case 'Check':
                $file = $this->checkFile($path);
                break;

        }

        if ($file) {
            include HOSTINGCHECK_BASEPATH . $file;
        }
    }

    /**
     * Create the file path for Hostingcheck classes.
     *
     * @param array $path
     *     The class name split by the underscore.
     *
     * @return string
     *     The path to the file.
     */
    protected function hostingcheckFile($path)
    {
        $path[0] .= DIRECTORY_SEPARATOR . 'Lib';
        return implode(DIRECTORY_SEPARATOR, $path) . '.php';
    }

    /**
     * Create the file path for Check classes.
     *
     * @param array $path
     *     The class name split by the underscore.
     *
     * @return string
     *     The path to the file.
     */
    protected function checkFile($path)
    {
        $path[-1] = 'Hostingcheck';
        ksort($path);
        return implode(DIRECTORY_SEPARATOR, $path) . '.php';
    }
}
