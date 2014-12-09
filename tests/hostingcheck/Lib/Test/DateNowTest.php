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
class Hostingcheck_Test_DateNow_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testRun()
    {
        $now = new DateTime();

        $config = new Hostingcheck_Config(array());
        $test = new Hostingcheck_Test_DateNow($config);

        $result = $test->run();
        $this->assertEquals(
            $now->format('Y-m-d H:i (P)'),
            $result->getValue()
        );
    }
}
