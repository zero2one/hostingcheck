<?php
/**
 * Tests for Hostingcheck_Value_Text.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Text_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testGetValue()
    {
        $value = new Hostingcheck_Value_Text();
        $this->assertNull($value->getValue());

        $text = 'foobar';
        $value = new Hostingcheck_Value_Text($text);
        $this->assertEquals($text, $value->getValue());
    }

    /**
     * Check get string.
     */
    public function testToString()
    {
        $value = new Hostingcheck_Value_Text();
        $this->assertEquals('', (string) $value);

        $text = 'foobar';
        $value = new Hostingcheck_Value_Text($text);
        $this->assertEquals($text, (string) $value);
    }
}
