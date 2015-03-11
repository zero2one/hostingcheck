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
 * Validate if the value is a boolean false value.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_False extends Hostingcheck_Validator_Abstract
{
    /**
     * {@inheritDoc}
     */
    public function validate(hostingcheck_Value_Interface $value)
    {
        $messages = array();

        if ($value->getValue() !== false) {
            $messages[] = new Hostingcheck_Message('Value should be false.');
        }

        return count($messages)
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }
}
