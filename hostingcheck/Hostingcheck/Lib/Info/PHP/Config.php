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
     * PHP Config key to be checked.
     *
     * @var string
     */
    protected $key;

    /**
     * Format to be used for the value.
     *
     * @var string
     */
    protected $format;


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

        $this->key = $arguments['name'];
        $this->format = (isset($arguments['format']) && class_exists($arguments['format']))
            ? $arguments['format']
            : 'Hostingcheck_Value_Text';
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        $value = ini_get($this->key);
        if ($value === false) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->value = new $this->format($value);
    }
}
