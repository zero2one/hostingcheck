<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A set of services to use within the hostingcheck scenario.
 */
$services = array();


/**
 * Each service has the array key as its unique name.
 * Each service has 2 params:
 * - class : The service class name to use.
 * - config : An optional array of config parameters that the service needs.
 *
 * This is an example for a MySQL service:
 */
$services['db_mysql'] = array(
    'class' => 'Hostingcheck_Service_Database',
    'config' => array(
        'dsn'      => 'mysql:host=localhost;dbname=db_name',
        'username' => 'db_username',
        'password' => 'db_password',
        'options'  => array()
    )
);
