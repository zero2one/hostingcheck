<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the Apache version number.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Apache_Version extends Hostingcheck_Value_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - None
     */
    public function __construct($arguments = array())
    {
        if (function_exists('apache_get_version')) {
            preg_match('#Apache\/([0-9\.]*)#', apache_get_version(), $found);
            $this->value = $found[1];
        }
        else {
            $this->value = new Hostingcheck_Value_NotSupported();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        if ($this->getValue() instanceof Hostingcheck_Value_NotSupported) {
            return (string) $this->getValue();
        }

        parent::__toString();
    }
}