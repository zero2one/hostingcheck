<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Check_MySQL_Info_Version.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_MySQL_Info_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $versionNumber = '5.6.7';

        // Mock the PDOStatement.
        $fetchMock = $this
            ->getMockBuilder('stdClass')
            ->setMethods(array('fetch', 'execute'))
            ->getMock();
        $fetchMock
            ->expects($this->once())
            ->method('execute');
        $fetchMock
            ->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue(array('MYSQL_VERSION' => $versionNumber)));

        // Mock the PDO class.
        $mockDb = $this
            ->getMockBuilder('stdClass')
            ->disableOriginalConstructor()
            ->setMethods(array('prepare'))
            ->getMock();
        $mockDb
            ->expects($this->once())
            ->method('prepare')
            ->with('SELECT VERSION() AS MYSQL_VERSION')
            ->willReturn($fetchMock);


        // Mock the Database Service.
        $service = $this->getMockBuilder('Hostingcheck_Service_Database')
            ->disableOriginalConstructor()
            ->setMethods(array('connection'))
            ->getMock();
        $service
            ->expects($this->once())
            ->method('connection')
            ->willReturn($mockDb);

        $version = new Check_MySQL_Info_Version(array('service' => $service));
        $value = $version->getValue();

        $this->assertInstanceOf('Hostingcheck_Value_Version', $value);
        $this->assertEquals($versionNumber, $value->getValue());
    }
}
