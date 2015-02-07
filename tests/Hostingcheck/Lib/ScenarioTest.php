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
 *
 * @group api
 */
class Hostingcheck_Scenario_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $scenario = new Hostingcheck_Scenario();
        $this->assertCount(0, $scenario);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $scenario = new Hostingcheck_Scenario();

        $group1 = $this->createGroup('group1', 'Group 1');
        $scenario->add($group1);
        $group2 = $this->createGroup('group2', 'Group 2');
        $scenario->add($group2);
        $group3 = $this->createGroup('group3', 'Group 3');
        $scenario->add($group3);

        // Test countable.
        $this->assertCount(3, $scenario);

        // First element should be by default group1.
        $this->assertEquals('group1', $scenario->key());
        $this->assertTrue($scenario->valid());
        $this->assertEquals($group1, $scenario->current());

        // Go to the next group, that should be group2.
        $scenario->next();
        $this->assertEquals('group2', $scenario->key());
        $this->assertEquals($group2, $scenario->current());

        // Seek a specific group by its machine name.
        $third = $scenario->seek('group3');
        $this->assertEquals($group3, $third);

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

    /**
     * Helper to create a new group based on the given params.
     *
     * @param string $name
     *     Machine name of the group.
     * @param string $title
     *     Human name of the group.
     *
     * @return Hostingcheck_Scenario_Group
     */
    protected function createGroup($name, $title)
    {
        $group = new Hostingcheck_Scenario_Group(
            $name,
            $title,
            new Hostingcheck_Scenario_Tests()
        );
        return $group;
    }
}
