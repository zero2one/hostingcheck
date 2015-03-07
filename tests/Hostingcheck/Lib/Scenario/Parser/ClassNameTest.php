<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_ClassName.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_ClassName_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test for Hostingcheck_ prefixed class names.
     */
    public function testHostingcheckClassName()
    {
        $parser = new Hostingcheck_Scenario_Parser_ClassName();

        $this->assertEquals(
            'Hostingcheck_Info_Text',
            $parser->parse('Info', 'Text')
        );
        $this->assertEquals(
            'Hostingcheck_Validate_NotEmpty',
            $parser->parse('Validate', 'NotEmpty')
        );
        $this->assertEquals(
            'Hostingcheck_Value_NotFound',
            $parser->parse('Value', 'NotFound')
        );
    }

    /**
     * Test for Check_ prefixed class names.
     */
    public function testCheckClassName()
    {
        $parser = new Hostingcheck_Scenario_Parser_ClassName();

        $this->assertEquals(
            'Check_PHP_Info_Config',
            $parser->parse('Info', 'PHP_Config')
        );
    }
}
