<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_Info.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Info_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the parser to convert config to info object.
     */
    public function testInfoParser()
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
     * Test info parser with value format option.
     */
    public function testInfoParserWithCheckPrefixAndValueFormat()
    {
        $config = array(
            'info' => 'Server_Disk',
            'args' => array(
                'name' => 'total',
                'format' => 'Byte',
            ),
        );

        $parser = new Hostingcheck_Scenario_Parser_Info($this->getServices());
        $info = $parser->parse($config);

        $this->assertInstanceOf('Check_Server_Info_Disk', $info);
        $this->assertInstanceOf('Hostingcheck_Value_Byte', $info->getValue());
    }

    /**
     * Test the parser to convert config into info object with service.
     */
    public function testInfoParserWithService()
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
