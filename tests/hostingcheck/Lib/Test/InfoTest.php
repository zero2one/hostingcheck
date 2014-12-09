<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Test_Result value object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_Info_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testRun()
    {
        $config = new Hostingcheck_Config(array());

        $test = new Hostingcheck_Test_Info($config);
        $result = $test->run();
        $this->assertInstanceOf('Hostingcheck_Result_Info', $result);
        $this->assertNull($result->getValue());

        $value = 'Foo message 123';
        $test = new Hostingcheck_Test_Info($config);
        $result = $test->run(array('value' => $value));
        $this->assertInstanceOf('Hostingcheck_Result_Info', $result);
        $this->assertEquals($value, $result->getValue());
    }
}
