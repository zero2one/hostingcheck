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
     * Parse classname object out of configuration parameters.
     *
     * @param string $classname
     *     The class name to use to collect the information.
     * @param array $arguments
     *     The arguments to use to collect the information.
     *
     * @return Hostingcheck_Info_Interface
     */
    public function info($classname, $arguments = array()) {
        if (empty($arguments) || !is_array($arguments)) {
            $arguments = array();
        }

        $info = new $classname($arguments);
        return $info;
    }

    /**
     * Parse validate object out of configuration parameters.
     *
     * @param array $config
     *     A validate config array.
     *     The array should contain:
     *     - validator : the classname to use as validator.
     *     - args      : the arguments to use in the validator.
     *
     * @return Hostingcheck_Validate_Interface
     */
    public function validate($config) {
        $className = $config['validator'];
        $arguments = (empty($config['args']) || !is_array($config['args']))
            ? array()
            : $config['args'];

        $validator = new $className($arguments);
        return $validator;
    }

    /**
     * Parse a Test Scenario out of a test config.
     *
     * @param array $config
     *     Config array containing:
     *     - title      : The title for the test.
     *     - info       : The info class name to use to retrieve the info.
     *     - info args  : Optional arguments to retrieve the info data.
     *     - validators : Optional array of validator config arrays.
     *
     * @return Hostingcheck_Scenario_Test
     */
    public function test($config)
    {
        $infoClass = $config['info'];
        $infoArgs  = (
            empty($config['info args']) || !is_array($config['info args'])
        )
            ? array()
            : $config['info args'];
        $info = $this->info($infoClass, $infoArgs);

        $validatorsConfig = (
            empty($config['validators']) || !is_array($config['validators'])
        )
            ? array()
            : $config['validators'];

        $validators = new Hostingcheck_Scenario_Validators();
        foreach ($validatorsConfig as $validatorConfig) {
            $validator = $this->validate($validatorConfig);
            $validators->add($validator);
        }

        $testScenario = new Hostingcheck_Scenario_Test(
            $config['title'],
            $info,
            $validators
        );

        return $testScenario;
    }

    /**
     * Parse a Group scenario out of a test config.
     *
     * @param string $name
     *     The machine name for the group.
     * @param array $config
     *     The config for a group, this contains:
     *     - title : The human name for the group.
     *     - tests : An array of group test configs.
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function group($name, $config)
    {
        $title = $config['title'];
        $testsConfig = (empty($config['tests']) || !is_array($config['tests']))
            ? array()
            : $config['tests'];

        $tests = new Hostingcheck_Scenario_Tests();
        foreach ($testsConfig as $testConfig) {
            $test = $this->test($testConfig);
            $tests->add($test);
        }

        $group = new Hostingcheck_Scenario_Group($name, $title, $tests);
        return $group;
    }

    /**
     * Parse a scenario out of an scenario config.
     *
     * @param array $config
     *     An array containing an array of group config arrays.
     *
     * @return Hostingcheck_Scenario
     */
    public function scenario($config)
    {
        $scenario = new Hostingcheck_Scenario();

        $groupsConfig = (empty($config) || !is_array($config))
            ? array()
            : $config;

        foreach ($groupsConfig as $groupName => $groupConfig) {
            $scenario->add($this->group($groupName, $groupConfig));
        }

        return $scenario;
    }
}