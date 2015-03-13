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
 * Retrieve the Apache version number.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Apache_Info_Version extends Hostingcheck_Info_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - None
     */
    public function __construct($arguments = array())
    {}

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        if (function_exists('apache_get_version')) {
            preg_match('#Apache\/([0-9\.]*)#', apache_get_version(), $found);
            $this->value = new Hostingcheck_Value_Version($found[1]);
        }
        else {
            $this->value = new Hostingcheck_Value_NotSupported();
        }
    }
}
