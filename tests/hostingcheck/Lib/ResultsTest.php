<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Results class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $results = new Hostingcheck_Results();
        $this->assertCount(0, $results);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $scenario = new Hostingcheck_Scenario(array());
        $results = new Hostingcheck_Results($scenario);

        // Add some group results.
        $group1 = new Hostingcheck_Results_Group(
            new Hostingcheck_Scenario_Group('group1', 'Group 1', array())
        );
        $results->add($group1);
        $group2 = new Hostingcheck_Results_Group(
            new Hostingcheck_Scenario_Group('group2', 'Group 2', array())
        );
        $results->add($group2);
        $group3 = new Hostingcheck_Results_Group(
            new Hostingcheck_Scenario_Group('group3', 'Group 3', array())
        );
        $results->add($group3);

        // Countable.
        $this->assertCount(3, $results);

        // First element should be by default group1.
        $this->assertEquals($group1, $results->current());
        $this->assertEquals('group1', $results->key());
        $this->assertTrue($results->valid());

        // Go to the next group, that should be group2.
        $results->next();
        $this->assertEquals('group2', $results->key());
        $this->assertEquals($group2, $results->current());

        // Seek a specific group by its machine name.
        $this->assertEquals($group3, $results->seek('group3'));


        // A non existing machine name should return null.
        $this->assertNull($results->seek('FooBar'));

        // Go to group3.
        $results->next();
        $this->assertTrue($results->valid());

        // Go to next, not valid element.
        $results->next();
        $this->assertFalse($results->valid());

        // Test foreach loop.
        $results->rewind();
        $i = 1;
        foreach ($results as $name => $group) {
            $this->assertEquals('group' . $i, $name);
            $i++;
        }
    }
}
