<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_PHP_Config.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_PHP_Config_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     *
     * @param array $config
     *     Array containing:
     *     - name   : the config key name.
     *     - format : (optional) format for the returned value.
     * @param string $expected_instance
     *     The expected Hostingcheck_Value_<name> instance.
     * @param mixed $expected_value
     *     The expected value.
     *
     * @dataProvider getProviderGetValue
     */
    public function testGetValue($config, $expected_instance, $expected_value)
    {
        $info = new Hostingcheck_Info_PHP_Config($config);
        $this->assertInstanceOf($expected_instance, $info->getValue());
        $this->assertSame($expected_value, $info->getValue()->getValue());
    }

    /**
     * Data provider for testGetValue().
     */
    public function getProviderGetValue()
    {
        $notSupported = new Hostingcheck_Value_NotSupported();
        $memoryLimit = new Hostingcheck_Value_Byte(ini_get('memory_limit'));

        return array(
            array(
                array(),
                'Hostingcheck_Value_NotSupported',
                $notSupported->getValue(),
            ),
            array(
                array('name' => 'fooBar.buzBaz'),
                'Hostingcheck_Value_NotSupported',
                $notSupported->getValue(),
            ),
            array(
                array('name' => 'memory_limit'),
                'Hostingcheck_Value_Text',
                ini_get('memory_limit'),
            ),
            array(
                array(
                    'name' => 'memory_limit',
                    'format' => 'Hostingcheck_Value_Byte'
                ),
                'Hostingcheck_Value_Byte',
                $memoryLimit->getValue(),
            ),
            array(
                array('name' => 'allow_url_fopen'),
                'Hostingcheck_Value_Text',
                ini_get('allow_url_fopen'),
            ),
            array(
                array('name' => 'allow_url_include'),
                'Hostingcheck_Value_Text',
                ini_get('allow_url_include'),
            ),
            array(
                array('name' => 'expose_php'),
                'Hostingcheck_Value_Text',
                ini_get('expose_php'),
            ),
        );
    }
}
