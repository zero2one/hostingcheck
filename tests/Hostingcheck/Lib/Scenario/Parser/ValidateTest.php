<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_Validate.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validate_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the parser to convert validation config to validation object.
     */
    public function testParser()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validate($this->getServices());
        $config = array(
            'validator' => 'ByteSize',
            'args' => array('min' => '15M'),
        );

        $validator = $parser->parse($config);
        $this->assertInstanceOf('Hostingcheck_Validate_ByteSize', $validator);
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
