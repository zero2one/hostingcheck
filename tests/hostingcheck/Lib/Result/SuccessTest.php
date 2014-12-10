<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Result_Success value object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Result_Success_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Get the messages method.
     */
    public function testGetMessages()
    {
        $result = new Hostingcheck_Result_Success();
        $this->assertEquals(array(), $result->getMessages());

        $messages = array('Foo message.', 'Bar message.');
        $result = new Hostingcheck_Result_Success($messages);
        $this->assertEquals($messages, $result->getMessages());
    }
}
