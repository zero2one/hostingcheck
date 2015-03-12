<?php
/**
 * Tests for Hostingcheck_Scenario_Parser_Tests
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parser without tests set.
     */
    public function testWithoutTests()
    {
        $parser = new Hostingcheck_Scenario_Parser_Tests($this->getServices());

        // Tests not in the config.
        $config = array();
        $tests = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(0, $tests);
    }

    /**
     * Test parser with an empty tests array in the config.
     */
    public function testWithEmptyTestsConfig()
    {
        $parser = new Hostingcheck_Scenario_Parser_Tests($this->getServices());

        // Empty tests array.
        $config = array(
            'tests' => array()
        );
        $tests = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(0, $tests);
    }

    /**
     * Test parser with tests.
     */
    public function testWithTests()
    {
        $parser = new Hostingcheck_Scenario_Parser_Tests($this->getServices());

        $config = array(
            'tests' => array(
                array(
                    'title' => 'subtest 1',
                    'info' => 'Text',
                ),
                array(
                    'title' => 'subtest 2',
                    'info' => 'Text',
                ),
            )
        );
        $tests = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(2, $tests);
    }

    /**
     * Test parser with shared service.
     */
    public function testWithService()
    {
        // Create a mock service and add it to the mocked services container.
        $service = $this->getMockBuilder('Hostingcheck_Service_Interface')
            ->disableOriginalConstructor()
            ->getMock();

        $services = $this->getServices();
        $services->add('my_service', $service);

        $parser = new Hostingcheck_Scenario_Parser_Tests($services);

        $config = array(
            'service' => 'my_service',
            'tests' => array(
                array(
                    'title' => 'Subtest without service set',
                    'info' => 'Service_Available',
                ),
            ),
        );

        $tests = $parser->parse($config);
        $subTest = $tests->current()->info();
        $this->assertSame($service, $subTest->service());
    }

    /**
     * Test parser with shared service
     * but one of the tests has its own (other) service config.
     */
    public function testWithServiceAndTestHasDifferentService()
    {
        // Create a mock service and add it to the mocked services container.
        $service1 = $this->getMockBuilder('Hostingcheck_Service_Interface')
            ->disableOriginalConstructor()
            ->getMock();
        $service2 = $this->getMockBuilder('Hostingcheck_Service_Interface')
            ->disableOriginalConstructor()
            ->getMock();

        $services = $this->getServices();
        $services->add('my_service1', $service1);
        $services->add('my_service2', $service2);

        $parser = new Hostingcheck_Scenario_Parser_Tests($services);

        $config = array(
            'service' => 'my_service1',
            'tests' => array(
                array(
                    'title' => 'Subtest without service set',
                    'info' => 'Service_Available',
                    'service' => 'my_service2',
                ),
            ),
        );

        $tests = $parser->parse($config);
        $subTest = $tests->current()->info();
        $this->assertSame($service2, $subTest->service());
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
