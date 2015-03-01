<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Validate if the value is a boolean true value.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_True extends Hostingcheck_Validate_Abstract
{
    /**
     * {@inheritDoc}
     */
    public function validate(hostingcheck_Value_Interface $value)
    {
        $messages = array();

        if ($value->getValue() !== true) {
            $messages[] = new Hostingcheck_Message('Value should be true.');
        }

        return count($messages)
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }
}
