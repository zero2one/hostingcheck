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
    'title' => 'Info text',
    'info' => 'Text',
    'args' => array('text' => 'Some smalltalk info text'),
);
$info[] = array(
    'title' => 'Report Date',
    'info' => 'DateTime',
);



/**
 * Example how to collect and validate information about the server hardware.
 */
$server[] = array(
    'title' => 'Operating System',
    'info' => 'Server_OS',
);
$server[] = array(
    'title' => 'Hostname',
    'info' => 'Server_Name',
);
$server[] = array(
    'title' => 'Total disk space',
    'info' => 'Server_Disk',
);
$server[] = array(
    'title' => 'Used disk space',
    'info' => 'Server_Disk',
    'args' => array('name' => 'used'),
);
$server[] = array(
    'title' => 'Free disk space',
    'info' => 'Server_Disk',
    'args' => array('name' => 'free'),
    'validators' => array(
        array(
            'validator' => 'ByteSize',
            'args' => array('min' => '1G', 'max' => '1P'),
        ),
    )

);
$server[] = array(
    'title' => 'Free disk space of root disk (/)',
    'info' => 'Server_Disk',
    'args' => array('name' => 'free', 'path' => '/'),
);



/**
 * Example how to collect and validate Apache configuration.
 */
$web[] = array(
    'title' => 'Apache version',
    'info' => 'Apache_Version',
);



/**
 * Example how to collect and validate PHP configuration.
 */
$php[] = array(
    'title' => 'PHP Version',
    'info' => 'PHP_Version',
    'validators' => array(
        array(
            'validator' => 'Version',
            'args'=> array('min' => '5', 'max' => '6'),
        ),
    ),
    'required' => true,
);
$php[] = array(
    'title' => 'Extension : Date',
    'info' => 'PHP_Extension',
    'args' => array('name' => 'date'),
    'required'   => true,
    'tests' => array(
        array(
            'title' => 'Timezone',
            'info' => 'PHP_Config',
            'args' => array(
                'name' => 'date.timezone',
            ),
            'validators' => array(
                array(
                    'validator' => 'Compare',
                    'args' => array('equal', 'Antarctica/Troll'),
                ),
            ),
        ),
    )
);
$php[] = array(
    'title' => 'Extension : JSON',
    'info' => 'PHP_Extension',
    'args'  => array('name' => 'json'),
    'required'   => true,
);
$php[] = array(
    'title' => 'Extension : FooBar',
    'info' => 'PHP_Extension',
    'args' => array('name' => 'foobar'),
    'required' => true,
    'tests' => array(
        array(
            'title' => 'FooBar fake value test',
            'info' => 'PHP_Config',
            'args' => array(
                'name' => 'foobar.bizbaz',
            ),
        )
    )
);
$php[] = array(
    'title' => 'Memory limit',
    'info' => 'PHP_Config',
    'args' => array(
        'name' => 'memory_limit',
        'format' => 'Byte'
    ),
    'validators' => array(
        array(
            'validator' => 'ByteSize',
            'args' => array('equal' => '128M'),
        ),
    ),
);



/**
 * Example how to collect and validate information about the Database(s).
 */
$db[] = array(
    'title' => 'MySQL service available',
    'info' => 'Service_Available',
    'service' => 'db_mysql',
    'required' => true,
    'tests' => array(
        array(
            'title' => 'Version',
            'info'  => 'MySQL_Version',
        ),
        array(
            'title' => 'query_cache_type',
            'info'  => 'MySQL_Config',
            'args' => array(
                'name'    => 'query_cache_type',
            ),
        ),
        array(
            'title' => 'innodb_file_per_table',
            'info'  => 'MySQL_Config',
            'args' => array(
                'name' => 'innodb_file_per_table',
                'format' => 'Boolean',
            ),
            'validators' => array(
                array(
                    'validator' => 'True',
                ),
            ),
        ),
        array(
            'title' => 'innodb_buffer_pool_size',
            'info'  => 'MySQL_Config',
            'args' => array(
                'name' => 'innodb_buffer_pool_size',
                'format' => 'Byte',
            ),
        ),
    ),
);
