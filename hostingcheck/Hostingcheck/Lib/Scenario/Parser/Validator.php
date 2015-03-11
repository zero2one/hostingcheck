<?php
/**
 * This file is part of Hostingcheck.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2015 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/MIT
 */


/**
 * Parse a validator out of a validator config array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Validator
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse validator object out of configuration parameters.
     *
     * @param array $config
     *     A validator config array.
     *     The array should contain:
     *     - validator : the className to use as validator.
     *     - args      : the arguments to use in the validator.
     *
     * @return Hostingcheck_Validator_Interface
     */
    public function parse($config)
    {
        $className = $config['validator'];
        $arguments = array();

        if (!empty($config['args']) && is_array($config['args'])) {
            $arguments = $config['args'];
        }

        // Create the validator object.
        $fullName = $this->getClassName('Validator', $className);
        return new $fullName($arguments);
    }
}
