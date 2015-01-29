<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Tests class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $tests = $this->getTestsConfig();
        $collection = new Hostingcheck_Scenario_Tests($tests);
        $this->assertCount(3, $collection);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $collection = new Hostingcheck_Scenario_Tests(
            $this->getTestsConfig()
        );

        $this->assertCount(3, $collection);

        // Test first test in the group.
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $first = $collection->current();
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $first);

        // Test second.
        $collection->next();
        $this->assertEquals(1, $collection->key());
        $this->assertTrue($collection->valid());
        $second = $collection->current();
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $second);

        // Seek specific test by the key.
        $third = $collection->seek(2);
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $third);

        $notExisting = $collection->seek(404);
        $this->assertNull($notExisting);

        // Go to the 3thd item.
        $collection->next();
        $this->assertTrue($collection->valid());

        // Collection should be at the end.
        $collection->next();
        $this->assertFalse($collection->valid());


        // Rewind the collection.
        $collection->rewind();
        $this->assertEquals(0, $collection->key());

        // Loop trough collection.
        $i = 0;
        foreach ($collection as $key => $test) {
            $this->assertEquals($i, $key);
            $i++;
        }
    }


    /**
     * Get a tests config array.
     *
     * @return array
     */
    protected function getTestsConfig()
    {
        $tests = array(
            array(
                'title' => 'Info text 1',
                'info' => 'Hostingcheck_Info_Text',
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
