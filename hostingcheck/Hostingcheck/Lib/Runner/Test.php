<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Runner to perform a singe test.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner_Test
{
    /**
     * The scenario to use in the test runner.
     *
     * @var Hostingcheck_Scenario_Test
     */
    protected $scenario;


    /**
     * Constructor.
     *
     * @param Hostingcheck_Scenario_Test $scenario
     *     The scenario for the single test.
     */
    public function __construct(Hostingcheck_Scenario_Test $scenario)
    {
        $this->scenario = $scenario;
    }

    /**
     * Run the test.
     *
     * @return Hostingcheck_Results_Test
     */
    public function run()
    {
        $info = $this->scenario->info();

        $validators = $this->scenario->validators();
        if (count($validators) === 0) {
            $result = new Hostingcheck_Result_Info();
        }
        else {
            foreach ($validators as $validator) {
                $result = $validator->validate($info->getValue());

                // Stop validating if there was an error.
                if ($result instanceof Hostingcheck_Result_Failure) {
                    break;
                }
            }
        }

        $testResult = new Hostingcheck_Results_Test(
            $this->scenario,
            $info,
            $result
        );

        return $testResult;
    }
}
