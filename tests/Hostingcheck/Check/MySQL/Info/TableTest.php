<?php
/**
 * Tests for Check_MySQL_Info_Table.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_MySQL_Info_Table_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test with no config name set.
     */
    public function testWithoutNameArgument()
    {
        $info = new Check_MySQL_Info_Table();
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $info->getValue()
        );
    }

    /**
     * Check get value method without a valid table name.
     */
    public function testGetValueWithInvalidValidConfigName()
    {
        $tableName = 'fooBar';

        $countMock = $this->createCountMock(0);
        $dbMock = $this->createDbMock($countMock);
        $serviceMock = $this->createDatabaseServiceMock($dbMock);

        $info = new Check_MySQL_Info_Table(array(
            'service' => $serviceMock,
            'name' => $tableName,
        ));
        $value = $info->getValue();

        $this->assertInstanceOf('Hostingcheck_Value_NotFound', $value);
    }

    /**
     * Check get value method with a valid config name.
     */
    public function testGetValueWithValidConfigName()
    {
        $tableName = 'fooBar';

        $countMock = $this->createCountMock(1);
        $dbMock = $this->createDbMock($countMock);
        $serviceMock = $this->createDatabaseServiceMock($dbMock);

        $info = new Check_MySQL_Info_Table(array(
            'service' => $serviceMock,
            'name' => $tableName,
        ));
        $value = $info->getValue();

        $this->assertInstanceOf('Hostingcheck_Value_Text', $value);
        $this->assertEquals($tableName, $value->getValue());
    }

    /**
     * Get a mock for the PDOStatement object.
     *
     * @param mixed $count
     *   The expected count the mock should return.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    protected function createCountMock($count)
    {
        // Mock the PDOStatement.
        $mock = $this
            ->getMockBuilder('stdClass')
            ->setMethods(array('rowCount', 'execute'))
            ->getMock();
        $mock
            ->expects($this->once())
            ->method('execute');
        $mock
            ->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue($count));

        return $mock;
    }

    /**
     * Get a mock for the database connection.
     *
     * @param PHPUnit_Framework_MockObject_MockObject $countMock
     *   The MockObject that represents the PDOStatement object.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     *   The MockObject that represents the PDO DB connection.
     */
    protected function createDbMock($countMock)
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
            ->with('SHOW TABLES LIKE ?')
            ->willReturn($countMock);

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
