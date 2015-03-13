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
 * Retrieve the config parameter for a given config key.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Config extends Hostingcheck_Info_Abstract
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
            $this->value = new Hostingcheck_Value_NotFound();
            return;
        }

        $this->value = new $this->format($value);
    }
}
