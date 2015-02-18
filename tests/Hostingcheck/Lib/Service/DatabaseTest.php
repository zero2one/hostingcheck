<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_Database_Service
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Service_Database_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check with available connection.
     */
    public function testIsAvailable()
    {
        $config = new Hostingcheck_Config(array(
            'dsn' => 'sqlite::memory:'
        ));
        $service = new Hostingcheck_Service_Database($config);

        $this->assertTrue($service->isAvailable());
        $this->assertFalse($service->hasError());
        $this->assertNull($service->getError());
    }

    /**
     * Check with not available db connection.
     */
    public function testIsNotAvailable()
    {
        $config = new Hostingcheck_Config(array(
            'dsn'      => 'mysql:host=localhost;dbname=foo_bar_biz_baz',
            'username' => 'foo_username',
            'password' => 'foo_password',
            'options'  => array()
        ));
        $service = new Hostingcheck_Service_Database($config);

        // No connection attempt yet > no errors.
        $this->assertFalse($service->hasError());

        // Error will be triggered from the moment we try to connect to a non
        // existing DB with foo credentials.
        $this->assertFalse($service->isAvailable());
        $this->assertTrue($service->hasError());
        $this->assertNotEmpty($service->getError());
    }
}
