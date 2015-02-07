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
        $tests = new Hostingcheck_Scenario_Tests();

        $group = new Hostingcheck_Scenario_Group($name, $title, $tests);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertEquals($tests, $group->tests());
    }
}
