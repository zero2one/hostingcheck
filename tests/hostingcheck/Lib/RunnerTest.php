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
     * Test the constructor.
     */
    public function testConstructor()
    {
        $scenario = new Hostingcheck_Scenario(array());
        $runner = new Hostingcheck_Runner($scenario);

        $this->assertEquals($scenario, $runner->scenario());

        $results = $runner->results();
        $this->assertInstanceOf('Hostingcheck_Results', $results);
    }
}
