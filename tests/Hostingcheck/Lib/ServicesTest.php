<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Services class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 *
 * @group api
 */
class Hostingcheck_Services_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the method to add an item to the collection.
     */
    public function testAdd()
    {
        $collection = new Hostingcheck_Services();
        $this->assertCount(0, $collection);
        $this->assertNull($collection->seek('foobar'));

        $service = $this->getMockBuilder('Hostingcheck_Service_Interface')
            ->disableOriginalConstructor()
            ->getMock();

        $collection->add('foobar', $service);
        $this->assertInstanceOf(
            'Hostingcheck_Service_Interface',
            $collection->seek('foobar')
        );
    }
}
