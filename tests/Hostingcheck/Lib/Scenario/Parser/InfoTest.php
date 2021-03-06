<?php
/**
 * Tests for Hostingcheck_Scenario_Parser_Info.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Info_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parser with basic config array.
     */
    public function testSimpleConfig()
    {
        $text = 'Text text';
        $config = array(
            'info' => 'Text',
            'args' => array('text' => $text),
        );

        $parser = new Hostingcheck_Scenario_Parser_Info($this->getServices());
        $info = $parser->parse($config);

        $this->assertInstanceOf('Hostingcheck_Info_Text', $info);
        $this->assertEquals($text, $info->getValue());
    }

    /**
     * Test parser with value format option.
     */
    public function testWithFormat()
    {
        $config = array(
            'info' => 'Server_DiskSize',
            'args' => array(
                'name' => 'total',
                'format' => 'Byte',
            ),
        );

        $parser = new Hostingcheck_Scenario_Parser_Info($this->getServices());
        $info = $parser->parse($config);

        $this->assertInstanceOf('Check_Server_Info_DiskSize', $info);
        $this->assertInstanceOf('Hostingcheck_Value_Byte', $info->getValue());
    }

    /**
     * Test parser with given service name.
     */
    public function testWithService()
    {
        $service = $this->getMockBuilder('Hostingcheck_Service_Interface')
            ->disableOriginalConstructor()
            ->getMock();

        $services = $this->getServices();
        $services->add('my_service', $service);

        $config = array(
            'info' => 'Service_Available',
            'service' => 'my_service',
        );

        $parser = new Hostingcheck_Scenario_Parser_Info($services);
        $info = $parser->parse($config);

        $this->assertSame($service, $info->service());
    }

    /**
     * Create a services container.
     */
    protected function getServices()
    {
        $services = new Hostingcheck_Services();
        return $services;
    }
}
