<?php
/**
 * Tests for Hostingcheck_Result_Info value object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Result_Info_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test setting messages using the constructor.
     */
    public function testMessages() {
        $result = new Hostingcheck_Result_Info();
        $this->assertEquals(array(), $result->messages());
        $this->assertFalse($result->hasMessages());

        $messages = array(
            new Hostingcheck_Message('Foo message'),
            new Hostingcheck_Message('Bar Message'),
        );
        $result = new Hostingcheck_Result_Info($messages);
        $this->assertEquals($messages, $result->messages());

        $this->assertTrue($result->hasMessages());
    }

    /**
     * Test setting messages using the addMessage() method.
     */
    public function testAddMessage()
    {
        $message1 = new Hostingcheck_Message('Foo message');
        $result = new Hostingcheck_Result_Info();
        $result->addMessage($message1);
        $this->assertEquals(array($message1), $result->messages());

        $message2 = new Hostingcheck_Message('Bar message');
        $result->addMessage($message2);
        $this->assertEquals(array($message1, $message2), $result->messages());

        $this->assertTrue($result->hasMessages());
    }
}
