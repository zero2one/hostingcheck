<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_Byte.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Byte_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     *
     * @param mixed $value
     *     The value to test.
     * @param int $expected
     *     The expected number of bytes.
     *
     * @dataProvider getValueProvider
     */
    public function testGetValue($value, $expected)
    {
        $byte = new Hostingcheck_Value_Byte($value);
        $this->assertSame($expected, $byte->getValue());
    }

    /**
     * Check exception.
     *
     * @param mixed $value
     *     The value to check for.
     *
     * @dataProvider getExceptionProvider
     * @expectedException Exception
     */
    public function testConstructException($value)
    {
        new Hostingcheck_Value_Byte($value);
    }

    /**
     * Test formatter.
     *
     * @param mixed $value
     *     The value to check for.
     * @param string $format
     *     The format to use.
     * @param int $precision
     *     The precision to use in the formatting.
     * @param string $expected
     *     The expected outcome.
     *
     * @dataProvider getFormatProvider
     */
    public function testFormat($value, $format, $precision, $expected)
    {
        $byte = new Hostingcheck_Value_Byte($value);
        $this->assertInstanceOf(
            'Hostingcheck_Value_Byte',
            $byte->setFormat($format, $precision)
        );
        $this->assertSame(
            $expected,
            (string) $byte
        );
    }

    /**
     * Test the auto format.
     *
     * @param mixed $value
     *     The value to check for.
     * @param string $expected
     *     The expected outcome.
     *
     * @dataProvider getFormatAutoProvider
     */
    public function testFormatAuto($value, $expected)
    {
        $byte = new Hostingcheck_Value_Byte($value);
        $this->assertSame(
            $expected,
            (string) $byte
        );
    }


    /**
     * dataProvider for testGetValue().
     *
     * @return array
     */
    public function getValueProvider()
    {
        return array(
            array( null,              0),
            array(    1,              1),
            array('1010',          1010),
            array(  '2B',             2),
            array(  '2K',          2048),
            array('2.5 M',      2621440),
            array('2.4M',       2516582),
            array('500G',  536870912000),
            array( '9.T', 9895604649984),
        );
    }

    /**
     * dataProvider for testException().
     *
     * @return array
     */
    public function getExceptionProvider()
    {
        return array(
            array(-1),
            array('10.10.2'),
            array('2A'),
            array('K2'),
            array('B'),
            array(''),
            array('500G2'),
            array('9  T'),
        );
    }

    /**
     * dataProvider for testFormat().
     *
     * @return array
     */
    public function getFormatProvider()
    {
        return array(
            // Given formats.
            array(    null, 'M', 2,       '0'),
            array(       1, 'B', 0,      '1B'),
            array( '1010K', 'M', 2,   '0.99M'),
            array(    '2B', 'T', 2,       '0'),
            array(    '2K', 'B', 0,   '2048B'),
            array('2048 M', 'G', 0,      '2G'),
            array(    '4M', 'K', 0,   '4096K'),
        );
    }

    /**
     * dataProvider for testFormatAuto().
     *
     * @return array
     */
    public function getFormatAutoProvider()
    {
        return array(
            // Given formats.
            array(null,                             '0'),
            array(57,                             '57B'),
            array(1024,                            '1K'),
            array(1024*1024,                       '1M'),
            array(1024*1024*1024,                  '1G'),
            array(1024*1024*1024*1024,             '1T'),
            array(2.5 *1024*1024*1024*1024,      '2.5T'),
            array(1024*1024*1024*1024*1024,        '1P'),
            array(10  *1024*1024*1024*1024*1024,  '10P'),
            array('2.4G',                        '2.4G'),
            array('4096M',                         '4G'),
        );
    }
}
