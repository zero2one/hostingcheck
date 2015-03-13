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
 * Interface to extend the Info service with service support.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Info_Service_Interface
{
    /**
     * Get the service from the info object.
     *
     * @return Hostingcheck_Service_Interface
     */
    public function service();
}
