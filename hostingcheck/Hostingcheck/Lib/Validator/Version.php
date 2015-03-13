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
 * Validate a value number.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_Version extends Hostingcheck_Validator_Compare
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
