<?php
/**
 * This file is part of Hostingcheck.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2015 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/MIT
 */


// Retrieve the base bath.
define('HOSTINGCHECK_ROOT', dirname(__FILE__));
define(
  'HOSTINGCHECK_BASEPATH',
  HOSTINGCHECK_ROOT . DIRECTORY_SEPARATOR
);

// Init the autoloader.
require_once (HOSTINGCHECK_BASEPATH . 'Hostingcheck/Lib/Autoloader.php');
new Hostingcheck_Autoloader();

// Get the config.
require_once HOSTINGCHECK_BASEPATH . 'Hostingcheck/settings.php';
$config = new Hostingcheck_Config($settings);

// Start the php session.
session_start();

// Get the authentication object.
$configLogin = $config->get('auth', array());
$auth = new Hostingcheck_Auth(
    $configLogin->get('username'),
    $configLogin->get('password'),
    $_SESSION
);

// Create the view.
$view = new Hostingcheck_View(
    HOSTINGCHECK_BASEPATH . 'Hostingcheck/Views',
    'page'
);

// Run the controller.
$controller = new Hostingcheck_Controller($config, $auth, $view);
$controller->run();
