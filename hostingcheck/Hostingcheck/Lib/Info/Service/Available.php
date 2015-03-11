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
 * Info class that indicates if the service is available.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Service_Available
    extends Hostingcheck_Info_Service_Abstract
{
    /**
     * Helper to extract and create the value.
     *
     * Will get "available" if the service is available.
     * Wil use the error message from the service if it is not available.
     */
    protected function collectValue()
    {
        $this->value = ($this->service()->isAvailable())
            ? new Hostingcheck_Value_Text('available')
            : new Hostingcheck_Value_NotSupported($this->service()->getError());
    }
}
