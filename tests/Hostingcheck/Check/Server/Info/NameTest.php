<?php
/**
 * Tests for Check_Server_Info_Name.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_Name_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $name = gethostname();

        $info = new Check_Server_Info_Name();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Text',
            $info->getValue()
        );

        $this->assertEquals($name, $info->getValue()->getValue());
    }
}
