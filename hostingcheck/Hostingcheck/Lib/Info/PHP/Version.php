<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the PHP version number.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_PHP_Version extends Hostingcheck_Info_Abstract
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
        $this->value = new Hostingcheck_Value_Version(
            phpversion()
        );
    }
}
