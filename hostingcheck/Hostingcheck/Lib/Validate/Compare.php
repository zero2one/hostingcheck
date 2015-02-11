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
class Hostingcheck_Validate_Compare
    extends Hostingcheck_Validate_Abstract
    implements Hostingcheck_Validate_Compare_Interface
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
     * Messages when the validator fails.
     *
     * @var array
     */
    protected $messages = array(
        'equal' => 'Value is not equal to {value}.',
        'min' => 'Value should be at least {min}.',
        'max' => 'Value should be at most {max}.',
    );


    /**
     * {@inheritDoc}
     */
    public function validate(Hostingcheck_Value_Interface $value)
    {
        $messages = array();

        // If we have an equal value, don't bother validating min/max.
        if ($this->hasArgumentEqual()) {
            $messages[] = $this->isEqual($value);
            return $this->createResult($messages);
        }

        if ($this->hasArgumentMinimum()) {
            $messages[] = $this->isMin($value);
        }
        if ($this->hasArgumentMaximum()) {
            $messages[] = $this->isMax($value);
        }

        return $this->createResult($messages);
    }

    /**
     * Create the result based on the number of messages.
     *
     * If no messages => success.
     * If messages => failure.
     *
     * @param array $messages
     *     Array of all collected messages.
     *
     * @return Hostingcheck_Result_Interface
     */
    protected function createResult($messages)
    {
        $messages = array_values(array_filter($messages));
        return (count($messages))
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }

    /**
     * {@inheritDoc}
     */
    public function isEqual(Hostingcheck_Value_Interface $value)
    {
        $equal = $this->getArgumentEqual();
        if (!$equal->equals($value)) {
            return new Hostingcheck_Message(
                $this->messages['equal'],
                array('value' => $equal)
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isMin(Hostingcheck_Value_Interface $value)
    {
        $min = $this->getArgumentMinimum();
        if (!$min->lessThanOrEqual($value)) {
            return new Hostingcheck_Message(
                $this->messages['min'],
                array('min' => $min)
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    public function isMax(Hostingcheck_Value_Interface $value)
    {
        $max = $this->getArgumentMaximum();
        if (!$max->greaterThanOrEqual($value)) {
            return new Hostingcheck_Message(
                $this->messages['max'],
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
     * @return Hostingcheck_Value_Comparable
     */
    protected function getArgumentEqual()
    {
        return new Hostingcheck_Value_Comparable(
            $this->arguments['equal']
        );
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
     * @return Hostingcheck_Value_Comparable
     */
    protected function getArgumentMinimum()
    {
        return new Hostingcheck_Value_Comparable(
            $this->arguments['min']
        );
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
     * @return Hostingcheck_Value_Comparable
     */
    protected function getArgumentMaximum()
    {
        return new Hostingcheck_Value_Comparable(
            $this->arguments['max']
        );
    }
}
