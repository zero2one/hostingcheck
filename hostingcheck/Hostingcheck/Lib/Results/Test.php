<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A single test result.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Test
{
    /**
     * The test scenario.
     *
     * @var Hostingcheck_Scenario_Test
     */
    protected $scenario;

    /**
     * The info collected while running the test.
     *
     * @var Hostingcheck_Info_Interface
     */
    protected $info;

    /**
     * The result of the test.
     *
     * @var Hostingcheck_Result_Interface
     */
    protected $result;

    /**
     * The results of the subtests.
     *
     * @var Hostingcheck_Results_Tests
     */
    protected $tests;


    /**
     * Class constructor.
     *
     * @param Hostingcheck_Scenario_Test $scenario
     *     The test scenario used to get to this result.
     * @param Hostingcheck_Info_Interface $info
     *     The info collected during running the test.
     * @param Hostingcheck_Result_Interface $result
     *     The result of running the test.
     * @param Hostingcheck_Results_Tests $tests
     *     The results of the subtests.
     */
    public function __construct(
        Hostingcheck_Scenario_Test $scenario,
        Hostingcheck_Info_Interface $info,
        Hostingcheck_Result_Interface $result,
        Hostingcheck_Results_Tests $tests
    )
    {
        $this->scenario = $scenario;
        $this->info = $info;
        $this->result = $result;
        $this->tests = $tests;
    }

    /**
     * Get the test scenario.
     *
     * @return Hostingcheck_Scenario_Test
     */
    public function scenario()
    {
        return $this->scenario;
    }

    /**
     * Get the test Info.
     *
     * @return Hostingcheck_Info_Interface
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * Get the test result.
     *
     * @return Hostingcheck_Result_Interface
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * Get the sub tests results.
     *
     * @return Hostingcheck_Results_Tests
     */
    public function tests()
    {
        return $this->tests;
    }
}
