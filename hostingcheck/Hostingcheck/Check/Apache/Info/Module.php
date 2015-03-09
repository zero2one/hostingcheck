<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve if a given Apache module is available.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Apache_Info_Module extends Hostingcheck_Info_Abstract
{
    /**
     * The name of the module.
     *
     * @var string
     */
    protected $name;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : the name of the module.
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
        if (!function_exists('apache_get_modules')) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $modules = apache_get_modules();
        if (!in_array($this->name, $modules)) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->value = new Hostingcheck_Value_Text('Enabled');
    }
}
