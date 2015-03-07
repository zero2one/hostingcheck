<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


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
        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());

        $config = array(
            'title' => 'Test parser',
            'info' => 'Text',
        );

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
        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());

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

        $test = $parser->parse($config);

        $validators = $test->validators();
        $this->assertCount(1, $validators);
    }

    /**
     * Test parser with nested tests.
     */
    public function testWithNestedTests()
    {
        $parser = new Hostingcheck_Scenario_Parser_Test($this->getServices());

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

        $test = $parser->parse($config);
        $this->assertCount(2, $test->tests());
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
