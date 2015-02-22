<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parses an array with service configurations into the Services collection.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Services_Parser extends Hostingcheck_Collection_Keyed
{
    /**
     * Parse the array and return the collection.
     *
     * @param array
     *     Configuration array.
     *
     * @return Hostingcheck_Services
     *     The services collection.
     */
    public function parse($config)
    {
        $collection = new Hostingcheck_Services();

        foreach ($config as $name => $serviceConfig) {
            $service = $this->parseService($serviceConfig);

            if (!$service) {
                continue;
            }

            $collection->add($name, $service);
        }

        return $collection;
    }

    /**
     * Parse a single service from a config.
     *
     * @param array $serviceConfig
     *     The config array should contain 2 parameters:
     *     - class : the service class name.
     *     - config : the config to pass to the service class constructor.
     *
     * @return Hostingcheck_Service_Interface|false
     *     Returns false if no service was found or an error occurred.
     */
    public function parseService($serviceConfig)
    {
        $className = $serviceConfig['class'];
        $config = (!empty($serviceConfig['config']))
            ? new Hostingcheck_Config($serviceConfig['config'])
            : new Hostingcheck_Config(array());

        try {
            $service = new $className($config);
            return $service;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
