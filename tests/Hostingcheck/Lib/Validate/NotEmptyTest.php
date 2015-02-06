<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Validate_NotEmpty.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_NotEmpty_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the validate() method.
     */
    public function testValidate()
    {
        $validator = new Hostingcheck_Validate_NotEmpty();

        $value = new Hostingcheck_Value_NotSupported();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);

        $value = new Hostingcheck_Value_Text();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);

        $value = new Hostingcheck_Value_Text();
        $result = $validator->validate($value);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
    }
}
