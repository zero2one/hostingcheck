<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
        $tests = $this->getTestsConfig();

        $group = new Hostingcheck_Scenario_Group($name, $title, $tests);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());

        $tests = $group->tests();
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(3, $tests);
    }

    /**
     * Get a group config array.
     *
     * @return array
     */
    protected function getTestsConfig()
    {
        $tests = array(
            array(
                'title' => 'Info text 1',
                'info' => 'Hostingcheck_Info_Text',
                'info args' => array('info' => 'Dummy text 1'),
            ),
            array(
                'title' => 'Info text 2',
                'info' => 'Hostingcheck_Info_Text',
                'info args' => array('info' => 'Dummy text 2'),
            ),
            array(
                'title' => 'Info text 3',
                'info' => 'Hostingcheck_Info_Text',
                'info args' => array('info' => 'Dummy text 3'),
            ),
            // Should be ignored as no title set.
            array(
                'info' => 'Hostingcheck_Info_Text',
            ),
            // Should be ignored as no info class set.
            array(
                'title' => 'Info text 5',
            ),
        );

        return $tests;
    }
}
