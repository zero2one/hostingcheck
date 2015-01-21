<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $test = array(
            'title' => 'Info text',
            'info' => 'Hostingcheck_Info_Text',
            'info args' => array('info' => 'Dummy text'),
        );
        $scenario = array(
            'valid' => array(
                'title' => 'Valid test',
                'tests' => array($test),
            ),
            'invalid-test' => array(
                'title' => 'No tests',
            ),
            'invalid-title' => array(
                'tests' => array(),
            ),
        );

        $scenario = new Hostingcheck_Scenario($scenario);
        $this->assertCount(1, $scenario);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $test = array(
            'title' => 'Info text',
            'info' => 'Hostingcheck_Info_Text',
            'info args' => array('info' => 'Dummy text'),
        );
        $scenario = array(
            'group1' => array(
                'title' => 'Valid test',
                'tests' => array($test),
            ),
            'group2' => array(
                'title' => 'Valid test',
                'tests' => array($test),
            ),
            'group3' => array(
                'title' => 'Valid test',
                'tests' => array($test),
            ),
        );

        $scenario = new Hostingcheck_Scenario($scenario);
        $this->assertCount(3, $scenario);

        // First element should be by default group1.
        $this->assertEquals('group1', $scenario->key());
        $this->assertTrue($scenario->valid());

        // Go to the next group, that should be group2.
        $scenario->next();
        $this->assertEquals('group2', $scenario->key());
        $current = $scenario->current();
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Group',
            $current
        );

        // Seek a specific group by its machine name.
        $group3 = $scenario->seek('group3');
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Group',
            $current
        );

        // A non existing machine name should return null.
        $this->assertNull($scenario->seek('FooBar'));

        // Go to group3.
        $scenario->next();
        $this->assertTrue($scenario->valid());

        // Go to next, not valid element.
        $scenario->next();
        $this->assertFalse($scenario->valid());

        // Test foreach loop.
        $scenario->rewind();
        $i = 1;
        foreach ($scenario as $name => $group) {
            $this->assertEquals('group' . $i, $name);
            $i++;
        }
    }

}
