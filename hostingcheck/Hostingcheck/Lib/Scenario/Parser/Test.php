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
        $infoParser = new Hostingcheck_Scenario_Parser_Info($this->services);
        $validatorsParser = new Hostingcheck_Scenario_Parser_Validators(
            $this->services
        );
        $testsParser = new Hostingcheck_Scenario_Parser_Tests($this->services);

        $scenario = new Hostingcheck_Scenario_Test(
            $config['title'],
            $infoParser->parse($config),
            $validatorsParser->parse($config),
            $testsParser->parse($config)
        );

        return $scenario;
    }
}
