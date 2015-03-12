<?php
/**
 * Tests for Hostingcheck_Message class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 *
 * @group api
 */
class Hostingcheck_Message_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test message without parameters.
     */
    public function testMessageWithoutParameters()
    {
        $text = 'Test message without parameters.';
        $message = new Hostingcheck_Message($text);

        $this->assertEquals($text, $message->message());
        $this->assertEquals($text, (string) $message);
    }

    /**
     * Test message with parameters.
     */
    public function testMessageWithParameters()
    {
        $text = 'Test message {name} with parameters {foo} and {bar}.';
        $parameters = array(
            'name' => 'FooName',
            'foo' => 'biz',
            'bar' => 'baz'
        );
        $message = new Hostingcheck_Message($text, $parameters);

        $expected = 'Test message FooName with parameters biz and baz.';
        $this->assertEquals($expected, $message->message());
    }
}
