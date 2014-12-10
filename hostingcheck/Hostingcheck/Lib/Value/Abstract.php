<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Abstract implemntation of the value object.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Value_Abstract
    implements Hostingcheck_Value_Interface
{
    /**
     * The retrieved value.
     *
     * @var mixed
     */
    protected $value;


    /**
     * Retrieve the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * To string method in case we want to print the result.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
