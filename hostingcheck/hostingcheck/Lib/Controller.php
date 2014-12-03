<?php
/**
 * Hostingcheck_Controller
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Controller
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_Controller
{
    /**
     * View class
     * 
     * @var Hostingcheck_View
     */
    protected $_view;
  
    /**
     * The possible actions
     * 
     * @var string
     */
    const ACTION_LOGOUT           = 'logout';
    const ACTION_RUN              = 'run';
    const ACTION_DOWNLOAD_REPORT  = 'download_report';
    const ACTION_DOWNLOAD_PHPINFO = 'download_phpinfo';
  
  
    /**
     * Constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->_view = new Hostingcheck_View();
    }
  
    /**
     * Run the controller
     */
    public function run()
    {
        // check if logged in
        $auth = new Hostingcheck_Auth();
        if(!$auth->isAuthenticated()) {
            $this->actionLogin();
            return;
        }
        
        switch($this->getRequest()) {
            case self::ACTION_LOGOUT:
                $this->actionLogout();
                break;
                
            case self::ACTION_DOWNLOAD_REPORT:
                $this->actionDownloadReport();
                break;
              
            case self::ACTION_DOWNLOAD_PHPINFO:
                $this->actionDownloadPhpInfo();
                break;
              
            default:
                $this->actionReport();
                break;
        }
    }
    
    /**
     * Login action
     */
    public function actionLogin()
    {
        $auth = new Hostingcheck_Auth();
        $this->_view->urlLogin = self::getUrl();
        
        if(!empty($_POST)) {
            $login = $auth->authenticate(
                $_POST['username'], 
                $_POST['password']
            );
            if($login) {
                $this->_redirect();
            }
            
            // add messages
        }
        
        
        $this->_view->render('login');
    }
    
    /**
     * Logout
     */
    public function actionLogout()
    {
        $auth = new Hostingcheck_Auth();
        $auth->logout();
        $this->_redirect();
    }
    
    /**
     * Download the report
     */
    public function actionDownloadReport()
    {
        
    }
    
    /**
     * Download the PHP info report
     */
    public function actionDownloadPhpInfo()
    {
        
    }
    
    /**
     * Print out the report on screen
     */
    public function actionReport()
    {
        $this->_view->render('results');
    }
    
    
    /**
     * Get the request
     * 
     * @param void
     * 
     * @return array
     */
    public function getRequest()
    {
        $do = null;
        if(isset($_GET['do'])) {
            $do = strip_tags($_GET['do']);
        }
        return $do;
    }
    
    /**
     * Get the url to the controller
     * 
     * @param   void
     * @return  string
     */
    static function getUrl($action = null) {
      $url = htmlentities(strip_tags($_SERVER['PHP_SELF']));
      if($action) {
          $url .= '?do=' . $action;
      }
      
      return $url;
    }
    
    /**
     * Redirector
     * 
     * @param string $action
     *     The action to redirect to
     * 
     * @return void
     */
    protected function _redirect($action = NULL)
    {
        header('Location: ' . Hostingcheck_Controller::getUrl($action));
        exit;
    }
}
