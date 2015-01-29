<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
        $scenario = new Hostingcheck_Scenario_Group(
            'test',
            'Test Group',
            array(
                array(
                    'title'      => 'Info text',
                    'info'       => 'Hostingcheck_Info_Text',
                    'info args'  => array('info' => 'Some smalltalk info text'),
                ),
                array(
                    'title'      => 'Report Date',
                    'info'       => 'Hostingcheck_Info_DateTime',
                ),
            )
        );

        $runner = new Hostingcheck_Runner_Group($scenario);

        $result = $runner->run();
        $this->assertInstanceOf('Hostingcheck_Results_Group', $result);
        $this->assertCount(2, $result->tests());
    }
}
