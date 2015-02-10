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
     * Messages when the validator fails.
     *
     * @var array
     */
    protected $messages = array(
        'equal' => 'Version is not equal to {value}.',
        'min' => 'Version is to low, should be at least {min}.',
        'max' => 'Version is to high, should be at most {max}.',
    );


    /**
     * Get the equal argument.
     *
     * @return Hostingcheck_Value_Version
     */
    protected function getArgumentEqual()
    {
        return new Hostingcheck_Value_Version(
            $this->arguments['equal']
        );
    }

    /**
     * Get the minimum argument.
     *
     * @return Hostingcheck_Value_Version
     */
    protected function getArgumentMinimum()
    {
        return new Hostingcheck_Value_Version(
            $this->arguments['min']
        );
    }

    /**
     * Get the minimum argument.
     *
     * @return Hostingcheck_Value_Version
     */
    protected function getArgumentMaximum()
    {
        return new Hostingcheck_Value_Version(
            $this->arguments['max']
        );
    }
}
