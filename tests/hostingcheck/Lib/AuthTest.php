<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Auth class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Auth_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the method to validate if there is a valid session.
     */
    public function testIsAuthenticated()
    {
        $session = array();
        $username = 'test-user';
        $password = 'test-password';
        $usernameHash = md5($username);
        $passwordHash = md5($password);

        // Check authentication with empty session.
        $auth = new Hostingcheck_Auth($usernameHash, $passwordHash, $session);
        $this->assertFalse($auth->isAuthenticated());

        // Check authentication with fake session credentials.
        $session[$auth::SESSION_NAMESPACE] = array(
            'username' => 'fake-user',
            'password' => 'fake-pass',
        );
        $this->assertFalse($auth->isAuthenticated());

        // Check authentication with valid session credentials.
        $session[$auth::SESSION_NAMESPACE] = array(
            'username' => $usernameHash,
            'password' => $passwordHash,
        );
        $auth = new Hostingcheck_Auth($usernameHash, $passwordHash, $session);
        $this->assertTrue($auth->isAuthenticated());

        // Check authentication with empty password.
        $session[$auth::SESSION_NAMESPACE] = array(
            'username' => 'fake-user',
            'password' => null,
        );
        $this->assertFalse($auth->isAuthenticated());

        // Check authentication with false password.
        $session[$auth::SESSION_NAMESPACE] = array(
            'username' => $usernameHash,
            'password' => 'fake-pass',
        );
        $this->assertFalse($auth->isAuthenticated());
    }

    /**
     * Test the method to login a user and store te credentials in the session.
     */
    public function testLogin()
    {
        $session = array();
        $username = 'test-user';
        $password = 'test-password';
        $usernameHash = md5($username);
        $passwordHash = md5($password);

        $auth = new Hostingcheck_Auth($usernameHash, $passwordHash, $session);

        // Login with fake user, fakse pass.
        $this->assertFalse($auth->login('fake-user', 'fake-pass'));

        // Login with real user, fake pass.
        $this->assertFalse($auth->login('test-user', 'fake-pass'));

        // Login with valid user.
        $this->assertTrue($auth->login($username, $password));

        // Check if user credentials are stored in the session.
        $this->assertEquals(
            $session[$auth::SESSION_NAMESPACE]['username'],
            $usernameHash
        );
        $this->assertEquals(
            $session[$auth::SESSION_NAMESPACE]['password'],
            $passwordHash
        );
    }

    /**
     * Test the method to logout an authenticated user.
     */
    public function testLogout()
    {
        $usernameHash = md5('test-username');
        $passwordHash = md5('test-password');
        $session = array(
            Hostingcheck_Auth::SESSION_NAMESPACE => array(
                'username' => $usernameHash,
                'password' => $passwordHash,
            )
        );

        $auth = new Hostingcheck_Auth($usernameHash, $passwordHash, $session);
        $this->assertTrue($auth->isAuthenticated());

        $auth->logout();
        $this->assertFalse($auth->isAuthenticated());
        $this->assertNull($session[$auth::SESSION_NAMESPACE]['username']);
        $this->assertNull($session[$auth::SESSION_NAMESPACE]['password']);
    }
}
