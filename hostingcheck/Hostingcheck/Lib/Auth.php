<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Class Hostingcheck_Auth
 *
 * Basic authentication based on a single username & password.
 * Login will save the credentials in the session.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Auth
{
    /**
     * Session array key where the logged in information is kept.
     * 
     * @var string
     */
    const SESSION_NAMESPACE = 'hostingcheck_auth';

    /**
     * Session data.
     *
     * @var array
     */
    protected $session;

    /**
     * MD5 hash of the username that should be used to access hostingcheck.
     *
     * @var string
     */
    protected $username;

    /**
     * MD5 hash of the password that should be used to access hostingcheck.
     *
     * @var string
     */
    protected $password;
    

    /**
     * Constructor.
     *
     * @param string $username
     *      The MD5 hash of the username that will be used to validate the
     *      authentication.
     * @param string $password
     *      The MD5 hash of the password that will be used to validate the
     *      authentication.
     * @param array $session
     *      The session data (pass $_SESSION).
     */
    public function __construct($username, $password, &$session)
    {
        $this->username = $username;
        $this->password = $password;

        // Make sure there is an authentication array in the session.
        if (empty($session[self::SESSION_NAMESPACE])) {
            $session[self::SESSION_NAMESPACE] = array(
                'username' => null,
                'password' => null,
            );
        }
        if (!isset($session[self::SESSION_NAMESPACE]['username'])) {
            $session[self::SESSION_NAMESPACE]['username'] = null;
        }
        if (!isset($session[self::SESSION_NAMESPACE]['password'])) {
            $session[self::SESSION_NAMESPACE]['password'] = null;
        }
        $this->session =& $session[self::SESSION_NAMESPACE];
    }
    
    /**
     * Check if there is an authenticated user in the session.
     * 
     * @return bool
     *      Authenticated.
     */
    public function isAuthenticated()
    {
        $username = $this->session['username'];
        $password = $this->session['password'];

        // Validate stored data.
        if (empty($username) || $username !== $this->username) {
            return false;
        }
        if (empty($password) || $password !== $this->password) {
            return false;
        }

        // All ok.
        return true;
    }
    
    /**
     * Login a user by its username & password.
     * 
     * @param string $username
     *      The raw username string.
     * @param string $password
     *      The raw password string.
     * 
     * @return bool
     *     Success.
     */
    public function login($username, $password)
    {
        $usernameHash = md5($username);
        $passwordHash = md5($password);

        if ($usernameHash !== $this->username) {
            return false;
        }
        if ($passwordHash !== $this->password) {
            return false;
        }

        $this->session['username'] = $usernameHash;
        $this->session['password'] = $passwordHash;
        return true;
    }
    
    /**
     * Logout the current authenticated user.
     */
    public function logout()
    {
        $this->session = array(
            'username' => null,
            'password' => null,
        );
    }
}
