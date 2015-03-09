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
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Info', $result->result());
        $this->assertInstanceOf('Hostingcheck_Results_Tests', $result->tests());
    }

    /**
     * Test running the test scenario with valid data.
     */
    public function testRunWithScenarioWithValidValidators()
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add(new Hostingcheck_Validator_NotEmpty());

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(array('text' => 2)),
            $validators,
            new Hostingcheck_Scenario_Tests()
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result->result());
        $this->assertInstanceOf('Hostingcheck_Results_Tests', $result->tests());
    }

    /**
     * Test running the test scenario with invalid validators.
     */
    public function testRunWithScenarioWithInvalidValidators()
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add(new Hostingcheck_Validator_NotEmpty());

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(),
            $validators,
            new Hostingcheck_Scenario_Tests()
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result->result());
        $this->assertInstanceOf('Hostingcheck_Results_Tests', $result->tests());
    }

    /**
     * Test running the test scenario with sub tests but with unsupported info.
     *
     * The sub tests should not run when the test info value is Not Supported.
     */
    public function testRunWithSubTestsInfoNotSupported()
    {
        // Create a Info Text mock object that has a NotSupported value.
        $info = $this->getMockBuilder('Hostingcheck_Info_Text')
                     ->getMock();
        // Configure the stub.
        $info->method('getValue')
             ->willReturn(new Hostingcheck_Value_NotSupported());

        // Create the sub tests.
        $subTests = new Hostingcheck_Scenario_Tests();
        $subTests->add(new Hostingcheck_Scenario_Test(
            'Test sub test',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));

        // Create the scenario.
        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            $info,
            new Hostingcheck_Scenario_Validators(),
            $subTests
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertCount(0, $result->tests());
    }

    /**
     * Test running the test scenario with sub tests with invalid validators.
     *
     * The sub tests should not run when the test result is not success full.
     */
    public function testRunWithSubTestsInvalidValidators()
    {
        $subTests = new Hostingcheck_Scenario_Tests();
        $subTests->add(new Hostingcheck_Scenario_Test(
            'Test sub test',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));

        $validators = new Hostingcheck_Scenario_Validators();
        $validators->add(new Hostingcheck_Validator_NotEmpty());

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(),
            $validators,
            $subTests
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertCount(0, $result->tests());
    }

    /**
     * Test run with sub tests.
     */
    public function testRunWithSubTests()
    {
        $subTests = new Hostingcheck_Scenario_Tests();
        $subTests->add(new Hostingcheck_Scenario_Test(
            'Test sub test 1',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));
        $subTests->add(new Hostingcheck_Scenario_Test(
            'Test sub test 2',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));

        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            new Hostingcheck_Info_Text(array('text' => 'Test text info')),
            new Hostingcheck_Scenario_Validators(),
            $subTests
        );

        $runner = new Hostingcheck_Runner_Test($scenario);
        $result = $runner->run();
        $this->assertCount(2, $result->tests());
    }
}
