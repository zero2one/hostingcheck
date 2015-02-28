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
        $versionNumber = '5.16.27';

        $fetchMock = $this->createFetchMock(
            array('MYSQL_VERSION' => $versionNumber)
        );
        $dbMock = $this->createDbMock($fetchMock);
        $service = $this->createDatabaseServiceMock($dbMock);

        $version = new Check_MySQL_Info_Version(array('service' => $service));
        $value = $version->getValue();

        $this->assertInstanceOf('Hostingcheck_Value_Version', $value);
        $this->assertEquals($versionNumber, $value->getValue());
    }

    /**
     * Check get value method when the DB does not return the version number.
     */
    public function testGetValueWithoutSupport()
    {
        $fetchMock = $this->createFetchMock(false);
        $dbMock = $this->createDbMock($fetchMock);
        $service = $this->createDatabaseServiceMock($dbMock);

        $version = new Check_MySQL_Info_Version(array('service' => $service));
        $value = $version->getValue();

        $this->assertInstanceOf('Hostingcheck_Value_NotSupported', $value);
    }


    /**
     * Get a mock for the PDOStatement object.
     *
     * @param mixed $value
     *   The value that the fetch method should return.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createFetchMock($value)
    {
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
            ->will($this->returnValue($value));

        return $fetchMock;
    }

    /**
     * Get a mock for the database connection.
     *
     * @param PHPUnit_Framework_MockObject_MockObject $fetchMock
     *   The MockObject that represents the PDOStatement object.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     *   The MockObject that represents the PDO DB connection.
     */
    protected function createDbMock($fetchMock)
    {
        // Mock the PDO class.
        $dbMock = $this
            ->getMockBuilder('stdClass')
            ->disableOriginalConstructor()
            ->setMethods(array('prepare'))
            ->getMock();
        $dbMock
            ->expects($this->once())
            ->method('prepare')
            ->with('SELECT VERSION() AS MYSQL_VERSION')
            ->willReturn($fetchMock);

        return $dbMock;
    }

    /**
     * Get a mock of the Hostingcheck_Service_Database object.
     *
     * @param PHPUnit_Framework_MockObject_MockObject $dbMock
     *   The MockObject representing the PDO database connection.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     *   The MockObject representing the Hostingcheck_Service_Database object.
     */
    protected function createDatabaseServiceMock($dbMock)
    {
        // Mock the Database Service.
        $service = $this->getMockBuilder('Hostingcheck_Service_Database')
            ->disableOriginalConstructor()
            ->setMethods(array('connection'))
            ->getMock();
        $service
            ->expects($this->once())
            ->method('connection')
            ->willReturn($dbMock);

        return $service;
    }
}
