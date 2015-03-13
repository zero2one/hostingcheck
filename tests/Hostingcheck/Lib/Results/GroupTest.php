<?php
/**
 * Tests for Hostingcheck_Scenario_Results class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Group_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $scenario = new Hostingcheck_Scenario_Group(
            'test',
            'Test',
            new Hostingcheck_Scenario_Tests()
        );
        $results = new Hostingcheck_Results_Group($scenario);

        $this->assertEquals($scenario, $results->scenario());

        $tests = $results->tests();
        $this->assertInstanceOf('Hostingcheck_Results_Tests', $tests);
    }
}
