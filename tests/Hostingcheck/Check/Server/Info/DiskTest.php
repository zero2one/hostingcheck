<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_Server_Info_Disk.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_Disk_TestCase extends PHPUnit_Framework_TestCase
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

        // Total.
        $info = new Check_Server_Info_Disk();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Byte',
            $info->getValue()
        );
        $this->assertEquals($total, $info->getValue()->getValue());

        // Free.
        $info = new Check_Server_Info_Disk(array('name' => 'free'));
        $this->assertEquals($free, $info->getValue()->getValue());

        // Used.
        $info = new Check_Server_Info_Disk(array('name' => 'used'));
        $this->assertEquals($used, $info->getValue()->getValue());

        // Not supported.
        $info = new Check_Server_Info_Disk(array('name' => 'foobar'));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $info->getValue()
        );
    }

    /**
     * Test the get value method with specific path.
     */
    public function testGetValueByPath()
    {
        $path = '/';
        $total = disk_total_space($path);

        $info = new Check_Server_Info_Disk(array('path' => $path));
        $this->assertEquals($total, $info->getValue()->getValue());

        // Non existing path.
        $path = '/foo/bar/buz/baz';
        $info = new Check_Server_Info_Disk(array('path' => $path));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $info->getValue()
        );

        // Path to file instead of directory.
        $path = __FILE__;
        $info = new Check_Server_Info_Disk(array('path' => $path));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $info->getValue()
        );
    }
}
