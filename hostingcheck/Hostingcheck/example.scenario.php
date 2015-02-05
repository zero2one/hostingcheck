<?php
/**
 * The scenario file contains an array with the test that the hostingcheck
 * should perform.
 */


/******************************************************************************
 *                                                                            *
 * TEST scenario structure.                                                   *
 *                                                                            *
 * Define the structure of the output report.                                 *
 * - The test groups will be listed in the same order as in this scenario.    *
 *                                                                            *
 ******************************************************************************/

/**
 * The hostingcheck is divided in test groups. Define those groups up-front.
 */
$info = array();
$server = array();
$web = array();
$db = array();
$php = array();

/**
 * Set the groups in the desired order.
 */
$scenario = array(
    'info' => array(
        'title' => 'Information',
        'tests' => & $info,
    ),
    'server' => array(
        'title' => 'Server',
        'tests' => & $server,
    ),
    'web' => array(
        'title' => 'Web server (Apache)',
        'tests' => & $web,
    ),
    'db' => array(
        'title' => 'Database server (MySQL)',
        'tests' => & $db,
    ),
    'php' => array(
        'title' => 'Programming language (PHP)',
        'tests' => & $php,
    ),
);



/******************************************************************************
 *                                                                            *
 * TEST scenario tests.                                                       *
 *                                                                            *
 * Define all the tests (one by one).                                         *
 * - Each test will be a line in the report                                   *
 * - The tests will be listed in the same order as in the scenario.           *
 *                                                                            *
 ******************************************************************************/

$info[] = array(
    'title'      => 'Info text',
    'info'       => 'Hostingcheck_Info_Text',
    'info args'  => array('text' => 'Some smalltalk info text'),
);
$info[] = array(
    'title'      => 'Report Date',
    'info'       => 'Hostingcheck_Info_DateTime',
);


$server[] = array(
    'title'      => 'Operating System',
    'info'       => 'Hostingcheck_Info_Server_OS',
);
$server[] = array(
    'title'      => 'Hostname',
    'info'       => 'Hostingcheck_Info_Server_Name',
);

// TODO : CPU info

$server[] = array(
    'title'      => 'Total disk space',
    'info'       => 'Hostingcheck_Info_Server_Disk',
);
$server[] = array(
    'title'      => 'Used disk space',
    'info'       => 'Hostingcheck_Info_Server_Disk',
    'info args'  => array('name' => 'used'),
);
$server[] = array(
    'title'      => 'Free disk space',
    'info'       => 'Hostingcheck_Info_Server_Disk',
    'info args'  => array('name' => 'free'),
    'validators' => array(
        array(
            'validator' => 'Hostingcheck_Validate_ByteSize',
            'args'      => array('min' => '1G', 'max' => '1P'),
        ),
    )

);
$server[] = array(
    'title'      => 'Free disk space of root disk (/)',
    'info'       => 'Hostingcheck_Info_Server_Disk',
    'info args'  => array('name' => 'free', 'path' => '/'),
);


$php[] = array(
    'title'      => 'PHP Version',
    'info'       => 'Hostingcheck_Info_PHP_Version',
    'validators' => array(
        array(
            'validator' => 'Hostingcheck_Validate_Version',
            'args'      => array('min' => '5', 'max' => '6'),
        ),
    ),
    'required'   => true,
);
$php[] = array(
    'title'      => 'Extension : JSON',
    'info'       => 'Hostingcheck_Info_PHP_Extension',
    'info args'  => array('name' => 'json'),
    'validators' => array(
        array(
            'validator'       => 'Hostingcheck_Validate_NotEmpty',
        ),
    ),
    'required'   => true,
);
$php[] = array(
    'title'      => 'Extension : FooBar',
    'info'       => 'Hostingcheck_Info_PHP_Extension',
    'info args'  => array('name' => 'foobar'),
    'validators' => array(
        array(
            'validator'       => 'Hostingcheck_Validate_NotEmpty',
        ),
    ),
    'required'   => true,
);
$php[] = array(
    'title'      => 'Memory limit',
    'info'       => 'Hostingcheck_Info_PHP_Config',
    'info args'  => array(
        'name'   => 'memory_limit',
        'format' => 'Hostingcheck_Value_Byte'
    ),
    'validators' => array(
        array(
            'validator' => 'Hostingcheck_Validate_ByteSize',
            'args'      => array('equal' => '128M'),
        ),
    ),
);

// TODO : memory info.

