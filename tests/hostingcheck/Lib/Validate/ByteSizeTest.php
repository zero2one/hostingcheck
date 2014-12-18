<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validate_Byte size.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_ByteSize_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validate() method.
     *
     * @dataProvider validateProvider
     */
    public function testValidate($byte, $arguments, $resultType, $messages)
    {
        $value = new Hostingcheck_Value_Byte($byte);
        $validator = new Hostingcheck_Validate_ByteSize($arguments);
        $result = $validator->validate($value);
        $this->assertInstanceOf($resultType, $result);
        $this->assertEquals($messages, $result->getMessages());
    }

    /**
     * dataProvider for testValidate()
     *
     * @return array
     */
    public function validateProvider()
    {
        return array(
            // Equal.
            array(
                '4M',
                array('equal' => '3M', 'min' => '6M', 'max' => '2M'),
                'Hostingcheck_Result_Failure',
                array('Byte size is not equal to 3M.'),
            ),
            array(
                '4.2M',
                array('equal' => '4.2M', 'min' => '6M', 'max' => '2M'),
                'Hostingcheck_Result_Success',
                array(),
            ),

            // Minimum size.
            array(
                '5.2M',
                array('min' => '5.2M'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '5.21M',
                array('min' => '5.2M'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '6T',
                array('min' => '6.1T'),
                'Hostingcheck_Result_Failure',
                array('Byte size is to low, should be at least 6.1T.'),
            ),

            // Maximum version.
            array(
                '3000B',
                array('max' => 3000),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '3P',
                array('max' => '3.001P'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                1025,
                array('max' => '1K'),
                'Hostingcheck_Result_Failure',
                array('Byte size is to high, should be at most 1K.'),
            ),

            // Minimum & Maximum combined.
            array(
                '500M',
                array('min' => '500M', 'max' => '500M'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '399K',
                array('min' => '500B', 'max' => '500M'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '50M',
                array('min' => '6T', 'max' => '4M'),
                'Hostingcheck_Result_Failure',
                array(
                    'Byte size is to low, should be at least 6T.',
                    'Byte size is to high, should be at most 4M.',
                ),
            ),
            array(
                '4M',
                array('min' => '5M', 'max' => '8M'),
                'Hostingcheck_Result_Failure',
                array('Byte size is to low, should be at least 5M.'),
            ),
            array(
                '8.1M',
                array('min' => '4M', 'max' => '8M'),
                'Hostingcheck_Result_Failure',
                array('Byte size is to high, should be at most 8M.'),
            ),
        );
    }
}
