<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Class Hostingcheck_Controller
 *
 * Main controller to decide, based on the GET request, what action to perform.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Controller
{
    /**
     * Configuration object.
     *
     * @var Hostingcheck_Config
     */
    protected $config;

    /**
     * Authentication object.
     *
     * @var Hostingcheck_Auth
     */
    protected $auth;

    /**
     * View object.
     * 
     * @var Hostingcheck_View
     */
    protected $view;

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
     * Constructor.
     *
     * @param Hostingcheck_Config $config
     *      The hostingcheck config.
     * @param Hostingcheck_Auth $auth
     *      The authentication object.
     * @param Hostingcheck_View $view
     *      The vew object to use in the controller.
     */
    public function __construct($config, $auth, $view)
    {
        $this->config = $config;
        $this->auth = $auth;

        // Set up the base variables in the view.
        $view->page_title  = 'Hostingcheck';
        $view->show_logout = false;
        $view->url_logout  = $this->getUrl('logout');
        $view->controls    = array();
        $view->messages    = array();
        $this->view = $view;

        // Add the navigation when the user is authenticated.
        if($this->auth->isAuthenticated()) {
            $this->view->show_logout = true;
            $this->view->controls = array(
                $this->getUrl(Hostingcheck_Controller::ACTION_RUN) => 'Run test',
                $this->getUrl(Hostingcheck_Controller::ACTION_DOWNLOAD_REPORT) => 'Download report',
                $this->getUrl(Hostingcheck_Controller::ACTION_DOWNLOAD_PHPINFO) => 'Download PHP info',
            );
        }
    }
  
    /**
     * Run the controller
     */
    public function run()
    {
        // check if logged in
        if(!$this->auth->isAuthenticated()) {
            echo $this->actionLogin();
            return;
        }
        
        switch($this->getRequest()) {
            case self::ACTION_LOGOUT:
                $output = $this->actionLogout();
                break;
                
            case self::ACTION_DOWNLOAD_REPORT:
                $this->actionDownloadReport();
                break;
              
            case self::ACTION_DOWNLOAD_PHPINFO:
                $this->actionDownloadPhpInfo();
                break;
              
            default:
                $output = $this->actionReport();
                break;
        }

        echo $output;
    }
    
    /**
     * Login action
     */
    public function actionLogin()
    {
        $this->view->urlLogin = self::getUrl();
        
        if(!empty($_POST)) {
            $login = $this->auth->login(
                $_POST['username'], 
                $_POST['password']
            );
            if($login) {
                $this->_redirect();
            }
            
            // add messages
        }

        return $this->view->renderTemplate('login');
    }
    
    /**
     * Logout
     */
    public function actionLogout()
    {
        $this->auth->logout();
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
        return $this->view->renderTemplate('results');
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
