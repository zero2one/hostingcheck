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
     * Messages when the validator fails.
     *
     * @var array
     */
    protected $messages = array(
        'equal' => 'Byte size is not equal to {value}.',
        'min' => 'Byte size is to low, should be at least {min}.',
        'max' => 'Byte size is to high, should be at most {max}.',
    );


    /**
     * Get the equal argument.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getArgumentEqual()
    {
        return new Hostingcheck_Value_Byte(
            $this->arguments['equal']
        );
    }

    /**
     * Get the minimum argument.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getArgumentMinimum()
    {
        return new Hostingcheck_Value_Byte(
            $this->arguments['min']
        );
    }

    /**
     * Get the minimum argument.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getArgumentMaximum()
    {
        return new Hostingcheck_Value_Byte(
            $this->arguments['max']
        );
    }
}
