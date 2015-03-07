<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_Group.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Group_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parser without tests.
     */
    public function testWithoutTests()
    {
        $name = 'test-group';
        $title = 'Test group';
        $config = array(
            'title' => $title,
        );

        $parser = new Hostingcheck_Scenario_Parser_Group($this->getServices());
        $group = $parser->parse($name, $config);

        $this->assertInstanceOf('Hostingcheck_Scenario_Group', $group);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertCount(0, $group->tests());
    }

    /**
     * Test the parser with tests.
     */
    public function testWithTests()
    {
        $name = 'test-group';
        $title = 'Test group';
        $config = array(
            'title' => $title,
            'tests' => array(
                array(
                    'title' => 'Test parser',
                    'info' => 'Text',
                ),
            )
        );

        $parser = new Hostingcheck_Scenario_Parser_Group($this->getServices());
        $group = $parser->parse($name, $config);

        $this->assertCount(1, $group->tests());
    }

    /**
     * Test without title.
     */
    public function testWithoutTitle()
    {
        $name = 'test-group';
        $config = array();

        $parser = new Hostingcheck_Scenario_Parser_Group($this->getServices());
        $group = $parser->parse($name, $config);

        $this->assertEquals('[NO TITLE]', $group->title());
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
