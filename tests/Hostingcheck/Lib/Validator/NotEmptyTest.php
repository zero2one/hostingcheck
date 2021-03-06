<?php
/**
 * Tests for Hostingcheck_Validator_NotEmpty.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_NotEmpty_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validator() method.
     */
    public function testValidate()
    {
        $validator = new Hostingcheck_Validator_NotEmpty();

        $value = new Hostingcheck_Value_NotSupported();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value is not supported.', array_shift($messages));

        $value = new Hostingcheck_Value_NotFound();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value is not found.', array_shift($messages));

        $value = new Hostingcheck_Value_Text();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value is empty.', array_shift($messages));

        $value = new Hostingcheck_Value_Text();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value is empty.', array_shift($messages));
    }
}
