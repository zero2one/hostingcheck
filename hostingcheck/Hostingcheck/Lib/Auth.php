<?php
/**
 * Hostingcheck_Auth
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Auth
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_Auth
{
    /**
     * logged in session name
     * 
     * @var string
     */
    const SESSION_NAMESPACE = 'hostingcheck_login';
    
    /**
     * Log in onfig
     * 
     * @var array
     */
    protected $_config = array(
        'username' => NULL,
        'password' => NULL,
        'nologin'  => TRUE,
    );
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // get the config
        $config = Hostingcheck_Config::getInstance()->get(
            'login',
            array()
        );

        foreach($this->_config AS $key => $value) {
            if(!isset($config[$key])) {
                continue;
            }
            
            $this->_config[$key] = $config[$key];
            $this->_config['nologin'] = FALSE;
        }
        
        if(!isset($_SESSION)) {
            session_start();
        }
    }
    
    /**
     * Check if user is logged in
     * 
     * @param void
     * 
     * @return bool
     */
    public function isAuthenticated()
    {
        if($this->_config['nologin']) {
            return true;
        }
        
        // check from session
        if(isset($_SESSION[self::SESSION_NAMESPACE])
            && isset($_SESSION[self::SESSION_NAMESPACE][$this->_config['username']])
            && $_SESSION[self::SESSION_NAMESPACE][$this->_config['username']] === $this->_config['password']
        ) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Try to authenticate a user
     * 
     * @param string $username
     * @param string $password
     * 
     * @return bool
     *     Success
     */
    public function authenticate($username, $password)
    {
        $userCrypt = md5($username);
        $passCrypt = md5($password);
        if($this->_config['username'] !== $userCrypt
            || $this->_config['password'] !== $passCrypt
        ) {
            return false;
        }
        
        $_SESSION[self::SESSION_NAMESPACE][$userCrypt] = $passCrypt;
        
        return true;
    }
    
    /**
     * Logout the user
     * 
     * @param void
     * 
     * @return void
     */
    public function logout()
    {
        unset($_SESSION[self::SESSION_NAMESPACE]);
    }
}
