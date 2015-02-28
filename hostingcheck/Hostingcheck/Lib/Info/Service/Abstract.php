<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Abstract implementation of an info object that contains a service.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Info_Service_Abstract
       extends Hostingcheck_Info_Abstract
    implements Hostingcheck_Info_Service_Interface
{
    /**
     * The service to use to collect the information.
     *
     * @var Hostingcheck_Service_Interface
     */
    protected $service;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - service : The service that should be used to collect the info.
     */
    public function __construct($arguments = array())
    {
        // Set the service we need to collect the information.
        if (!empty($arguments['service'])) {
            $this->service = $arguments['service'];
        }
    }

    /**
     * Get the service from the info object.
     *
     * @return Hostingcheck_Service_Interface
     */
    public function service()
    {
        return $this->service;
    }
}
