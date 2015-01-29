<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Runs the scenario and produces the result set.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner
{
    /**
     * The scenario to run
     *
     * @var Hostingcheck_Scenario
     */
    protected $scenario;

    /**
     * The results collection.
     *
     * @var Hostingcheck_Results
     */
    protected $results;

    /**
     * Class constructor.
     *
     * @param Hostingcheck_Scenario $scenario
     *     The scenario to run.
     */
    public function __construct(Hostingcheck_Scenario $scenario)
    {
        $this->scenario = $scenario;
        $this->results = new Hostingcheck_Results();
    }

    /**
     * Get the scenario used in this runner.
     *
     * @return Hostingcheck_Scenario
     */
    public function scenario()
    {
        return $this->scenario;
    }

    /**
     * Get the results.
     *
     * @return Hostingcheck_Results
     */
    public function results()
    {
        return $this->results;
    }
}
