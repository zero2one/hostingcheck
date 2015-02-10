<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Validate a byte size.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_ByteSize extends Hostingcheck_Validate_Compare
{
    /**
     * Helper to validate if the given byte is the same as the expected..
     *
     * {@inheritDoc}
     */
    protected function isEqual(Hostingcheck_Value_Interface $value)
    {
        $equal = new Hostingcheck_Value_Byte($this->getArgumentEqual());
        if (!$value->equals($equal)) {
            return new Hostingcheck_Message(
                'Byte size is not equal to {size}.',
                array('size' => $equal)
            );
        }
    }

    /**
     * Helper to validate the minimal byte size.
     *
     * {@inheritDoc}
     */
    protected function isMin(Hostingcheck_Value_Interface $value)
    {
        $min = new Hostingcheck_Value_Byte($this->getArgumentMinimum());
        if (!$value->greaterThanOrEqual($min)) {
            return new Hostingcheck_Message(
                'Byte size is to low, should be at least {min}.',
                array('min' => $min)
            );
        }
    }

    /**
     * Helper to validate the maximum byte size.
     *
     * {@inheritDoc}
     */
    protected function isMax(Hostingcheck_Value_Interface $value)
    {
        $max = new Hostingcheck_Value_Byte($this->getArgumentMaximum());
        if (!$value->lessThanOrEqual($max)) {
            return new Hostingcheck_Message(
                'Byte size is to high, should be at most {max}.',
                array('max' => $max)
            );
        }
    }
}
