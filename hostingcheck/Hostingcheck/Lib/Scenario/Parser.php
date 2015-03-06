<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a scenario array to a Scenario object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser {
    /**
     * Services to use when creating the info objects.
     *
     * @var Hostingcheck_Services
     */
    protected $services;


    /**
     * Constructor.
     *
     * @param Hostingcheck_Services $services
     */
    public function __construct($services)
    {
        $this->services = $services;
    }

    /**
     * Parse className object out of configuration parameters.
     *
     * @param string $className
     *     The class name to use to collect the information.
     * @param array $arguments
     *     The arguments to use to collect the information.
     * @param string $service
     *     The name of the service to use in the info object.
     *
     * @return Hostingcheck_Info_Interface
     */
    public function info($className, $arguments = array(), $service = null) {
        if (empty($arguments) || !is_array($arguments)) {
            $arguments = array();
        }

        // Get the service from the services based on its collection named key.
        if (!empty($service)) {
            $arguments['service'] = $this->services->seek(
                $service
            );
        }

        // Create the format class name (if any).
        if (!empty($arguments['format'])) {
            $arguments['format'] = $this->createClassName(
                'Value',
                $arguments['format']
            );
        }

        // Create the info object.
        $fullName = $this->createClassName('Info', $className);
        return new $fullName($arguments);
    }

    /**
     * Parse validate object out of configuration parameters.
     *
     * @param array $config
     *     A validate config array.
     *     The array should contain:
     *     - validator : the className to use as validator.
     *     - args      : the arguments to use in the validator.
     *
     * @return Hostingcheck_Validate_Interface
     */
    public function validate($config) {
        $parser = new Hostingcheck_Scenario_Parser_Validate($this->services);
        return $parser->parse($config);
    }

    /**
     * Parse a Test Scenario out of a test config.
     *
     * @param array $config
     *     Config array containing:
     *     - title      : The title for the test.
     *     - info       : The info class name to use to retrieve the info.
     *     - args       : Optional arguments to retrieve the info data.
     *     - validators : Optional array of validator config arrays.
     *     - tests      : Optional array of child tests. These tests will only
     *                    be run if the test did not failed or is not supported.
     *
     * @return Hostingcheck_Scenario_Test
     */
    public function test($config)
    {
        $testScenario = new Hostingcheck_Scenario_Test(
            $config['title'],
            $this->testInfo($config),
            $this->testValidators($config),
            $this->tests($config)
        );

        return $testScenario;
    }

    /**
     * Parse the test::info out of the test config array.
     *
     * @param array $config
     *     Config containing:
     *     - info : The type of info that needs to be collected.
     *     - args : Optional arguments needed to collect the info.
     *     - service : An optional service name to use in the info object.
     *
     * @return Hostingcheck_Info_Interface
     */
    protected function testInfo($config)
    {
        $infoClass = $config['info'];
        $infoArgs = array();
        $service = false;

        if (!empty($config['args']) && is_array($config['args'])) {
            $infoArgs = $config['args'];
        }
        if (!empty($config['service'])) {
            $service = $config['service'];
        }

        return $this->info($infoClass, $infoArgs, $service);
    }

    /**
     * Parse the test::validators out of the test config array.
     *
     * @param array $config
     *     Config containing:
     *     - validators : An optional array of validator configurations.
     *     - required : Optional boolean if the info object should not return
     *                  an optional value. By default false.
     *                  If set to true, a Hostingcheck_Validate_NonEmpty will
     *                  be added to the validators config.
     *
     * @return Hostingcheck_Scenario_Validators
     */
    protected function testValidators($config)
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validatorsConfig = array();

        if (!empty($config['validators']) && is_array($config['validators'])) {
            $validatorsConfig = $config['validators'];
        }

        // Support the required switch.
        $this->testRequired($config, $validatorsConfig);

        // Convert the config array into validator objects.
        foreach ($validatorsConfig as $validatorConfig) {
            $validator = $this->validate($validatorConfig);
            $validators->add($validator);
        }

        return $validators;
    }

    /**
     * Helper to add NonEmpty to the validators when the info is required.
     *
     * @param array $config
     *     The config used to create the validators.
     * @param array $validators
     *     The array of validators config.
     */
    protected function testRequired($config, &$validators)
    {
        if (empty($config['required'])) {
            return;
        }

        // Check if there is already a NonEmpty validator defined.
        foreach ($validators as $validator) {
            if ($validator['validator'] === 'NotEmpty') {
                return;
            }
        }

        // Add the NonEmpty validator.
        $validators[] = array('validator' => 'NotEmpty');
    }

    /**
     * Create a tests scenario from a config where one of the params is tests.
     *
     * @param array $config
     *     The config for a group or test with:
     *     - tests : an optional array of test configs.
     *     - service : the service to use in all tests.
     *
     * @return Hostingcheck_Scenario_Tests
     */
    public function tests($config)
    {
        $tests = new Hostingcheck_Scenario_Tests();

        $testsConfig = $this->testsExtract($config);
        $defaultConfig = $this->testsDefaultConfig($config);

        // Add the tests to the collection.
        foreach ($testsConfig as $testConfig) {
            $testConfig = array_merge($defaultConfig, $testConfig);
            $test = $this->test($testConfig);
            $tests->add($test);
        }

        return $tests;
    }

    /**
     * Get the tests array out of the config.
     *
     * @param array $config
     *
     * @return array
     */
    protected function testsExtract($config)
    {
        $tests = array();
        if (!empty($config['tests']) && is_array($config['tests'])) {
            $tests = $config['tests'];
        }

        return $tests;
    }

    /**
     * Get the tests test default config array.
     *
     * @param array $config
     *
     * @return array
     */
    protected function testsDefaultConfig($config)
    {
        $defaults = array();

        // Check if the parent has a service set, if so add it to the default
        // config for the child tests.
        if (!empty($config['service'])) {
            $defaults['service'] = $config['service'];
        }

        return $defaults;
    }

    /**
     * Parse a Group scenario out of a test config.
     *
     * @param string $name
     *     The machine name for the group.
     * @param array $config
     *     The config for a group, this contains:
     *     - title : The human name for the group.
     *     - tests : An optional array of group test configs.
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function group($name, $config)
    {
        $group = new Hostingcheck_Scenario_Group(
            $name,
            $config['title'],
            $this->tests($config)
        );
        return $group;
    }

    /**
     * Parse a scenario out of an scenario config.
     *
     * @param array $config
     *     An array containing an array of group config arrays.
     *     Each array item key is the machine name of the group.
     *
     * @return Hostingcheck_Scenario
     */
    public function scenario($config)
    {
        $scenario = new Hostingcheck_Scenario();
        $groupsConfig = array();

        if (!empty($config) && is_array($config)) {
            $groupsConfig = $config;
        }

        foreach ($groupsConfig as $groupName => $groupConfig) {
            $scenario->add($this->group($groupName, $groupConfig));
        }

        return $scenario;
    }

    /**
     * Construct the full class name from the short name.
     *
     * @param string $type
     *     The class type.
     * @param string $className
     *     The short version of the name.
     *
     * @return string
     */
    protected function createClassName($type, $className)
    {
        $parser = new Hostingcheck_Scenario_Parser_ClassName($this->services);
        return $parser->parse($type, $className);
    }
}
