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
