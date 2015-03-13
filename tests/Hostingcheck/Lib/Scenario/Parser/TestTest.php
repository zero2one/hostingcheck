<?php
/**
 * Tests for Hostingcheck_Scenario_Parser_Test.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Test_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parser with simple test config.
     */
    public function testWithSimpleConfig()
    {
        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertInstanceOf('Hostingcheck_Scenario_Test', $test);
        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());

        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Validators',
            $test->validators());
        $this->assertCount(0, $test->validators());

        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Tests',
            $test->tests()
        );
        $this->assertCount(0, $test->tests());
    }

    /**
     * Test parser with validators.
     */
    public function testWithValidators()
    {
        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
            'args' => array('text' => 'Test text'),
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                )
            ),
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $validators = $test->validators();
        $this->assertCount(1, $validators);
    }

    /**
     * Test parser with nested tests.
     */
    public function testWithNestedTests()
    {
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

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertCount(2, $test->tests());
    }

    /**
     * Test with missing title.
     */
    public function testWithMissingTitle()
    {
        $config = array(
            'info' => 'Text',
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertEquals('[NO TITLE]', $test->title());
    }

    /**
     * Test with missing info class name.
     */
    public function testWithMissingInfoClassName()
    {
        $config = array();

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());
        $this->assertCount(1, $test->validators());
        $this->assertInstanceOf(
            'Hostingcheck_Validator_Error',
            $test->validators()->current()
        );
        $this->assertEquals(
            '[SCENARIO ERROR]',
            $test->info()->getValue()->getValue()
        );
    }

    /**
     * Test with invalid Info config.
     */
    public function testWithInvalidInfoConfig()
    {
        $config = array(
            'title' => 'Test parser with not supported info class name.',
            'info' => 'FooBarBizBar',
            'required' => true,
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertInstanceOf('Hostingcheck_Info_Text', $test->info());
        $this->assertCount(1, $test->validators());
        $this->assertInstanceOf(
            'Hostingcheck_Validator_Error',
            $test->validators()->current()
        );
        $this->assertEquals(
            '[SCENARIO ERROR]',
            $test->info()->getValue()->getValue()
        );
    }

    /**
     * Test with invalid Info config.
     */
    public function testWithInvalidValidatorsConfig()
    {
        $config = array(
            'title' => 'Test parser with not supported validator class name.',
            'info' => 'Text',
            'validators' => array(
                array('validator' => 'FooBarBizBaz'),
                array('validator' => 'NotEmpty'),
            ),
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertCount(1, $test->validators());
        $this->assertInstanceOf(
            'Hostingcheck_Validator_Error',
            $test->validators()->current()
        );
        $this->assertEquals(
            '[SCENARIO ERROR]',
            $test->info()->getValue()->getValue()
        );
    }

    /**
     * Test with invalid format.
     */
    public function testWithInvalidFormat()
    {
        $config = array(
            'title' => 'Test parser with not supported format class name.',
            'info' => 'Text',
            'args' => array(
                'format' => 'FooBarBizBaz'
            ),
        );

        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());
        $test = $parser->parse($config);

        $this->assertCount(1, $test->validators());
        $this->assertInstanceOf(
            'Hostingcheck_Validator_Error',
            $test->validators()->current()
        );
        $this->assertEquals(
            '[SCENARIO ERROR]',
            $test->info()->getValue()->getValue()
        );
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
