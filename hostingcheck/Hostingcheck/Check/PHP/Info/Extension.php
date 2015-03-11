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
 * Retrieve the version number of a given extension.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Extension extends Hostingcheck_Info_Abstract
{
    /**
     * The name of the extension.
     *
     * @var string
     */
    protected $name;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : the name of the extension.
     */
    public function __construct($arguments = array())
    {
        if (empty($arguments['name'])) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->name = $arguments['name'];
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        if (!extension_loaded($this->name)) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->value = new Hostingcheck_Value_Text('Enabled');
    }
}
