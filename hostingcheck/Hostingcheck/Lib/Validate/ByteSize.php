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
class Hostingcheck_Validate_ByteSize extends Hostingcheck_Validate_Abstract
{
    /**
     * Arguments to use during the validation.
     *
     * @var array
     */
    protected $arguments = array(
        'equal' => null,
        'min' => null,
        'max' => null,
    );


    /**
     * {@inheritDoc}
     */
    public function validate(Hostingcheck_Value_Interface $byte)
    {
        $messages = array();

        $messages[] = $this->isEqual($byte);
        if (empty($this->arguments['equal'])) {
            $messages[] = $this->isMin($byte);
            $messages[] = $this->isMax($byte);
        }

        // If there are messages, the byte is not valid.
        $messages = array_values(array_filter($messages));
        return (count($messages))
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }

    /**
     * Helper to validate if the given byte is the same as the expected..
     *
     * @param Hostingcheck_Value_Byte $byte
     *
     * @return string
     *      Error message if the validation is not ok.
     */
    protected function isEqual(Hostingcheck_Value_Byte $byte)
    {
        $equal = $this->arguments['equal'];
        if (empty($equal)) {
            return;
        }

        $other = new Hostingcheck_Value_Byte($equal);
        if (!$byte->equals($other)) {
            return new Hostingcheck_Message(
                'Byte size is not equal to {size}.',
                array('size' => $equal)
            );
        }
    }

    /**
     * Helper to validate te minimal byte.
     *
     * @param Hostingcheck_Value_Byte $byte
     *
     * @return string
     *      Error message if the validation is not ok.
     */
    protected function isMin(Hostingcheck_Value_Byte $byte)
    {
        $min = $this->arguments['min'];
        if (empty($min)) {
            return;
        }

        $other = new Hostingcheck_Value_Byte($min);
        if (!$byte->greaterThanOrEqual($other)) {
            return new Hostingcheck_Message(
                'Byte size is to low, should be at least {min}.',
                array('min' => $min)
            );
        }
    }

    /**
     * Helper to validate the maximum byte.
     *
     * @param Hostingcheck_Value_Byte $byte
     *
     * @return bool
     *      Result of the comparison.
     */
    protected function isMax(Hostingcheck_Value_Byte $byte)
    {
        $max = $this->arguments['max'];
        if (empty($max)) {
            return;
        }

        $other = new Hostingcheck_Value_Byte($max);
        if (!$byte->lessThanOrEqual($other)) {
            return new Hostingcheck_Message(
                'Byte size is to high, should be at most {max}.',
                array('max' => $max)
            );
        }
    }
}
