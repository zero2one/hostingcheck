<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a Test out of test config array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Test
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse a Test Scenario out of a test config.
     *
     * @param array $config
     *     Config array containing:
     *     - title      : The title for the test.
     *     - info       : The info class name to use to retrieve the info.
     *     - required   : Optional if it required that the retrieved info is
     *                    not empty.
     *     - args       : Optional arguments to retrieve the info data.
     *     - validators : Optional array of validator config arrays.
     *     - tests      : Optional array of child tests. These tests will only
     *                    be run if the test did not failed or is not supported.
     *
     * @return Hostingcheck_Scenario_Test
     */
    public function parse($config)
    {
        try {
            $scenario = $this->test($config);
        }
        catch (Hostingcheck_Scenario_Parser_Exception $e) {
            $scenario = $this->error($config, $e->getMessage());
        }

        return $scenario;
    }

    /**
     * Try to parse the Test out of the config.
     *
     * @param array $config
     *
     * @return Hostingcheck_Scenario_Test
     */
    protected function test($config)
    {
        $infoParser = new Hostingcheck_Scenario_Parser_Info(
            $this->services
        );
        $validatorsParser = new Hostingcheck_Scenario_Parser_Validators(
            $this->services
        );

        $info = $infoParser->parse($config);
        $validators = $validatorsParser->parse($config);

        return $this->scenario($config, $info, $validators);
    }

    /**
     * Create a scenario with an error Info object.
     *
     * @param array $config
     *     The config array.
     * @param string $message
     *     The error message.
     *
     * @return Hostingcheck_Scenario_Test
     */
    protected function error($config, $message)
    {
        // Replace the info object with a custom text value.
        $info = new Hostingcheck_Info_Text(array('text' => '[SCENARIO ERROR]'));

        // Add the Exception message to forced Error validator.
        $errorValidator = new Hostingcheck_Validate_Error(
            array('message' => $message)
        );
        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add($errorValidator);

        return $this->scenario($config, $info, $validators);
    }

    /**
     * Create a test scenario.
     *
     * @param array $config
     *     The config array.
     * @param Hostingcheck_Info_Interface $info
     *     The info object to use in the scenario.
     * @param Hostingcheck_Scenario_Validators $validators
     *     The validators collection to use in the test scenario.
     *
     * @return Hostingcheck_Scenario_Test
     */
    protected function scenario($config, $info, $validators)
    {
        if (empty($config['title'])) {
            $config['title'] = '[NO TITLE]';
        }

        $testsParser = new Hostingcheck_Scenario_Parser_Tests(
            $this->services
        );

        $scenario = new Hostingcheck_Scenario_Test(
            $config['title'],
            $info,
            $validators,
            $testsParser->parse($config)
        );

        return $scenario;
    }
}
