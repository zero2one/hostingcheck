<?php
/**
 * Tests for Hostingcheck_Value_PHP_Config.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Config_TestCase extends PHPUnit_Framework_TestCase
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
        $info = new Check_PHP_Info_Config($config);
        $this->assertInstanceOf($expected_instance, $info->getValue());
        $this->assertSame($expected_value, $info->getValue()->getValue());
    }

    /**
     * Data provider for testGetValue().
     */
    public function getProviderGetValue()
    {
        $notSupported = new Hostingcheck_Value_NotSupported();
        $notFound = new Hostingcheck_Value_NotFound();
        $memoryLimit = new Hostingcheck_Value_Byte(ini_get('memory_limit'));

        return array(
            array(
                array(),
                'Hostingcheck_Value_NotSupported',
                $notSupported->getValue(),
            ),
            array(
                array('name' => 'fooBar.buzBaz'),
                'Hostingcheck_Value_NotFound',
                $notFound->getValue(),
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
