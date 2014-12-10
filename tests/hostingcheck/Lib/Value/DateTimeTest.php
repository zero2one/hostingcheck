<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_DateTime.
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
        // Default date = now.
        $value = new Hostingcheck_Value_DateTime();
        $this->assertInstanceOf('DateTime', $value->getValue());

        // Based on passed date.
        $date = new DateTime('2014-05-25 13:31:15');
        $arguments = array(
            'date' => $date->format('Y-m-d H:i:s'),
            'format' => 'Y-m-d H:i:s',
        );
        $value = new Hostingcheck_Value_DateTime($arguments);
        $this->assertEquals(
            $date->format('Y-m-d H:i:s'),
            $value->getValue()->format('Y-m-d H:i:s')
        );
    }

    /**
     * Check to string method.
     */
    public function testToString()
    {
        $now = new DateTime();

        $value = new Hostingcheck_Value_DateTime();
        $this->assertEquals(
            $now->format('Y-m-d H:i (P)'),
            (string) $value
        );

        $value = new Hostingcheck_Value_DateTime(array('format' => 'Ymd Hi'));
        $this->assertEquals(
            $now->format('Ymd Hi'),
            (string) $value
        );
    }
}
