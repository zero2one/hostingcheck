<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Test_Result value object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_Result_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testIsSuccess()
    {
        $result = new Hostingcheck_Test_Result(true, 'foo');
        $this->assertTrue($result->isSuccess());

        $result = new Hostingcheck_Test_Result(false, 'foo');
        $this->assertFalse($result->isSuccess());
    }

    /**
     * Get the result value method.
     */
    public function testGetValue()
    {
        $result = new Hostingcheck_Test_Result(true, 'foo');
        $this->assertEquals('foo', $result->getValue());

        $result = new Hostingcheck_Test_Result(true, null);
        $this->assertNull($result->getValue());
    }
}
