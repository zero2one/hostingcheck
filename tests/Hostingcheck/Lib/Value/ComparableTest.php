<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_Comparable.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Comparable_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the compareTo() method.
     */
    public function testCompareTo()
    {
        $comparable = new Hostingcheck_Value_Comparable('2');
        $this->assertSame(
            -1,
            $comparable->compareTo(new Hostingcheck_Value_Text('3'))
        );
        $this->assertSame(
            0,
            $comparable->compareTo(new Hostingcheck_Value_Text('2'))
        );
        $this->assertSame(
            1,
            $comparable->compareTo(new Hostingcheck_Value_Text('1'))
        );
    }

    /**
     * Test the equals() method.
     */
    public function testEquals()
    {
        $comparable = new Hostingcheck_Value_Comparable('3');
        $this->assertFalse(
            $comparable->equals(new Hostingcheck_Value_Text(4))
        );
        $this->assertTrue(
            $comparable->equals(new Hostingcheck_Value_Text(3))
        );
    }

    /**
     * Test the greaterThan() method.
     */
    public function testGreaterThan()
    {
        $comparable = new Hostingcheck_Value_Comparable('3');
        $this->assertFalse(
            $comparable->greaterThan(new Hostingcheck_Value_Text('3'))
        );
        $this->assertTrue(
            $comparable->greaterThan(new Hostingcheck_Value_Text('2'))
        );
    }

    /**
     * Test the greaterThanOrEqual() method.
     */
    public function testGreaterThanOrEqual()
    {
        $comparable = new Hostingcheck_Value_Comparable(3);
        $this->assertFalse(
            $comparable->greaterThanOrEqual(new Hostingcheck_Value_Text(4))
        );
        $this->assertTrue(
            $comparable->greaterThanOrEqual(new Hostingcheck_Value_Text('3'))
        );
        $this->assertTrue(
            $comparable->greaterThanOrEqual(new Hostingcheck_Value_Text('2'))
        );
    }

    /**
     * Test the lessThan() method.
     */
    public function testLessThan()
    {
        $comparable = new Hostingcheck_Value_Comparable('3');
        $this->assertFalse(
            $comparable->lessThan(new Hostingcheck_Value_Text(3))
        );
        $this->assertTrue(
            $comparable->lessThan(new Hostingcheck_Value_Text(3.1))
        );
    }

    /**
     * Test the lessThanOrEqual() method.
     */
    public function testLessThanOrEqual()
    {
        $comparable = new Hostingcheck_Value_Comparable('3');
        $this->assertFalse(
            $comparable->lessThanOrEqual(new Hostingcheck_Value_Text('2.9'))
        );
        $this->assertTrue(
            $comparable->lessThanOrEqual(new Hostingcheck_Value_Text('3'))
        );
        $this->assertTrue(
            $comparable->lessThanOrEqual(new Hostingcheck_Value_Text(3.1))
        );
    }
}
