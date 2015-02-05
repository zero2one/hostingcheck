<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_NotSupported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testGetValue()
    {
        $version = new Hostingcheck_Value_Version();
        $this->assertNull($version->getValue());

        $text = '2.5.7';
        $version = new Hostingcheck_Value_Version($text);
        $this->assertEquals($text, $version->getValue());
    }

    /**
     * Check get string.
     */
    public function testToString()
    {
        $version = new Hostingcheck_Value_Text();
        $this->assertEquals('', (string) $version);

        $text = '2.5.7';
        $version = new Hostingcheck_Value_Text($text);
        $this->assertEquals($text, (string) $version);
    }

    /**
     * Test the compareTo() method.
     */
    public function testCompareTo()
    {
        $version = new Hostingcheck_Value_Version('2.5.1');
        $this->assertSame(
            -1,
            $version->compareTo(new Hostingcheck_Value_Version('2.5.2'))
        );
        $this->assertSame(
            0,
            $version->compareTo(new Hostingcheck_Value_Version('2.5.1'))
        );
        $this->assertSame(
            1,
            $version->compareTo(new Hostingcheck_Value_Version('2.5'))
        );
    }

    /**
     * Test the equals() method.
     */
    public function testEquals()
    {
        $version = new Hostingcheck_Value_Version('3.0');
        $this->assertFalse(
            $version->equals(new Hostingcheck_Value_Version('3.0.1'))
        );
        $this->assertTrue(
            $version->equals(new Hostingcheck_Value_Version('3.0'))
        );
    }

    /**
     * Test the greaterThan() method.
     */
    public function testGreaterThan()
    {
        $version = new Hostingcheck_Value_Version('3');
        $this->assertFalse(
            $version->greaterThan(new Hostingcheck_Value_Version('3'))
        );
        $this->assertTrue(
            $version->greaterThan(new Hostingcheck_Value_Version('2.9.9.9'))
        );
    }

    /**
     * Test the greaterThanOrEqual() method.
     */
    public function testGreaterThanOrEqual()
    {
        $version = new Hostingcheck_Value_Version('3');
        $this->assertFalse(
            $version->greaterThanOrEqual(new Hostingcheck_Value_Version('3.0'))
        );
        $this->assertTrue(
            $version->greaterThanOrEqual(new Hostingcheck_Value_Version('3'))
        );
        $this->assertTrue(
            $version->greaterThanOrEqual(new Hostingcheck_Value_Version('2.9.9.9'))
        );
    }

    /**
     * Test the lessThan() method.
     */
    public function testLessThan()
    {
        $version = new Hostingcheck_Value_Version('3');
        $this->assertFalse(
            $version->lessThan(new Hostingcheck_Value_Version('3'))
        );
        $this->assertTrue(
            $version->lessThan(new Hostingcheck_Value_Version('3.0'))
        );
    }

    /**
     * Test the lessThanOrEqual() method.
     */
    public function testLessThanOrEqual()
    {
        $version = new Hostingcheck_Value_Version('3');
        $this->assertFalse(
            $version->lessThanOrEqual(new Hostingcheck_Value_Version('2.9'))
        );
        $this->assertTrue(
            $version->lessThanOrEqual(new Hostingcheck_Value_Version('3'))
        );
        $this->assertTrue(
            $version->lessThanOrEqual(new Hostingcheck_Value_Version('3.0'))
        );
    }
}
