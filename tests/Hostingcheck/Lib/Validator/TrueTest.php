<?php
/**
 * Tests for Hostingcheck_Validator_True.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_True_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validator() method.
     */
    public function testValidateFailure()
    {
        $validator = new Hostingcheck_Validator_True();

        $value = new Hostingcheck_Value_Boolean(false);
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value should be true.', array_shift($messages));
    }

    /**
     * Test the validator() method.
     */
    public function testValidateSuccess()
    {
        $validator = new Hostingcheck_Validator_True();

        $value = new Hostingcheck_Value_Boolean(true);
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result);
        $messages = $result->messages();
        $this->assertEmpty($messages);
    }
}
