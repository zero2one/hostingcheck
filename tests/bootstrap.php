<?php
/**
 * Bootstrap for HostingCheck Unit Tests
 * 
 * @filesource
 */

define(
  'HOSTINGCHECK_BASEPATH', 
  dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'hostingcheck' . DIRECTORY_SEPARATOR
);
 
// Start the autoloader
require_once (HOSTINGCHECK_BASEPATH . 'hostingcheck/Lib/Autoloader.php');
new Hostingcheck_Autoloader();
