<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_Apache_Info_Module
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Apache_Info_Module_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value if no module name is in the args.
     */
    public function testNoModuleName()
    {
        $module = new Check_Apache_Info_Module();
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $module->getValue()
        );
    }

    /**
     * Check get value method without support for Apache.
     *
     * The apache_get_modules() function does only exists if the request is
     * received trough Apache.
     */
    public function testNotSupported()
    {
        $args = array('name' => 'mod_rewrite');
        $module = new Check_Apache_Info_Module($args);
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $module->getValue()
        );
    }

    /**
     * Check get value method if the function exists.
     *
     * We "mock" the function first.
     */
    public function testSupportedModuleEnabled()
    {
        $this->createApacheGetModulesFunction();

        $args = array('name' => 'mod_rewrite');
        $module = new Check_Apache_Info_Module($args);
        $this->assertInstanceOf(
            'Hostingcheck_Value_Text',
            $module->getValue()
        );
        $this->assertEquals('Enabled', $module->getValue());
    }

    /**
     * Check get value method if the function exists & module is not enabled.
     *
     * We "mock" the function first.
     */
    public function testSupportedModuleDisabled()
    {
        $this->createApacheGetModulesFunction();

        $args = array('name' => 'mod_foobar');
        $module = new Check_Apache_Info_Module($args);
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $module->getValue()
        );
    }

    /**
     * Helper to create the missing apache_get_modules() function.
     */
    protected function createApacheGetModulesFunction()
    {
        if (function_exists('apache_get_modules')) {
            return;
        }

        function apache_get_modules() {
            return array(
                'mod_rewrite',
                'mod_deflate',
            );
        }
    }
}
