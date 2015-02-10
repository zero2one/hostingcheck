<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Abstract validator to compare a value against another value.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Compare extends Hostingcheck_Validate_Abstract
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
    public function validate(Hostingcheck_Value_Interface $value)
    {
        $messages = array();

        if ($this->hasArgumentEqual()) {
            $messages[] = $this->isEqual($value);
        }
        else {
            if ($this->hasArgumentMinimum()) {
                $messages[] = $this->isMin($value);
            }
            if ($this->hasArgumentMaximum()) {
                $messages[] = $this->isMax($value);
            }
        }

        // If there are messages, the byte is not valid.
        $messages = array_values(array_filter($messages));
        return (count($messages))
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }

    /**
     * Helper to validate if the given value is the same as the expected value.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    protected function isEqual(Hostingcheck_Value_Interface $value)
    {
        $equal = $this->getArgumentEqual();
        if ($value->getValue() != $equal) {
            return new Hostingcheck_Message(
                'Value is not equal to {size}.',
                array('size' => $equal)
            );
        }
    }

    /**
     * Validate if value is greater then or equal to min in the arguments.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    protected function isMin(Hostingcheck_Value_Interface $value)
    {
        $min = $this->getArgumentMinimum();
        if ($value->getValue() < $min) {
            return new Hostingcheck_Message(
                'Value should be at least {min}.',
                array('min' => $min)
            );
        }
    }

    /**
     * Validate if value is less then or equal to max in the arguments.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    protected function isMax(Hostingcheck_Value_Interface $value)
    {
        $max = $this->getArgumentMaximum();
        if ($value->getValue() > $max) {
            return new Hostingcheck_Message(
                'Value should be at most {max}.',
                array('max' => $max)
            );
        }
    }

    /**
     * Determine if there is an equal argument set.
     *
     * @return bool
     */
    protected function hasArgumentEqual()
    {
        return !empty($this->arguments['equal']);
    }

    /**
     * Get the equal argument.
     *
     * @return mixed
     */
    protected function getArgumentEqual()
    {
        return $this->arguments['equal'];
    }

    /**
     * Determine if there is a minimum argument set.
     *
     * @return bool
     */
    protected function hasArgumentMinimum()
    {
        return !empty($this->arguments['min']);
    }

    /**
     * Get the minimum argument.
     *
     * @return mixed
     */
    protected function getArgumentMinimum()
    {
        return $this->arguments['min'];
    }

    /**
     * Determine if there is a maximum argument set.
     *
     * @return bool
     */
    protected function hasArgumentMaximum()
    {
        return !empty($this->arguments['max']);
    }

    /**
     * Get the minimum argument.
     *
     * @return mixed
     */
    protected function getArgumentMaximum()
    {
        return $this->arguments['max'];
    }
}
