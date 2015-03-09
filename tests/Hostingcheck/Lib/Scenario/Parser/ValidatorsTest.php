<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Scenario_Parser_Validators.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validators_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test parsing a config without validators.
     */
    public function testWithoutValidators()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validators(
            $this->getServices()
        );

        $config = array();
        $validators = $parser->parse($config);
        $this->assertInstanceOf(
            'Hostingcheck_Scenario_Validators',
            $validators
        );
        $this->assertCount(0, $validators);
    }

    /**
     * Test parsing a config with defined validators.
     */
    public function testWithValidators()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validators(
            $this->getServices()
        );

        $config = array(
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                ),
            ),
        );
        $validators = $parser->parse($config);
        $this->assertCount(1, $validators);
        $this->assertInstanceOf(
            'Hostingcheck_Validator_NotEmpty',
            $validators->current()
        );
    }

    /**
     * Test parsing a config with required flag and no validators.
     */
    public function testWithoutValidatorsAndIsRequired()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validators(
            $this->getServices()
        );

        $config = array(
            'required' => true,
        );
        $validators = $parser->parse($config);
        $this->assertCount(1, $validators);
        $this->assertInstanceOf(
            'Hostingcheck_Validator_NotEmpty',
            $validators->current()
        );
    }

    /**
     * Test parsing a config that has already a NotEmpty validator.
     */
    public function testWithNotEmptyValidatorAndIsRequired()
    {
        $parser = new Hostingcheck_Scenario_Parser_Validators(
            $this->getServices()
        );

        $config = array(
            'required' => true,
            'validators' => array(
                array(
                    'validator' => 'NotEmpty',
                ),
            ),
        );
        $validators = $parser->parse($config);
        $this->assertCount(1, $validators);
        $this->assertInstanceOf(
            'Hostingcheck_Validator_NotEmpty',
            $validators->current()
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
