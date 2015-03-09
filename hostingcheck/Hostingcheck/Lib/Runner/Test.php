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
     *     A collection with the result of its own and optional sub tests.
     */
    public function run()
    {
        // Validate the test first.
        $result = $this->runTest();

        // Run the sub tests.
        $result->tests()->addMultiple($this->runSubTests($result));

        return $result;
    }

    /**
     * Run a single test.
     *
     * @return Hostingcheck_Results_Test
     */
    protected function runTest()
    {
        $testResult = new Hostingcheck_Results_Test(
            $this->scenario,
            $this->scenario->info(),
            $this->runTestValidators(),
            new Hostingcheck_Results_Tests()
        );

        return $testResult;
    }

    /**
     * Run the test validators.
     *
     * @return Hostingcheck_Result_Interface
     */
    protected function runTestValidators()
    {
        $result = new Hostingcheck_Result_Info();

        $validators = $this->scenario->validators();
        foreach ($validators as $validator) {
            $value = $this->scenario->info()->getValue();
            $result = $validator->validate($value);

            // Stop validating if there was an error.
            if ($result instanceof Hostingcheck_Result_Failure) {
                return $result;
            }
        }

        return $result;
    }

    /**
     * Run all the sub tests.
     *
     * Will only be run if the given result is
     * - supported
     * - not a failure
     *
     * @param Hostingcheck_Results_Test $testResult
     *     The single test result.
     *
     * @return Hostingcheck_Results_Tests
     */
    protected function runSubTests(Hostingcheck_Results_Test $testResult)
    {
        // Run the sub tests only if the test is valid.
        if (
            !($testResult->info()->getValue() instanceof Hostingcheck_Value_NotSupported)
            && !($testResult->result() instanceof Hostingcheck_Result_Failure)
        ) {
            $testsRunner = new Hostingcheck_Runner_Tests($this->scenario->tests());
            $result = $testsRunner->run();
        }
        else {
            $result = new Hostingcheck_Results_Tests();
        }

        return $result;
    }
}
