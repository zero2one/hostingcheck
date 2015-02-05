<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Runner class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_RunnerTest extends PHPUnit_Framework_TestCase {
    /**
     * Test the Run method.
     */
    public function testRun()
    {
        $scenario = new Hostingcheck_Scenario();
        $scenario->add(
            new Hostingcheck_Scenario_Group(
                'group1',
                'Group 1',
                new Hostingcheck_Scenario_Tests()
            )
        );
        $scenario->add(
            new Hostingcheck_Scenario_Group(
                'group2',
                'Group 2',
                new Hostingcheck_Scenario_Tests()
            )
        );

        $runner = new Hostingcheck_Runner($scenario);
        $results = $runner->run();
        $this->assertCount(2, $results);
    }
}
