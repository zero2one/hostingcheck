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
            'Hostingcheck_Info_Text',
            array('text' => 'Test text info'),
            array()
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
        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            'Hostingcheck_Info_Text',
            array('text' => 2),
            array(
                array(
                    'validator' => 'Hostingcheck_Validate_NotEmpty',
                ),
            )
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
        $scenario = new Hostingcheck_Scenario_Test(
            'Test info',
            'Hostingcheck_Info_Text',
            array(),
            array(
                array(
                    'validator' => 'Hostingcheck_Validate_NotEmpty',
                ),
            )
        );
        $runner = new Hostingcheck_Runner_Test($scenario);

        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Test', $result);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $result->info());
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result->result());
    }
}
