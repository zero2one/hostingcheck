<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
