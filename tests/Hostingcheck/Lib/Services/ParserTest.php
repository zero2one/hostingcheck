<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Services_Parser
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Services_Parser_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parsing a single service with non existing class name.
     *
     * @ex
     */
    public function testParseServiceWithInvalidClassName()
    {
        $config = array(
            'class' => 'Hostingcheck_Service_FooBar',
        );

        $parser = new Hostingcheck_Services_Parser();
        $service = $parser->parseService($config);
        $this->assertFalse($service);
    }

    /**
     * Test parsing a single service without config array.
     */
    public function testParseServiceWithoutConfig()
    {
        $config = array(
            'class' => 'Hostingcheck_Service_Database',
        );

        $parser = new Hostingcheck_Services_Parser();
        $service = $parser->parseService($config);
        $this->assertInstanceOf('Hostingcheck_Service_Database', $service);
    }

    /**
     * Test parsing a single service with config array.
     */
    public function testParseServiceWithConfig()
    {
        $config = array(
            'class' => 'Hostingcheck_Service_Database',
            'config' => array(
                'dsn' => 'sqlite::memory:'
            ),
        );

        $parser = new Hostingcheck_Services_Parser();
        $service = $parser->parseService($config);
        $this->assertInstanceOf('Hostingcheck_Service_Database', $service);
    }

    /**
     * Parse an empty config array.
     */
    public function testParseWithoutConfig()
    {
        $config = array();

        $parser = new Hostingcheck_Services_Parser();
        $services = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Services', $services);
        $this->assertCount(0, $services);
    }

    /**
     * Parse a set of service configs.
     */
    public function testParseWithConfig()
    {
        $config = array(
            'db_1' => array(
                'class' => 'Hostingcheck_Service_Database',
                'config' => array(
                    'dsn' => 'sqlite::memory:'
                ),
            ),
            'db_2' => array(
                'class' => 'Hostingcheck_Service_Database',
                'config' => array(
                    'dsn' => 'sqlite::memory:'
                ),
            )
        );

        $parser = new Hostingcheck_Services_Parser();
        $services = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Services', $services);
        $this->assertCount(2, $services);

        $this->assertInstanceOf(
            'Hostingcheck_Service_Database',
            $services->seek('db_1')
        );
        $this->assertInstanceOf(
            'Hostingcheck_Service_Database',
            $services->seek('db_2')
        );
        $this->assertNull($services->seek('FooBar'));
    }
}
