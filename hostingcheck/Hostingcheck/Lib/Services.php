<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * The collection of services to use during the checks & tests.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Services extends Hostingcheck_Collection_Keyed
{
    /**
     * Add a single service to the collection.
     *
     * @param string $name
     *     The service name (key).
     * @param Hostingcheck_Service_Interface $service
     *     The service to store in the collection.
     */
    public function add($name, Hostingcheck_Service_Interface $service)
    {
        $this->collection[$name] = $service;
        $this->updateKeys();
    }
}
