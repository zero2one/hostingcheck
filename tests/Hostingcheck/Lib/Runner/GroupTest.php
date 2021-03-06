<?php
/**
 * Tests for Hostingcheck_Runner_Group class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Runner_Group_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the run method.
     */
    public function testRun()
    {
        $tests = new Hostingcheck_Scenario_Tests();
        $tests->add(new Hostingcheck_Scenario_Test(
            'Info text',
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));
        $tests->add(new Hostingcheck_Scenario_Test(
            'Report Date',
            new Hostingcheck_Info_DateTime(),
            new Hostingcheck_Scenario_Validators(),
            new Hostingcheck_Scenario_Tests()
        ));

        $scenario = new Hostingcheck_Scenario_Group('group1', 'Group 1', $tests);
        $runner = new Hostingcheck_Runner_Group($scenario);

        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Group', $result);
        $this->assertCount(2, $result->tests());
    }
}
