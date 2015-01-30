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
        $parser = new Hostingcheck_Scenario_Parser();

        $text = 'Text text';
        $info = $parser->info(
            'Hostingcheck_Info_Text',
            array('text' => $text)
        );

        $this->assertInstanceOf('Hostingcheck_Info_Text', $info);
        $this->assertEquals($text, $info->getValue());
    }

    /**
     * Test the parser to convert validation config to validation object.
     */
    public function testValidateParser()
    {
        $parser = new Hostingcheck_Scenario_Parser();
        $config = array(
            'validator' => 'Hostingcheck_Validate_ByteSize',
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
        $parser = new Hostingcheck_Scenario_Parser();

        $config = array(
            'title' => 'Test parser',
            'info' => 'Hostingcheck_Info_Text',
        );

        $test = $parser->test($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $test);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Validators',
            $test->validators());
        $this->assertCount(0, $test->validators());
    }

    /**
     * Test the parser to convert test config to test scenario object.
     */
    public function testTestParserWithFullConfig()
    {
        $parser = new Hostingcheck_Scenario_Parser();

        $config = array(
            'title' => 'Test parser',
            'info' => 'Hostingcheck_Info_Text',
            'info args' => array('text' => 'Test text'),
            'validators' => array(
                array(
                    'validator' => 'Hostingcheck_Validate_ByteSize',
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
     * Test the group parser without tests.
     */
    public function testGroupParserWithoutTests()
    {
        $name = 'test-group';
        $title = 'Test group';
        $config = array(
            'title' => $title,
        );

        $parser = new Hostingcheck_Scenario_Parser();

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
                    'info' => 'Hostingcheck_Info_Text',
                    'info args' => array('text' => 'Test text'),
                    'validators' => array(
                        array(
                            'validator' => 'Hostingcheck_Validate_ByteSize',
                            'args' => array('min' => '15M'),
                        )
                    ),
                ),
            )
        );

        $parser = new Hostingcheck_Scenario_Parser();

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

        $parser = new Hostingcheck_Scenario_Parser();

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

        $parser = new Hostingcheck_Scenario_Parser();

        $scenario = $parser->scenario($config);
        $this->assertInstanceOf('Hostingcheck_Scenario', $scenario);
        $this->assertCount(2, $scenario);
    }
}
