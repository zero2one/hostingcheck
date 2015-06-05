# Hostingcheck

[![Author](https://img.shields.io/badge/author-%40sgrame-blue.svg?style=flat-square)](https://twitter.com/sgrame)
[![License : MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](http://opensource.org/licenses/MIT)
[![Build Status](https://img.shields.io/travis/zero2one/hostingcheck/master.svg?style=flat-square)](https://travis-ci.org/zero2one/hostingcheck)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/zero2one/hostingcheck.svg?style=flat-square)](https://scrutinizer-ci.com/g/zero2one/hostingcheck/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/zero2one/hostingcheck.svg?style=flat-square)](https://scrutinizer-ci.com/g/zero2one/hostingcheck)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/f5be5d8f-9c61-468b-be0d-05d65c5de390.svg?style=flat-square)](https://insight.sensiolabs.com/projects/f5be5d8f-9c61-468b-be0d-05d65c5de390)


Hostingcheck is a standalone project to validator the hosting requirements 
without the need to install your actual project first.

It collects information about the hosting platform. That information can be 
about resources, services and configuration. 
That information can be validated to check if they match the minimal 
requirements. 
The results are printed on screen and can be downloaded.

Setting up a list  of test is done by creating a scenario file. No further 
development is required.

Hostingcheck project is pluggable: it is easy to add extra Checks for services 
not included in the base package.



# Minimal requirements

Hostingcheck is written in PHP and run trough a webserver & browser. 

The minimum requirements are:
* Web server (Apache, Nginx, IIS, ...) with PHP.
* Minimal PHP 5.2



# Installation

1. Download or clone the repository and copy the `hostingcheck` directory to the
   hosting platform you want to validate.
2. Copy the `example.settings.php` to `settings.php` and fill in the blanks.
   Protect the test with a username & password. Both values should be md5 
   hashed.
   The default account is:
   * Username : demo
   * Password : demo
3. Copy the `example.scenario.php` to `scenario.php` and define the tests.
4. Some tests may require services (e.g. a database connection). Define this by
   copy `example.services.php` to `services.php` and add the service(s) 
   configuration(s).
    
Point your browser to the hostingcheck.php script on the hosting platform and 
login. The tests will be performed and the results will be printed on the 
screen.



# Configuration

The configuration file (`settings.php`) contains the following settings:


## Title

The title attribute sets the name of the report.
 
```
$settings['title'] = 'Hostingcheck DEV';
```


## Authentication

Hostingcheck requires authentication to avoid free access to hosting info & 
configuration. The username & password needs both to be hashed using md5.

```
$settings['auth'] = array(
    'username' => 'fe01ce2a7fbac8fafaed7c982a04e229',
    'password' => 'fe01ce2a7fbac8fafaed7c982a04e229',
);
```

Use [online tools](http://www.md5.cz/) to create the hashes.
 
The example.settings.php file has following credentials:

* Username : demo
* Password : demo



# Test scenario

Tests are run based on the scenario.php file. That file describes what tests
should be run.


## Define collections

Tests are grouped in collections. Those collections are printed out as sections
in the report.

Create a scenario by defining the collections. To keep the scenario easier to
maintain create first an empty collection variable and add this by reference 
to the collections array. Give the scenario's a title, that title will be used
in the report.

```
// Create the collection variables.
$info = array();
$server = array();

// Create the scenario by adding the collections to it.
$scenario = array(
    'info' => array(
        'title' => 'Information',
        'tests' => & $info,
    ),
    'server' => array(
        'title' => 'Server',
        'tests' => & $server,
    ),
);
```


## Add tests

Add tests by adding them to the collection variables. A test is defined by 
setting the test title (what is this test about), setting the type of data to 
collect and use in the test, optional attributes, and optional validators.

Example of a simple test that prints out information:

```
$info[] = array(
    'title'      => 'Info text',
    'info'       => 'Text',
    'args'  => array('text' => 'Some smalltalk info text'),
);
```

Example of a test that prints out the free disk space on the / mount point:

```
$server[] = array(
    'title'      => 'Used disk space',
    'info'       => 'Server_DiskSizeUsed',
    'args'       => array('path' => '/'),
);
```

See [Tests overview](docs/info.md) for a full list of available data collectors.


### Required

If collecting data should have a result, the option *required* can be added to 
the test config.

```
$web[] = array(
    'title' => 'Apache version',
    'info'  => 'Apache_Version',
    'required' => true,
);
```


### Validators

Validators can be added to the test, these will validate the data that is 
collected.

```
$php[] = array(
    'title'      => 'PHP Version',
    'info'       => 'PHP_Version',
    'validators' => array(
        array(
            'validator' => 'Version',
            'args'      => array('min' => '5', 'max' => '6'),
        ),
    ),
    'required'   => true,
);
```

See [Validators overview](docs/validators.md) for a full list of available validators.


### Sub tests

A test can have subtests. These tests will only run when the parent test has a
positive result.

There is no limit in the nesting level.

```
$web[] = array(
    'title' => 'Apache version',
    'info'  => 'Apache_Version',
    'required' => true,
    'tests' => array(
        array(
            'title' => 'Rewrite module',
            'info' => 'Apache_Module',
            'args' => array('name' => 'mod_rewrite'),
            'required' => true,
        ),
        array(
            'title' => 'Deflate module',
            'info' => 'Apache_Module',
            'args' => array('name' => 'mod_deflate'),
            'required' => true,
        ),
    ),
);
```



# Services

Some tests needs a service connection (e.g. database connection) to run the 
tests.

The service connection parameters are environment specific. The settings are 
stored in the `services.php` file.

```
$services['db_mysql'] = array(
    'class' => 'Hostingcheck_Service_Database',
    'config' => array(
        'dsn'      => 'mysql:host=localhost;dbname=db_name',
        'username' => 'db_username',
        'password' => 'db_password',
        'options'  => array()
    )
);
```

The service key can be used in the test. This is defined by adding the service 
by its name to the configuration array.

```
$db[] = array(
    'title' => 'MySQL service available',
    'info' => 'Service_Available',
    'service' => 'db_mysql',
    'required' => true,
);
```

The service object will be created and passed to the test. 
Nested tests will automatically receive the service of the parent test.

```
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
    ),
);
```

See [available Services](docs/services.md) for a full list of available services.



# Create extra checks

Hostingcheck contains very basic Info collectors. Other, service specific, info
collectors are located in the `Hostingcheck/Check` directory. 

Extra services, data collectors and validators can be added to that folder.


## Info

The info collectors should be created within the 
`Hostingcheck/Check/ServiceName/Info` directory.

They should implement the `Hostingcheck_Info_Interface` interface or extend one 
of the implementing classes.
The class should implement the `collectValue()` method to return the information 
and optionaly the `__construct()` method to retrieve info specific arguments.

The class name should be prefixed with `Check_ServiceName_Info_`.

The `collectValue()` method should return one of the available value objects or
an implementation of the `Hostingcheck_Value_Interface` interface.
 
See [Values overview](docs/values.md) for a full list of available value objects.
 

```
class Check_PHP_Info_Config extends Hostingcheck_Info_Abstract
{
    /**
     * PHP Config key to be checked.
     *
     * @var string
     */
    protected $key;

    /**
     * Format to be used for the value.
     *
     * @var string
     */
    protected $format;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : the name of the config key.
     */
    public function __construct($arguments = array())
    {
        if (empty($arguments['name'])) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->key = $arguments['name'];
        $this->format = (isset($arguments['format']) && class_exists($arguments['format']))
            ? $arguments['format']
            : 'Hostingcheck_Value_Text';
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        $value = ini_get($this->key);
        if ($value === false) {
            $this->value = new Hostingcheck_Value_NotFound();
            return;
        }

        $this->value = new $this->format($value);
    }
}
```

Using the data collector in the test is done by using the classname without the 
`Check` prefix and `Info` insertion:

```
$php[] = array(
    'title'      => 'PHP Version',
    'info'       => 'PHP_Version',
);
```


## Validator

The validator should be created within the 
`Hostingcheck/Check/ServiceName/Validator` directory.

They should implement the `Hostingcheck_Validator_Interface` interface or 
extend one of the implementing classes.
The class should implement the `validate()` method.

The class name should be prefixed with `Check_ServiceName_Validate_`.

The `validate()` method should return  and return one of the defined 
[result objects](results.md).

```
class Check_PHP_Validator_Version extends Hostingcheck_Validator_Version
{
    /**
     * Messages when the validator fails.
     *
     * @var array
     */
    protected $messages = array(
        'equal' => 'PHP version is not equal to {value}.',
        'min' => 'PHP version should be at least {min}.',
        'max' => 'PHP Version should be at most {max}.',
    );
}
```


Using the validator in the test is done by using the classname without the 
`Check` prefix and `Validator` insertion:

```
$php[] = array(
    'title'      => 'PHP Version',
    'info'       => 'PHP_Version',
    'validators' => array(
        array(
            'validator' => 'PHP_Version',
            'args'      => array('min' => '5', 'max' => '6'),
        ),
    ),
);
```
