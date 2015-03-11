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
 * - Check if it exists.
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
