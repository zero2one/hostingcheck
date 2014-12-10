<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Value that indicates that the requested value is not supported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_NotSupported extends Hostingcheck_Value_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - info  : The info that should be stored as the value of this object.
     */
    public function __construct($arguments = array())
    {
        $this->value = 'Not Supported.';
    }
}
