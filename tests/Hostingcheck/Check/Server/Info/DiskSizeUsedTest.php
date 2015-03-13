<?php
/**
 * Tests for Check_Server_Info_DiskSizeUsed.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSizeUsed_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $path = dirname(__FILE__);

        $total = disk_total_space($path);
        $free  = disk_free_space($path);
        $used  = $total - $free;

        $info = new Check_Server_Info_DiskSizeUsed();
        $this->assertEquals($used, $info->getValue()->getValue());
    }
}
