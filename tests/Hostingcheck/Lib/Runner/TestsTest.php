<?php
/**
 * Tests for Hostingcheck_Runner_Test class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the run method.
     */
    public function testRun()
    {
        $scenario = new Hostingcheck_Scenario_Tests();
        $scenario->add(new Hostingcheck_Scenario_Test(
            'Info text',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));
        $scenario->add(new Hostingcheck_Scenario_Test(
            'Report Date',
            new Hostingcheck_Info_DateTime(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));

        $runner = new Hostingcheck_Runner_Tests($scenario);

        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Tests', $result);
        $this->assertCount(2, $result);
    }
}
