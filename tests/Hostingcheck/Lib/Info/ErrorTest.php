<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_Error.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Error_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the class without arguments.
     */
    public function testWithoutErrorMessage()
    {
        $info = new Hostingcheck_Info_Error();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Error',
            $info->getValue()
        );
        $this->assertNull($info->getValue()->getValue());
    }

    /**
     * Test the class with arguments.
     */
    public function testWithErrorMessage()
    {
        $arguments = array('error' => 'Foo value');
        $info = new Hostingcheck_Info_Error($arguments);
        $this->assertEquals($arguments['error'], $info->getValue()->getValue());
    }
}
