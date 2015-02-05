<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A group of tests.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Group
{
    /**
     * The group scenario.
     *
     * @var Hostingcheck_Scenario_Group
     */
    protected $scenario;

    /**
     * The test results of the group.
     *
     * @var Hostingcheck_Results_Tests
     */
    protected $tests;

    /**
     * Class constructor.
     *
     * @param Hostingcheck_Scenario_Group $scenario
     *     The group scenario.
     */
    public function __construct(Hostingcheck_Scenario_Group $scenario)
    {
        $this->scenario = $scenario;
        $this->tests = new Hostingcheck_Results_Tests();
    }

    /**
     * Get group scenario.
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function scenario()
    {
        return $this->scenario;
    }

    /**
     * Get the tests results.
     *
     * @return Hostingcheck_Results_Tests
     */
    public function tests()
    {
        return $this->tests;
    }
}
