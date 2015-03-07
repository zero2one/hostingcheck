<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_Tests
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Tests_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the parser without tests set.
     */
    public function testParserWithoutTests()
    {
        $parser = new Hostingcheck_Scenario_Parser_Tests($this->getServices());

        // Tests not in the config.
        $config = array();
        $tests = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Scenario_Tests', $tests);
        $this->assertCount(0, $tests);
    }

    /**
     * Test the parser with an empty tests array in the config.
     */
    public function testParserWithEmptyTestsConfig()
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
     * Test the parser with tests.
     */
    public function testParserWithTests()
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
     * Create a services container.
     */
    protected function getServices()
    {
        $services = new Hostingcheck_Services();
        return $services;
    }
}
