<?php
/**
 * This file is part of Hostingcheck.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2015 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/MIT
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
        $result = new Hostingcheck_Results_Tests();

        foreach ($this->scenario as $testScenario) {
            $testRunner = new Hostingcheck_Runner_Test($testScenario);
            $result->add($testRunner->run());
        }

        return $result;
    }
}
