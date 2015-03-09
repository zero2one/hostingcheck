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
class Hostingcheck_Autoloader
{
    /**
     * Mapping between the class "namespace" and the method to create the full
     * path to the file that contains the class.
     */
    protected $namespaces = array(
        'Hostingcheck' => 'hostingcheckFile',
        'Check'        => 'checkFile'
    );


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
     *     The name of the class that needs to be automatically loaded.
     */
    private function loader($className) {
        $file = $this->filePath($className);

        if (!empty($file)) {
            $filePath = HOSTINGCHECK_BASEPATH . $file;

            // Validate if the file exists.
            $this->fileExists($filePath, $className);

            require_once $filePath;
        }
    }

    /**
     * Get the proper path based on the class name.
     *
     * @param string $className
     *     The name of the class that needs to be automatically loaded.
     *
     * @return string|null
     *     The path (relative to root of project) to the file to include.
     *     Only if the class is supported by this auto loader.
     */
    protected function filePath($className) {
        $file = null;

        $path = explode('_', $className);
        $namespace = $path[0];

        if (isset($this->namespaces[$namespace])) {
            $fileMethod = $this->namespaces[$namespace];
            $file = $this->{$fileMethod}($path);
        }

        return $file;
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

    /**
     * Check if the given file exists.
     *
     * This will throw an exception if it does not exists.
     *
     * @param string $file
     *     The full path of the file.
     * @param string $className
     *     The name of the class.
     *
     * @return bool
     *     Success.
     *
     * @throws Exception.
     */
    protected function fileExists($file, $className)
    {
        if (file_exists($file)) {
            return true;
        }

        throw new Exception(sprintf("Can't load class %s", $className));
    }
}
