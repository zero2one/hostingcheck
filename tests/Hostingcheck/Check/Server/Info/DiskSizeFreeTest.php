<?php
/**
 * Tests for Check_Server_Info_DiskSizeFree.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSizeFree_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $path = dirname(__FILE__);
        $free  = disk_free_space($path);

        $info = new Check_Server_Info_DiskSizeFree();
        $this->assertEquals($free, $info->getValue()->getValue());
    }
}
