<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_Apache_Info_Version.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Apache_Info_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method without support for Apache.
     *
     * The apache_get_version() function does only exists if the request is
     * received trough Apache.
     */
    public function testNotSupported()
    {
        $version = new Check_Apache_Info_Version();
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $version->getValue()
        );
    }

    /**
     * Check get value method if the function exists.
     *
     * We "mock" the function first.
     */
    public function testSupported()
    {
        $this->createApacheGetVersionFunction();

        $version = new Check_Apache_Info_Version();
        $this->assertInstanceOf(
            'Hostingcheck_Value_Version',
            $version->getValue()
        );
        $this->assertEquals('2.2.23', $version->getValue());
    }

    /**
     * Helper to create the missing apache_get_modules() function.
     */
    protected function createApacheGetVersionFunction()
    {
        if (function_exists('apache_get_version')) {
            return;
        }

        function apache_get_version() {
            return 'Apache/2.2.23 (Unix) PHP/5.5.13 mod_ssl/2.2.23 OpenSSL/0.9.8za';
        }
    }
}
