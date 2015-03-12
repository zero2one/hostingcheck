<?php
/**
 * Tests for Hostingcheck_Value_PHP_Extension.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Extension_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $info = new Check_PHP_Info_Extension(array('name' => 'json'));
        $this->assertInstanceOf(
            'Hostingcheck_Value_Text',
            $info->getValue()
        );
        $this->assertEquals('Enabled', $info->getValue()->getValue());

        $name = 'foo_bar_fake_extension';
        $value = new Check_PHP_Info_Extension(array('name' => $name));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );

        $value = new Check_PHP_Info_Extension(array());
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );
    }
}
