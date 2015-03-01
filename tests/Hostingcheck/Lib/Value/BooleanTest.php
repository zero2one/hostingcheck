<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_Boolean
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Boolean_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test getValue method without value in the constructor.
     */
    public function testGetValueWithoutValueInConstructor()
    {
        $boolean = new Hostingcheck_Value_Boolean();
        $this->assertEquals(false, $boolean->getValue());
    }

    /**
     * Check getValue method.
     *
     * @param mixed $value
     *     The value to test.
     * @param bool $expected
     *     The expected boolean value
     *
     * @dataProvider getValueProvider
     */
    public function testGetValue($value, $expected)
    {
        $boolean = new Hostingcheck_Value_Boolean($value);
        $this->assertEquals($expected, $boolean->getValue());
    }

    /**
     * Check get string.
     */
    public function _testToString()
    {
        $value = new Hostingcheck_Value_Text();
        $this->assertEquals('', (string) $value);

        $text = 'foobar';
        $value = new Hostingcheck_Value_Text($text);
        $this->assertEquals($text, (string) $value);
    }


    /**
     * dataProvider for testGetValue().
     *
     * @return array
     */
    public function getValueProvider()
    {
        return array(
            // NULL.
            array(null, false),
            array('null', false),

            // True/False.
            array(false, false),
            array('false', false),
            array(true, true),
            array('true', true),

            // Integer.
            array(0, false),
            array('0', false),
            array(1, true),
            array('1', true),

            // Float
            array(0.0, false),
            array('0.0', false),
            array(0.1, true),
            array('0.1', true),

            // On/Off.
            array('on', true),
            array('off', false),

            // Yes/No.
            array('yes', true),
            array('no', false),
            
            // Special.
            array(array(), false),
            array(array(1), true),
            array(new stdClass(), true),
        );
    }
}
