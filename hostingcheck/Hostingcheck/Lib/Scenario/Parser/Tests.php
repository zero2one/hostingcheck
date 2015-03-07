<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a Tests scenario out of test config array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Tests
    extends Hostingcheck_Scenario_Parser_Abstract
{
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
    public function parse($config)
    {
        $tests = new Hostingcheck_Scenario_Tests();
        $testParser = new Hostingcheck_Scenario_Parser_Test($this->services);

        $testsConfig = $this->testsConfig($config);
        $defaultConfig = $this->testDefaultConfig($config);

        // Add the tests to the collection.
        foreach ($testsConfig as $testConfig) {
            $testConfig = array_merge($defaultConfig, $testConfig);
            $test = $testParser->parse($testConfig);
            $tests->add($test);
        }

        return $tests;
    }

    /**
     * Get the array of test configs out of the config array.
     *
     * @param array $config
     *
     * @return array
     */
    protected function testsConfig($config)
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
    protected function testDefaultConfig($config)
    {
        $defaults = array();

        // Check if the parent has a service set, if so add it to the default
        // config for the child tests.
        if (!empty($config['service'])) {
            $defaults['service'] = $config['service'];
        }

        return $defaults;
    }
}
