<?php
/**
 * Tests for Hostingcheck_Validator_Error
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_Error_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test without specific message set.
     */
    public function testValidateWithoutCustomMessage()
    {
        $validator = new Hostingcheck_Validator_Error();
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
        $validator = new Hostingcheck_Validator_Error(
            array('message' => $message)
        );
        $value = new Hostingcheck_Value_Text();

        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);

        $messages = $result->messages();
        $this->assertEquals($message, array_shift($messages));
    }
}
