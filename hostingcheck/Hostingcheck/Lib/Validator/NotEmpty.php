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
 * Validate if the value is not empty.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_NotEmpty extends Hostingcheck_Validator_Abstract
{
    /**
     * {@inheritDoc}
     */
    public function validate(hostingcheck_Value_Interface $value)
    {
        $messages = array();
        $messages[] = $this->isNotSupported($value);
        $messages[] = $this->isNotFound($value);
        $messages[] = $this->isEmpty($value);

        $messages = array_values(array_filter($messages));
        return count($messages)
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }

    /**
     * Check if the value is not a NotSupported value.
     *
     * @param Hostingcheck_Value_Interface $value
     *      The value we need to validator.
     *
     * @return null|string
     *      Message if not supported.
     */
    protected function isNotSupported(Hostingcheck_Value_Interface $value)
    {
        if ($value instanceof Hostingcheck_Value_NotSupported
            || $value->getValue() instanceof Hostingcheck_Value_NotSupported
        ) {
            return new Hostingcheck_Message('Value is not supported.');
        }
    }

    /**
     * Check if the value is not a NotFound value.
     *
     * @param Hostingcheck_Value_Interface $value
     *      The value we need to validator.
     *
     * @return null|string
     *      Message if not supported.
     */
    protected function isNotFound(Hostingcheck_Value_Interface $value)
    {
        if ($value instanceof Hostingcheck_Value_NotFound
            || $value->getValue() instanceof Hostingcheck_Value_NotFound
        ) {
            return new Hostingcheck_Message('Value is not found.');
        }
    }

    /**
     * Check if empty value.
     *
     * @param Hostingcheck_Value_Interface $value
     *      The value we need to validator.
     *
     * @return null|string
     *      Message if not supported.
     */
    protected function isEmpty(Hostingcheck_Value_Interface $value)
    {
        $valueValue = $value->getValue();

        if (empty($valueValue)) {
            return new Hostingcheck_Message('Value is empty.');
        }
    }
}
