<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Info_Server_Name.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Server_Name_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $name = gethostname();

        $info = new Hostingcheck_Info_Server_Name();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Text',
            $info->getValue()
        );

        $this->assertEquals($name, $info->getValue()->getValue());
    }
}
