<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Validate a value number.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Version extends Hostingcheck_Validate_Compare
{
    /**
     * Helper to validate if the given version is the same as the expected..
     *
     * {@inheritDoc}
     */
    protected function isEqual(Hostingcheck_Value_Interface $value)
    {
        $equal = new Hostingcheck_Value_Version($this->getArgumentEqual());
        if (!$value->equals($equal)) {
            return new Hostingcheck_Message(
                'Version is not equal to {value}.',
                array('value' => $equal)
            );
        }
    }

    /**
     * Helper to validate te minimal version number.
     *
     * {@inheritDoc}
     */
    protected function isMin(Hostingcheck_Value_Interface $value)
    {
        $min = new Hostingcheck_Value_Version($this->getArgumentMinimum());
        if (!$value->greaterThanOrEqual($min)) {
            return new Hostingcheck_Message(
                'Version is to low, should be at least {min}.',
                array('min' => $min)
            );
        }
    }

    /**
     * Helper to validate the maximum version number.
     *
     * {@inheritDoc}
     */
    protected function isMax(Hostingcheck_Value_Interface $value)
    {
        $max = new Hostingcheck_Value_Version($this->getArgumentMaximum());
        if (!$value->lessThanOrEqual($max)) {
            return new Hostingcheck_Message(
                'Version is to high, should be at most {max}.',
                array('max' => $max)
            );
        }
    }
}
