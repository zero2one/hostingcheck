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
    public function __construct(
        Hostingcheck_Config $config,
        Hostingcheck_Auth $auth,
        Hostingcheck_View$view
    )
    {
        $this->config = $config;
        $this->auth = $auth;
        $this->view = $view;
    }
  
    /**
     * Run the controller
     */
    public function run()
    {
        // Check if logged in.
        if(!$this->auth->isAuthenticated()) {
            echo $this->actionLogin();
            return;
        }

        // Dispatch the request.
        $this->dispatch($this->getRequest());
    }

    /**
     * Helper to dispatch the request.
     *
     * @param string $request
     *     The request name.
     */
    protected function dispatch($request)
    {
        switch($request) {
            case self::ACTION_LOGOUT:
                $this->actionLogout();
                return;

            case self::ACTION_DOWNLOAD_REPORT:
                $this->actionDownloadReport();
                return;

            case self::ACTION_DOWNLOAD_PHPINFO:
                $this->actionDownloadPhpInfo();
                return;

            default:
                echo $this->actionReport();
                return;
        }
    }
    
    /**
     * Login action
     */
    public function actionLogin()
    {
        if(!empty($_POST)) {
            $login = $this->auth->login(
                $_POST['username'], 
                $_POST['password']
            );
            if($login) {
                $this->redirect();
                return;
            }
        }

        $vars = $this->defaultVars();
        $vars['urlLogin'] = self::getUrl();
        return $this->view->renderTemplate('login', $vars);
    }
    
    /**
     * Logout
     */
    public function actionLogout()
    {
        $this->auth->logout();
        $this->redirect();
    }
    
    /**
     * Download the report
     */
    public function actionDownloadReport()
    {
        $filename =
            $_SERVER['SERVER_NAME']
            . '_'
            . 'report'
            . '_'
            . date('Ymd-His')
            . '.html';

        $report = $this->actionReport();
        $this->download($filename, $report);
    }
    
    /**
     * Download the PHP info report
     */
    public function actionDownloadPhpInfo()
    {
        $filename =
            $_SERVER['SERVER_NAME']
            . '_'
            . 'phpinfo'
            . '_'
            . date('Ymd-His')
            . '.html';

        ob_start();
            phpinfo();
            $phpinfo = ob_get_contents();
        ob_end_clean();

        $this->download($filename, $phpinfo);
    }
    
    /**
     * Print out the report on screen
     */
    public function actionReport()
    {
        $scenario = $this->loadScenario();
        $runner = new Hostingcheck_Runner($scenario);
        $results = $runner->run();

        $vars = $this->defaultVars();
        $vars['results'] = $results;
        return $this->view->renderTemplate('results', $vars);
    }

    /**
     * Helper to force download of a report.
     *
     * @param string $filename
     *     The filename to use.
     * @param string $content
     *     The content of the download.
     */
    protected function download($filename, $content) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        echo $content;
    }

    /**
     * Get the request
     * 
     * @param void
     * 
     * @return string|null
     */
    protected function getRequest()
    {
        $do = null;
        if (isset($_GET['do'])) {
            $do = strip_tags($_GET['do']);
        }
        return $do;
    }
    
    /**
     * Get the url to the controller
     * 
     * @param string $action
     *     Optional action name.
     * @param array $arguments
     *     Optional get arguments.
     *
     * @return  string
     */
    protected function getUrl($action = null, $arguments = array()) {
        $urlHelper = new Hostingcheck_View_Url();
        return $urlHelper->url(array(
            $action,
            $arguments
        ));
    }
    
    /**
     * Redirector
     * 
     * @param string $action
     *     The action to redirect to
     * 
     * @return void
     */
    protected function redirect($action = NULL)
    {
        header('Location: ' . Hostingcheck_Controller::getUrl($action));
    }

    /**
     * Define the default variables.
     *
     * @return array
     */
    protected function defaultVars()
    {
        // Set up the base variables in the view.
        $vars = array(
            'page_title' => $this->config->get('title', 'Hostingcheck'),
            'show_logout' => false,
            'show_actions' => false
        );

        // Do not show the actions when downloading report.
        if (!preg_match('/^download_/', $this->getRequest())
            && $this->auth->isAuthenticated()
        ) {
            $vars['show_logout'] = true;
            $vars['show_actions'] = true;
        }

        return $vars;
    }

    /**
     * Helper to load the services.
     *
     * @return Hostingcheck_Services
     */
    protected function loadServices()
    {
        $services = array();

        $file = HOSTINGCHECK_BASEPATH . 'Hostingcheck/services.php';
        if (file_exists($file)) {
            require_once $file;
        }

        // Parse the services.
        $parser = new Hostingcheck_Services_Parser();
        $collection = $parser->parse($services);
        return $collection;
    }

    /**
     * Load the scenario.
     *
     * @return Hostingcheck_Scenario
     */
    protected function loadScenario()
    {
        $scenario = array();

        $file = HOSTINGCHECK_BASEPATH . 'Hostingcheck/scenario.php';
        if (file_exists($file)) {
            require_once HOSTINGCHECK_BASEPATH . 'Hostingcheck/scenario.php';
        }

        $parser = new Hostingcheck_Scenario_Parser($this->loadServices());
        $collection = $parser->parse($scenario);
        return $collection;
    }
}
