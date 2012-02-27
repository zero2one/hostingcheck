<?php
/**
 * Hostingcheck_Autoloader
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Autoloader
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

// check the minimal PHP version

define('HOSTINGCHECK_BASEPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
 
// Start the autoloader
require_once (HOSTINGCHECK_BASEPATH . 'Lib/Autoloader.php');
new Hostingcheck_Autoloader();

// Run the controller
$controller = new Hostingcheck_Controller();
$controller->run();
