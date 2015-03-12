<?php
/**
 * Tests for Hostingcheck_Value_NotSupported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_DateTime_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testGetValue()
    {
        $dateTime = new DateTime();
        $value = new Hostingcheck_Value_DateTime($dateTime);
        $this->assertEquals($dateTime, $value->getValue());

        $dateTime = new DateTime('2012-12-25 13:14:15');
        $value = new Hostingcheck_Value_DateTime($dateTime);
        $this->assertEquals($dateTime, $value->getValue());
    }

    /**
     * Check set format.
     */
    public function testSetFormat()
    {
        $dateTime = new DateTime('2012-12-25 13:14:15');
        $format = 'd/m/Y H:i:s';
        $value = new Hostingcheck_Value_DateTime($dateTime);
        $this->assertInstanceOf(
            'Hostingcheck_Value_DateTime',
            $value->setFormat($format)
        );
        $this->assertEquals(
            $dateTime->format($format),
            (string) $value
        );
    }

    /**
     * Check get string.
     */
    public function testToString()
    {
        $dateTime = new DateTime('2012-12-25 13:14:15');
        $value = new Hostingcheck_Value_DateTime($dateTime);
        $this->assertEquals(
            $dateTime->format('Y-m-d H:i (P)'),
            (string) $value
        );
    }
}
