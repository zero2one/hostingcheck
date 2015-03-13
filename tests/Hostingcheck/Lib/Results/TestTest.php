<?php
/**
 * Tests for Hostingcheck_Results_Test class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Test_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $scenario = new Hostingcheck_Scenario_Test(
            'test',
            new Hostingcheck_Info_Text(array('text' => 'Scenario Test')),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        );
        $info = new Hostingcheck_Info_Text(array('text' => 'Test info'));
        $result = new Hostingcheck_Result_Info();
        $tests = new Hostingcheck_Results_Tests();

        $testResult = new Hostingcheck_Results_Test(
            $scenario,
            $info,
            $result,
            $tests
        );
        $this->assertEquals($scenario, $testResult->scenario());
        $this->assertEquals($info, $testResult->info());
        $this->assertEquals($result, $testResult->result());
        $this->assertEquals($tests, $testResult->tests());
    }
}
