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
