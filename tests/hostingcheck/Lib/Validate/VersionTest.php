<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validate_Version.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validate() method.
     *
     * @dataProvider validateProvider
     */
    public function testValidate($version, $arguments, $resultType, $messages)
    {
        $value = new Hostingcheck_Value_Version($version);
        $validator = new Hostingcheck_Validate_Version($arguments);
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
                '5.2.3',
                array('equal' => '5.4.3', 'min' => '6', 'max' => '5'),
                'Hostingcheck_Result_Failure',
                array('Version is not equal to 5.4.3.'),
            ),
            array(
                '5.2.3',
                array('equal' => '5.2.3', 'min' => '6', 'max' => '5'),
                'Hostingcheck_Result_Success',
                array(),
            ),

            // Minimum version.
            array(
                '5.2.3',
                array('min' => '5.2'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '5.2.3',
                array('min' => '5.3'),
                'Hostingcheck_Result_Failure',
                array('Version is to low, should be at least 5.3.'),
            ),

            // Maximum version.
            array(
                '5.2.3',
                array('max' => '5.2.99'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '5.2.3',
                array('max' => '5.2.1'),
                'Hostingcheck_Result_Failure',
                array('Version is to high, should be at most 5.2.1.'),
            ),

            // Minimum & Maximum combined.
            array(
                '5.2.3',
                array('min' => '5.2', 'max' => '5.3'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '5.2.3',
                array('min' => '6', 'max' => '4'),
                'Hostingcheck_Result_Failure',
                array(
                    'Version is to low, should be at least 6.',
                    'Version is to high, should be at most 4.',
                ),
            ),
            array(
                '5.2.3',
                array('min' => '5.2.4', 'max' => '5.3'),
                'Hostingcheck_Result_Failure',
                array('Version is to low, should be at least 5.2.4.'),
            ),
            array(
                '5.2.3',
                array('min' => '4', 'max' => '5.2.1'),
                'Hostingcheck_Result_Failure',
                array('Version is to high, should be at most 5.2.1.'),
            ),
        );
    }
}
