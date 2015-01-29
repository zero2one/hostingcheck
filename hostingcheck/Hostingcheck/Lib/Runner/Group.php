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
class Hostingcheck_Runner_Group
{
    /**
     * The scenario to use in the test runner.
     *
     * @var Hostingcheck_Scenario_Group
     */
    protected $scenario;


    /**
     * Constructor.
     *
     * @param Hostingcheck_Scenario_Group $scenario
     *     The scenario for the group.
     */
    public function __construct(Hostingcheck_Scenario_Group $scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * Run the test.
     *
     * @return Hostingcheck_Results_Group
     */
    public function run()
    {
        $result = new Hostingcheck_Results_Group($this->scenario);

        $tests = $this->scenario->tests();
        foreach ($tests as $testScenario) {
            $testRunner = new Hostingcheck_Runner_Test($testScenario);
            $result->tests()->add($testRunner->run());
        }

        return $result;
    }
}
