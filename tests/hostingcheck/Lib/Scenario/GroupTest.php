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
        $tests = $this->getGroupTestsConfig();

        $group = new Hostingcheck_Scenario_Group($name, $title, $tests);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertCount(3, $group);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $group = new Hostingcheck_Scenario_Group(
            'test-seekable',
            'Test Seekable',
            $this->getGroupTestsConfig()
        );

        $this->assertCount(3, $group);

        // Test first test in the group.
        $this->assertEquals(0, $group->key());
        $this->assertTrue($group->valid());
        $first = $group->current();
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $first);

        // Test second.
        $group->next();
        $this->assertEquals(1, $group->key());
        $this->assertTrue($group->valid());
        $second = $group->current();
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $second);

        // Seek specific test by the key.
        $third = $group->seek(2);
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $third);

        $notExisting = $group->seek(404);
        $this->assertNull($notExisting);

        // Go to the 3thd item.
        $group->next();
        $this->assertTrue($group->valid());

        // Collection should be at the end.
        $group->next();
        $this->assertFalse($group->valid());


        // Rewind the collection.
        $group->rewind();
        $this->assertEquals(0, $group->key());

        // Loop trough collection.
        $i = 0;
        foreach ($group as $key => $test) {
            $this->assertEquals($i, $key);
            $i++;
        }
    }


    /**
     * Get a group config array.
     *
     * @return array
     */
    protected function getGroupTestsConfig()
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
