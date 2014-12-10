<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_Info.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Info_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testGetValue()
    {
        $value = new Hostingcheck_Value_Info();
        $this->assertNull($value->getValue());
        $this->assertEmpty((string) $value);

        $arguments = array('info' => 'Foo value');
        $value = new Hostingcheck_Value_Info($arguments);
        $this->assertEquals($arguments['info'], $value->getValue());
        $this->assertEquals($arguments['info'], (string) $value);
    }
}
