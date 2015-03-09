<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_Server_Info_DiskSize.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSize_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test not supported directory path.
     */
    public function testWithInvalidPath()
    {
        $info = new Check_Server_Info_DiskSize(
            array('path' => '/foo/bar/bin/baz')
        );
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $info->getValue()
        );
    }

    /**
     * Get the disk size without specifying any path.
     */
    public function testGetValue()
    {
        $path = dirname(__FILE__);
        $total = disk_total_space($path);

        // Total.
        $info = new Check_Server_Info_DiskSize();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Byte',
            $info->getValue()
        );
        $this->assertEquals($total, $info->getValue()->getValue());
    }

    /**
     * Test the get value method with specific path.
     */
    public function testGetValueByPath()
    {
        $path = '/';
        $total = disk_total_space($path);

        $info = new Check_Server_Info_DiskSize(array('path' => $path));
        $this->assertEquals($total, $info->getValue()->getValue());
    }
}
