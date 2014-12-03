<?php
/**
 * Bootstrap for HostingCheck Unit Tests
 * 
 * @filesource
 */

define(
  'HOSTINGCHECK_BASEPATH', 
  dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
);
 
// Start the autoloader
require_once (HOSTINGCHECK_BASEPATH . 'Lib/Autoloader.php');
new Hostingcheck_Autoloader();
