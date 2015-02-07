<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Runner_Test class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner_Test_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test running the test scenario without validators.
     */
    public function testRunWithScenarioWithoutValidators()
    {
        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(array('text' => 'Test text info')),
            new Hostingcheck_Scenario_Validators()
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Info', $result->result());
    }

    /**
     * Test running the test scenario with valid data.
     */
    public function testRunWithScenarioWithValidValidators()
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add(new Hostingcheck_Validate_NotEmpty());

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(array('text' => 2)),
            $validators
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result->result());
    }

    /**
     * Test running the test scenario with invalid validators.
     */
    public function testRunWithScenarioWithInvalidValidators()
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add(new Hostingcheck_Validate_NotEmpty());

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(),
            $validators
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result->result());
    }
}
