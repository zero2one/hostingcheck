<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Hosting check main configuration
 */
$settings = array();


/**
 * Title of the hostingcheck.
 *
 * Will be used as the HTML head title and as page title.
 */
$settings['title'] = 'Hostingcheck';

/**
 * Authentication.
 * 
 * Protect your application with a username and password
 * The values here should be hashed using the md5() function.
 *
 * The example is demo/demo.
 */
$settings['auth'] = array(
    'username' => 'fe01ce2a7fbac8fafaed7c982a04e229',
    'password' => 'fe01ce2a7fbac8fafaed7c982a04e229',
);
