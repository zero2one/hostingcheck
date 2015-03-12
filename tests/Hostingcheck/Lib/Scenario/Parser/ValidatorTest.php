<?php
/**
 * Tests for Hostingcheck_Scenario_Parser_Validator.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validator_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the parser to convert validation config to validation object.
     */
    public function testParser()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validator($this->getServices());
        $config = array(
            'validator' => 'ByteSize',
            'args' => array('min' => '15M'),
        );

        $validator = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Validator_ByteSize', $validator);
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
