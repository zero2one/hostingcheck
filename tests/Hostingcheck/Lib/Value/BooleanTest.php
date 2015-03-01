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
     *     The expected boolean value.
     *
     * @dataProvider getValueProvider
     */
    public function testGetValue($value, $expected)
    {
        $boolean = new Hostingcheck_Value_Boolean($value);
        $this->assertEquals($expected, $boolean->getValue());
    }

    /**
     * Test exception when setting non supported format.
     *
     * @expectedException Exception
     */
    public function testFormatException()
    {
        $boolean = new Hostingcheck_Value_Boolean(false);
        $boolean->setFormat('fooBar');
    }

    /**
     * Test to string when no format is set.
     */
    public function testToStringWithoutFormatSet()
    {
        $boolean = new Hostingcheck_Value_Boolean(false);
        $this->assertEquals('false', (string) $boolean);

        $boolean = new Hostingcheck_Value_Boolean(true);
        $this->assertEquals('true', (string) $boolean);
    }

    /**
     * Check get string.
     *
     * @param mixed $value
     *     The value to test.
     * @param string $format
     *     The expected format.
     * @param string $expected
     *     The expected output value.
     *
     * @dataProvider getToStringProvider
     */
    public function testToString($value, $format, $expected)
    {
        $boolean = new Hostingcheck_Value_Boolean($value);
        $boolean->setFormat($format);
        $this->assertEquals($expected, (string) $boolean);
    }


    /**
     * dataProvider for testGetValue().
     *
     * @return array
     */
    public function getValueProvider()
    {
        return array(
            // Empty
            array('', false),
            array(' ', false),

            // NULL.
            array( null,  false),
            array('null', false),

            // True/False.
            array( false,  false),
            array('false', false),
            array( true,   true),
            array('true',  true),

            // Integer.
            array( 0,  false),
            array('0', false),
            array( 1,  true),
            array('1', true),

            // Float
            array( 0.0,  false),
            array('0.0', false),
            array( 0.1,  true),
            array('0.1', true),

            // On/Off.
            array( 'on', true),
            array('off', false),

            // Yes/No.
            array('yes', true),
            array( 'no', false),

            // Special.
            array( array(), false),
            array(array(1), true),
            array(new stdClass(), true),

            // Non supported strings.
            array('whatever', true),
        );
    }

    /**
     * dataProvider for testToString().
     *
     * @return array
     */
    public function getToStringProvider()
    {
        $boolean = Hostingcheck_Value_Boolean::BOOLEAN;
        $integer = Hostingcheck_Value_Boolean::INTEGER;
        $on_off  = Hostingcheck_Value_Boolean::ON_OFF;
        $yes_no  = Hostingcheck_Value_Boolean::YES_NO;

        return array(
            // Boolean.
            array(false, $boolean, 'false'),
            array(true,  $boolean, 'true'),

            // Integer.
            array(false, $integer, '0'),
            array(true,  $integer, '1'),

            // On/Off.
            array(false, $on_off, 'off'),
            array(true,  $on_off, 'on'),

            // Yes/No.
            array(false, $yes_no, 'no'),
            array(true,  $yes_no, 'yes'),
        );
    }
}
