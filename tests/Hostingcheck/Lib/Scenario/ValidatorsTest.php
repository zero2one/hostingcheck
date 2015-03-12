<?php
/**
 * Tests for Hostingcheck_Scenario_Test class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Validators_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $collection = new Hostingcheck_Scenario_Validators();
        $this->assertCount(0, $collection);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $collection = new Hostingcheck_Scenario_Validators();

        $validate1 = new Hostingcheck_Validator_NotEmpty();
        $collection->add($validate1);
        $validate2 = new Hostingcheck_Validator_ByteSize();
        $collection->add($validate2);
        $validate3 = new Hostingcheck_Validator_Version();
        $collection->add($validate3);

        // Countable.
        $this->assertCount(3, $collection);

        // Test first test in the group.
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $first = $collection->current();
        $this->assertEquals($validate1, $first);

        // Test second.
        $collection->next();
        $this->assertEquals(1, $collection->key());
        $this->assertTrue($collection->valid());
        $second = $collection->current();
        $this->assertEquals($validate2, $second);

        // Seek specific test by the key.
        $third = $collection->seek(2);
        $this->assertEquals($validate3, $third);

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
}
