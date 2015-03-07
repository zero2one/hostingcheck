<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validate_Error
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Error_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test without specific message set.
     */
    public function testValidateWithoutCustomMessage()
    {
        $validator = new Hostingcheck_Validate_Error();
        $value = new Hostingcheck_Value_Text();

        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);

        $messages = $result->messages();
        $this->assertEquals('An Error occurred.', array_shift($messages));
    }

    /**
     * Test with specific message set.
     */
    public function testValidateWithCustomMessage()
    {
        $message = 'Custom error message.';
        $validator = new Hostingcheck_Validate_Error(
            array('message' => $message)
        );
        $value = new Hostingcheck_Value_Text();

        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);

        $messages = $result->messages();
        $this->assertEquals($message, array_shift($messages));
    }
}
