<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_PHP_VersionTest.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_PHP_Info_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $phpversion = phpversion();

        $info = new Check_PHP_Info_Version();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Version',
            $info->getValue()
        );

        $this->assertEquals($phpversion, $info->getValue()->getValue());
    }
}
