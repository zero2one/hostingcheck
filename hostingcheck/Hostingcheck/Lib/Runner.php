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
     * Class constructor.
     *
     * @param Hostingcheck_Scenario $scenario
     *     The scenario to run.
     */
    public function __construct(Hostingcheck_Scenario $scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * Run the runner.
     *
     * @return Hostingcheck_Results
     */
    public function run()
    {
        $results = new Hostingcheck_Results();

        foreach ($this->scenario as $group) {
            $runner = new Hostingcheck_Runner_Group($group);
            $results->add($runner->run());
        }

        return $results;
    }
}
