<?php
/**
 * Tests for Hostingcheck_Value_PHP_VersionTest.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $phpversion = phpversion();

        $info = new Check_PHP_Info_Version();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Version',
            $info->getValue()
        );

        $this->assertEquals($phpversion, $info->getValue()->getValue());
    }
}
