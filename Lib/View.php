<?php
/**
 * Hostingcheck_View
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_View
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_View
{
    /**
     * View variables
     * 
     * @var array
     */
    protected $_vars = array();
  
  
    /**
     * Render html output
     */
    public function render($script)
    {
        $this->_vars['content'] = $this->_render($script);
        echo $this->_render('page');
    }
    
    /**
     * Render the actual script
     */
    protected function _render($script)
    {
        $this->_preprocessPage();
      
        $template = HOSTINGCHECK_BASEPATH 
            . 'Views' 
            . DIRECTORY_SEPARATOR 
            . $script . '.phtml';
        unset($script);
        
        // add the vars
        extract($this->_vars);
        
        ob_start();
          include($template);
          $output = ob_get_contents();
        ob_end_clean();
        
        return $output;
    }
    
    /**
     * Add a var to the view
     * 
     * @param $name
     * @param $value
     * 
     * @return void
     */
    public function __set($name, $value)
    {
        $this->_vars[$name] = $value;
    }
    
    
    /**
     * Preprocess the page variables
     */
    protected function _preprocessPage()
    {
        $auth = new Hostingcheck_Auth();
        $this->_vars['page_title'] = 'Hostingcheck';
        $this->_vars['show_logout'] = FALSE;
        $this->_vars['url_logout'] = Hostingcheck_Controller::getUrl('logout');
        $this->_vars['controls']   = array();
        
        if($auth->isAuthenticated()) {
            $this->_vars['show_logout'] = TRUE;
            $this->_vars['controls'] = array(
                Hostingcheck_Controller::getUrl(Hostingcheck_Controller::ACTION_RUN) => 'Run test',
                Hostingcheck_Controller::getUrl(Hostingcheck_Controller::ACTION_DOWNLOAD_REPORT) => 'Download report',
                Hostingcheck_Controller::getUrl(Hostingcheck_Controller::ACTION_DOWNLOAD_PHPINFO) => 'Download PHP info',
            );
        }
        
        $this->_vars['messages'] = array();
    }
}
