<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Results_Tests class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $tests = new Hostingcheck_Results_Tests();
        $this->assertCount(0, $tests);
    }

    /**
     * Test adding a test to the collection.
     */
    public function testAdd()
    {
        $tests = new Hostingcheck_Results_Tests();
        $this->assertCount(0, $tests);

        $test = $this->createTestResult();
        $tests->add($test);
        $this->assertCount(1, $tests);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $collection = new Hostingcheck_Results_Tests();

        // Add some tests to the collection.
        $result1 = $this->createTestResult();
        $collection->add($result1);
        $result2 = $this->createTestResult();
        $collection->add($result2);
        $result3 = $this->createTestResult();
        $collection->add($result3);

        // Countable.
        $this->assertCount(3, $collection);

        // Test first result in the group.
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $first = $collection->current();
        $this->assertEquals($result1, $first);

        // Test second result in group.
        $collection->next();
        $this->assertEquals(1, $collection->key());
        $this->assertTrue($collection->valid());
        $second = $collection->current();
        $this->assertEquals($result2, $second);

        // Seek specific test by the key.
        $third = $collection->seek(2);
        $this->assertEquals($result3, $third);

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
     * Create a dummy Hostingcheck_Results_Test() object.
     *
     * @param string $name
     *     Name of the test.
     * @param string $info
     *     The info class name.
     *
     * @return Hostingcheck_Results_Test
     */
    protected function createTestResult($name = null, $info = null)
    {
        if (empty($name)) {
            $name = md5(mt_rand(0, 5000) . time());
        }
        if (empty($info)) {
            $info = 'Hostingcheck_Info_Text';
        }

        $testResult = new Hostingcheck_Results_Test(
            new Hostingcheck_Scenario_Test($name, $info),
            new $info(),
            new Hostingcheck_Result_Info()
        );

        return $testResult;
    }
}
