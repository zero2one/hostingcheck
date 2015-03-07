<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a validator out of a validator config array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validate
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse validate object out of configuration parameters.
     *
     * @param array $config
     *     A validate config array.
     *     The array should contain:
     *     - validator : the className to use as validator.
     *     - args      : the arguments to use in the validator.
     *
     * @return Hostingcheck_Validate_Interface
     */
    public function parse($config)
    {
        $className = $config['validator'];
        $arguments = array();

        if (!empty($config['args']) && is_array($config['args'])) {
            $arguments = $config['args'];
        }

        // Create the validate object.
        $fullName = $this->getClassName('Validate', $className);
        return new $fullName($arguments);
    }
}
