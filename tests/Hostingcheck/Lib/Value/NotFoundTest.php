<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_NotFound.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_NotFound_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testGetValue()
    {
        $value = new Hostingcheck_Value_NotFound();
        $this->assertNull($value->getValue());

        $value = new Hostingcheck_Value_NotFound('foobar');
        $this->assertEquals('foobar', $value->getValue());

    }

    /**
     * Check get string.
     */
    public function testToString()
    {
        $value = new Hostingcheck_Value_NotFound();
        $this->assertEquals('Not Found', (string) $value);

        $value = new Hostingcheck_Value_NotFound('foobar');
        $this->assertEquals('foobar', (string) $value);
    }
}
