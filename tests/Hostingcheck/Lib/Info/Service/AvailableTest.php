<?php
/**
 * Tests for Hostingcheck_Value_Service_Available
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Service_Available_TestCase
    extends PHPUnit_Framework_TestCase
{
    /**
     * Test functionality to get the service.
     */
    public function testService()
    {
        $service = $this->getMockBuilder('Hostingcheck_Service_Abstract')
                        ->disableOriginalConstructor()
                        ->getMock();

        $info = new Hostingcheck_Info_Service_Available(
            array('service' => $service)
        );

        $this->assertEquals($service, $info->service());
    }

    /**
     * Check info value when service is available.
     */
    public function testGetValueWhenServiceIsAvailable()
    {
        $service = $this->getMockBuilder('Hostingcheck_Service_Abstract')
            ->disableOriginalConstructor()
            ->getMock();

        // Configure the stub.
        $service->method('isAvailable')
            ->willReturn(true);

        $info = new Hostingcheck_Info_Service_Available(
            array('service' => $service)
        );

        $value = $info->getValue();
        $this->assertInstanceOf('Hostingcheck_Value_Text', $value);
        $this->assertEquals('available', $value->getValue());
    }

    /**
     * Check info value when service is unavailable.
     */
    public function testGetValueWhenServiceIsUnavailable()
    {
        $service = $this->getMockBuilder('Hostingcheck_Service_Abstract')
            ->disableOriginalConstructor()
            ->getMock();

        // Configure the stub.
        $service->method('isAvailable')
            ->willReturn(false);

        $error = 'Connection refused';
        $service->method('getError')
            ->willReturn($error);


        $info = new Hostingcheck_Info_Service_Available(
            array('service' => $service)
        );

        $value = $info->getValue();
        $this->assertInstanceOf('Hostingcheck_Value_NotSupported', $value);
        $this->assertEquals($error, $value->getValue());
    }
}
