<?php
/**
 * Tests for Hostingcheck_Scenario_Group class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Group_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $name = 'group-name';
        $title = 'Group Title';
        $tests = new Hostingcheck_Scenario_Tests();

        $group = new Hostingcheck_Scenario_Group($name, $title, $tests);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertEquals($tests, $group->tests());
    }
}
