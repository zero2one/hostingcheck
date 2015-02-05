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
        $collection = new Hostingcheck_Scenario_Tests();
        $this->assertCount(0, $collection);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $collection = new Hostingcheck_Scenario_Tests();
        $this->assertCount(0, $collection);

        $test1 = $this->createTest('Test 1');
        $collection->add($test1);
        $test2 = $this->createTest('Test 2');
        $collection->add($test2);
        $test3 = $this->createTest('Test 3');
        $collection->add($test3);

        // Test first test in the group.
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $first = $collection->current();
        $this->assertEquals($test1, $first);

        // Test second.
        $collection->next();
        $this->assertEquals(1, $collection->key());
        $this->assertTrue($collection->valid());
        $second = $collection->current();
        $this->assertEquals($test2, $second);

        // Seek specific test by the key.
        $third = $collection->seek(2);
        $this->assertEquals($test3, $third);

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
     * Create a test object.
     *
     * @param string $title
     *     The title of the test.
     *
     * @return Hostingcheck_Scenario_Test
     */
    protected function createTest($title)
    {
        $test = new Hostingcheck_Scenario_Test(
            $title,
            new Hostingcheck_Info_Text(),
            new Hostingcheck_Scenario_Validators()
        );
        return $test;
    }
}
