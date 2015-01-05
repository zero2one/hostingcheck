<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the config parameter for a given config key.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_PHP_Config extends Hostingcheck_Info_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : the name of the config key.
     */
    public function __construct($arguments = array())
    {
        if (empty($arguments['name'])) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $value = ini_get($arguments['name']);
        if ($value === false) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        if (isset($arguments['format']) && class_exists($arguments['format'])
        ) {
            $this->value = new $arguments['format']($value);
            return;
        }

        $this->value = new Hostingcheck_Value_Text($value);
    }
}
