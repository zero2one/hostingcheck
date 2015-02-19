<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for the services.
 *
 * Some info collectors need a connection to a service.
 * Connecting to them can require specific config and credentials.
 * The Hostingcheck_Service is an abstraction of the service so it easier to
 * pass it around and to mock it in tests.
 *
 * Each service needs to provide at least one method: isAvailable().
 * This should check if the service is available by:
 * - Trying to connect to it.
 * - Checking if it exists.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Service_Interface
{
    /**
     * The constructor accepts only one param: the configuration object.
     *
     * @param Hostingcheck_Config $config
     */
    public function __construct(Hostingcheck_Config $config);

    /**
     * Is the service available.
     *
     * @return bool
     *     Available true/false.
     */
    public function isAvailable();

    /**
     * Check if the service has an error.
     *
     * @return bool
     */
    public function hasError();

    /**
     * Get the error (if any).
     *
     * @return string
     */
    public function getError();
}
