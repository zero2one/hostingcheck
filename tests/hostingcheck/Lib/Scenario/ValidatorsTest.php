<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
        $validators = $this->getValidatorsConfig();
        $collection = new Hostingcheck_Scenario_Validators($validators);
        $this->assertCount(3, $collection);
    }

    /**
     * Test the iterator functionality.
     */
    public function testSeekable()
    {
        $validators = $this->getValidatorsConfig();
        $collection = new Hostingcheck_Scenario_Validators($validators);

        $this->assertCount(3, $collection);

        // Test first test in the group.
        $this->assertEquals(0, $collection->key());
        $this->assertTrue($collection->valid());
        $first = $collection->current();
        $this->assertInstanceOf('Hostingcheck_Validate_Interface', $first);

        // Test second.
        $collection->next();
        $this->assertEquals(1, $collection->key());
        $this->assertTrue($collection->valid());
        $second = $collection->current();
        $this->assertInstanceOf('Hostingcheck_Validate_Interface', $second);

        // Seek specific test by the key.
        $third = $collection->seek(2);
        $this->assertInstanceOf('Hostingcheck_Validate_Interface', $third);

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
    protected function getValidatorsConfig()
    {
        $validators = array(
            array(
                'validator' => 'Hostingcheck_Validate_ByteSize',
                'args' => array('min' => '15M'),
            ),
            array(
                'validator' => 'Hostingcheck_Validate_Version',
                'args' => array('min' => '1.0', 'max' => '99.99'),
            ),
            array(
                'validator' => 'Hostingcheck_Validate_NotEmpty',
            ),

            // Non existing validator.
            array(
                'validator' => 'Foo_Bar_NonExisting_Validator',
            ),
            // Missing validator class name.
            array(
                'args' => array('min' => '1.0', 'max' => '99.99'),
            ),
        );

        return $validators;
    }
}
