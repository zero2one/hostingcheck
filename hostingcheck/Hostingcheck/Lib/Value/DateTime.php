<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Value that indicates that the requested value is not supported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_DateTime extends Hostingcheck_Value_Abstract
{
    /**
     * Format used to represent the date as a string.
     *
     * @var string
     */
    protected $format = 'Y-m-d H:i (P)';

    /**
     * {@inheritDoc}
     *
     * @return DateTime
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Helper to set the desired date format.
     *
     * @param string $format
     *      Any DateFormat supported format.
     *
     * @return Hostingcheck_Value_DateTime
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * Return the string version of the DateTime
     */
    public function __toString()
    {
        return $this->getValue()->format($this->format);
    }
}
