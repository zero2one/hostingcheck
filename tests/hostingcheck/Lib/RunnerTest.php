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
        $config = array(
            'group1' => array(
                'title' => 'Test Group 1',
                'tests' => array(
                    array(
                        'title' => 'Group 1 Info text 1',
                        'info' => 'Hostingcheck_Info_Text',
                        'info args' => array('text' => 'Group 1 Dummy text 1'),
                    ),
                ),
            ),
            'group2' => array(
                'title' => 'Test Group 2',
                'tests' => array(
                    array(
                        'title' => 'Group 2 Info text 1',
                        'info' => 'Hostingcheck_Info_Text',
                        'info args' => array('text' => 'Group 2 Dummy text 1'),
                    ),
                    array(
                        'title' => 'Group 2 Info text 2',
                        'info' => 'Hostingcheck_Info_Text',
                        'info args' => array('text' => 'Group 2 Dummy text 2'),
                    ),
                ),
            ),
        );

        $scenario = new Hostingcheck_Scenario($config);
        $runner = new Hostingcheck_Runner($scenario);
        $results = $runner->run();
        $this->assertCount(2, $results);
    }
}
