<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
