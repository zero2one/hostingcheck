<?php
/**
 * Tests for Hostingcheck_Auth().
 */

/**
 *
 */
class Hostingcheck_Auth_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the authentication.
     */
    public function testAuthenticate()
    {
        $username = 'test-user';
        $password = 'test-password';
        $auth = new Hostingcheck_Auth($username, $password);

        $this->assertFalse($auth->authenticate('fake-user', 'fake-pass'));
    }
}