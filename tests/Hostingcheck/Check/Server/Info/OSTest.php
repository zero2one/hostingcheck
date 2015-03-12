<?php
/**
 * Tests for Check_Server_Info_OS.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_OS_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $osName = php_uname();

        $info = new Check_Server_Info_OS();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Text',
            $info->getValue()
        );

        $this->assertEquals($osName, $info->getValue()->getValue());
    }
}
