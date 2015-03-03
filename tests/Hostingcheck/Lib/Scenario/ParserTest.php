<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the parser to convert config to info object.
     */
    public function testInfoParser()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $text = 'Text text';
        $info = $parser->info(
            'Text',
            array('text' => $text)
        );

        $this->assertInstanceOf('Hostingcheck_Info_Text', $info);
        $this->assertEquals($text, $info->getValue());
    }

    /**
     * Test info parser with value format option.
     */
    public function testInfoParserWithCheckPrefixAndValueFormat()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $info = $parser->info(
            'Server_Disk',
            array(
                'name' => 'total',
                'format' => 'Byte',
            )
        );

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

        $parser = new Hostingcheck_Scenario_Parser($services);

        $info = $info = $parser->info(
            'Service_Available',
            array('service' => 'my_service')
        );

        $this->assertEquals($service, $info->service());
    }

    /**
     * Test the parser to convert validation config to validation object.
     */
    public function testValidateParser()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());
        $config = array(
            'validator' => 'ByteSize',
            'args' => array('min' => '15M'),
        );

        $validator = $parser->validate($config);
        $this->assertInstanceOf('Hostingcheck_Validate_ByteSize', $validator);
    }

    /**
     * Test parser with simple test config.
     */
    public function testTestParserWithSimpleConfig()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
        );

        $test = $parser->test($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $test);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Validators',
            $test->validators());
        $this->assertCount(0, $test->validators());
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $test->tests());
        $this->assertCount(0, $test->tests());
    }

    /**
     * Test the parser to convert test config to test scenario object.
     */
    public function testTestParserWithFullConfig()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
            'info args' => array('text' => 'Test text'),
            'validators' => array(
                array(
                    'validator' => 'ByteSize',
                    'args' => array('min' => '15M'),
                )
            ),
        );

        $test = $parser->test($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $test);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());

        $validators = $test->validators();
        $this->assertCount(1, $validators);
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Validators',
            $validators
        );
        $this->assertInstanceOf(
            'Hostingcheck_Validate_ByteSize',
            $validators->seek(0)
        );
    }

    /**
     * Test the test parser with nested tests.
     */
    public function testTestParserWithNestedTests()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
            'tests' => array(
                array(
                    'title' => 'subtest 1',
                    'info' => 'Text',
                ),
                array(
                    'title' => 'subtest 2',
                    'info' => 'Text',
                ),
            ),
        );

        $test = $parser->test($config);
        $this->assertCount(2, $test->tests());
    }

    /**
     * Test the tests collection parser without tests set.
     */
    public function testTestsParserWithoutTests()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        // Tests not in the config.
        $config = array();
        $tests = $parser->tests($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(0, $tests);

        // Empty tests array.
        $config = array(
            'tests' => array()
        );
        $tests = $parser->tests($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(0, $tests);
    }

    /**
     * Test the tests collection parser with tests.
     */
    public function testTestsParserWithTests()
    {
        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

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
        $tests = $parser->tests($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(2, $tests);
    }

    /**
     * Test the group parser without tests.
     */
    public function testGroupParserWithoutTests()
    {
        $name = 'test-group';
        $title = 'Test group';
        $config = array(
            'title' => $title,
        );

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $group = $parser->group($name, $config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Group', $group);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertCount(0, $group->tests());
    }

    /**
     * Test the group parser without tests.
     */
    public function testGroupParserWithTests()
    {
        $name = 'test-group';
        $title = 'Test group';
        $config = array(
            'title' => $title,
            'tests' => array(
                array(
                    'title' => 'Test parser',
                    'info' => 'Text',
                    'info args' => array('text' => 'Test text'),
                    'validators' => array(
                        array(
                            'validator' => 'ByteSize',
                            'args' => array('min' => '15M'),
                        )
                    ),
                ),
            )
        );

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $group = $parser->group($name, $config);
        $this->assertEquals($name, $group->name());
        $this->assertEquals($title, $group->title());
        $this->assertCount(1, $group->tests());
    }

    /**
     * Test scenario without groups (empty).
     */
    public function testScenarioWithoutGroups()
    {
        $config = array();

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $scenario = $parser->scenario($config);
        $this->assertInstanceOf('Hostingcheck_Scenario', $scenario);
        $this->assertCount(0, $scenario);
    }

    /**
     * Test scenario with groups.
     */
    public function testScenarioWithGroups()
    {
        $config = array(
            'group1' => array(
                'title' => 'Group 1',
            ),
            'group2' => array(
                'title' => 'Group 2',
            )
        );

        $parser = new Hostingcheck_Scenario_Parser($this->getServices());

        $scenario = $parser->scenario($config);
        $this->assertInstanceOf('Hostingcheck_Scenario', $scenario);
        $this->assertCount(2, $scenario);
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
