<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
