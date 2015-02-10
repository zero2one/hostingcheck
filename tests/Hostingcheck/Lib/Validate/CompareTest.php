<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validate_Compare.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Compare_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validate() method.
     *
     * @dataProvider validateProvider
     */
    public function testValidate($value, $arguments, $resultType, $messages)
    {
        $value = new Hostingcheck_Value_Text($value);
        $validator = new Hostingcheck_Validate_Compare($arguments);
        $result = $validator->validate($value);
        $this->assertInstanceOf($resultType, $result);

        $resultMessages = $result->messages();
        foreach ($resultMessages as $key => $resultMessage) {
            $this->assertEquals(
                $messages[$key], $resultMessage->message()
            );
        }
    }

    /**
     * dataProvider for testValidate()
     *
     * @return array
     */
    public function validateProvider()
    {
        return array(
            // Equal text
            array(
                'Foo',
                array('equal' => 'Foo'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                'Bar',
                array('equal' => 'Foo'),
                'Hostingcheck_Result_Failure',
                array('Value is not equal to Foo.'),
            ),

            // Equal numbers.
            array(
                4,
                array('equal' => 4),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '4',
                array('equal' => 4),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                4,
                array('equal' => '4'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                7,
                array('equal' => 5, 'min' => 4, 'max' => 6),
                'Hostingcheck_Result_Failure',
                array('Value is not equal to 5.'),
            ),
            array(
                7,
                array('equal' => 7, 'min' => 4, 'max' => 6),
                'Hostingcheck_Result_Success',
                array(),
            ),

            // Minimum version.
            array(
                5,
                array('min' => 5),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                5,
                array('min' => 4.9),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                4,
                array('min' => 5),
                'Hostingcheck_Result_Failure',
                array('Value should be at least 5.'),
            ),

            // Maximum version.
            array(
                '7',
                array('max' => 8),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '9',
                array('max' => '8'),
                'Hostingcheck_Result_Failure',
                array('Value should be at most 8.'),
            ),

            // Minimum & Maximum combined.
            array(
                '5',
                array('min' => '4', 'max' => '6'),
                'Hostingcheck_Result_Success',
                array(),
            ),
            array(
                '5',
                array('min' => '6', 'max' => '4'),
                'Hostingcheck_Result_Failure',
                array(
                    'Value should be at least 6.',
                    'Value should be at most 4.',
                ),
            ),
            array(
                '4',
                array('min' => '5', 'max' => '6'),
                'Hostingcheck_Result_Failure',
                array('Value should be at least 5.'),
            ),
            array(
                '7',
                array('min' => 5, 'max' => 6),
                'Hostingcheck_Result_Failure',
                array('Value should be at most 6.'),
            ),
        );
    }
}
