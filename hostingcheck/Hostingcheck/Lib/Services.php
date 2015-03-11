<?php
/**
 * This file is part of Hostingcheck.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2015 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/MIT
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
