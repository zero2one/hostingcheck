<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Runner to run a group scenario.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner_Tests
{
    /**
     * The scenario to use in the test runner.
     *
     * @var Hostingcheck_Scenario_Tests
     */
    protected $scenario;


    /**
     * Constructor.
     *
     * @param Hostingcheck_Scenario_Tests $scenario
     *     The scenario for the tests.
     */
    public function __construct(Hostingcheck_Scenario_Tests $scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * Run the test.
     *
     * @return Hostingcheck_Results_Tests
     */
    public function run()
    {
        $result = new Hostingcheck_Results_Tests($this->scenario);

        foreach ($this->scenario as $testScenario) {
            $testRunner = new Hostingcheck_Runner_Test($testScenario);
            $result->addMultiple($testRunner->run());
        }

        return $result;
    }
}
