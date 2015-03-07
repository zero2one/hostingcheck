<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a collection of validators out of an array of validator configs.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validators
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse the test::validators out of the test config array.
     *
     * @param array $config
     *     Config containing:
     *     - validators : An optional array of validator configurations.
     *     - required : Optional boolean if the info object should not return
     *                  an optional value. By default false.
     *                  If set to true, a Hostingcheck_Validate_NonEmpty will
     *                  be added to the validators config.
     *
     * @return Hostingcheck_Scenario_Validators
     */
    public function parse($config)
    {
        $validators = new Hostingcheck_Scenario_Validators();
        $validatorsConfig = array();

        if (!empty($config['validators']) && is_array($config['validators'])) {
            $validatorsConfig = $config['validators'];
        }

        // Support the required switch.
        $this->required($config, $validatorsConfig);

        // Convert the config array into validator objects.
        foreach ($validatorsConfig as $validatorConfig) {
            $validator = $this->validate($validatorConfig);
            $validators->add($validator);
        }

        return $validators;
    }

    /**
     * Helper to add NonEmpty to the validators when the info is required.
     *
     * @param array $config
     *     The config used to create the validators.
     * @param array $validators
     *     The array of validators config.
     */
    protected function required($config, &$validators)
    {
        if (empty($config['required'])) {
            return;
        }

        // Check if there is already a NonEmpty validator defined.
        foreach ($validators as $validator) {
            if ($validator['validator'] === 'NotEmpty') {
                return;
            }
        }

        // Add the NonEmpty validator.
        $validators[] = array('validator' => 'NotEmpty');
    }

    /**
     * Parse a validator out of the given validator config array.
     *
     * @param array $config
     *     The validate array.
     *     @see Hostingcheck_Scenario_Parser_Validate::parse
     *
     * @return Hostingcheck_Validate_Interface
     */
    protected function validate($config)
    {
        $parser = new Hostingcheck_Scenario_Parser_Validate($this->services);
        return $parser->parse($config);
    }
}
