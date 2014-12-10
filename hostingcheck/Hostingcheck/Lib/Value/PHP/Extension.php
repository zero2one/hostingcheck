<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the version number of a given extension.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_PHP_Extension extends Hostingcheck_Value_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : the name of the extension.
     */
    public function __construct($arguments = array())
    {
        if (empty($arguments['name'])
            || !extension_loaded($arguments['name'])
        ) {
            $this->value = new Hostingcheck_Value_NotSupported();
        }
        else {
            $this->value = phpversion($arguments['name']);
        }
    }
}
