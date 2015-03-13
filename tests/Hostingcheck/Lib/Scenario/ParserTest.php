<?php
/**
 * Tests for Hostingcheck_Scenario_Parser class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test scenario without groups (empty).
     */
    public function testScenarioWithoutGroups()
    {
        $config = array();

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $scenario = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario', $scenario);
        $this->assertCount(0, $scenario);
    }

    /**
     * Test scenario with groups.
     */
    public function testScenarioWithGroups()
    {
        $config = array(
            'group1' => array(
                'title' => 'Group 1',
            ),
            'group2' => array(
                'title' => 'Group 2',
            )
        );

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $scenario = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario', $scenario);
        $this->assertCount(2, $scenario);
    }

    /**
     * Create a services container.
     */
    protected function getServices()
    {
        $services = new Hostingcheck_Services();
        return $services;
    }
}
