<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validator_False.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_False_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validator() method.
     */
    public function testValidateFailure()
    {
        $validator = new Hostingcheck_Validator_False();

        $value = new Hostingcheck_Value_Boolean(true);
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = $result->messages();
        $this->assertEquals('Value should be false.', array_shift($messages));
    }

    /**
     * Test the validator() method.
     */
    public function testValidateSuccess()
    {
        $validator = new Hostingcheck_Validator_False();

        $value = new Hostingcheck_Value_Boolean(false);
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result);
        $messages = $result->messages();
        $this->assertEmpty($messages);
    }
}