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
class Hostingcheck_Value_Version extends Hostingcheck_Value_Abstract
{
    /**
     * Compares this Version object to another.
     *
     * Returns an integer less than, equal to, or greater than zero
     * if the value of this Version object is considered to be respectively
     * less than, equal to, or greater than the other Version object.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return integer
     *     -1|0|1
     */
    public function compareTo(Hostingcheck_Value_Version $other)
    {
        return version_compare($this->getValue(), $other->getValue());
    }

    /**
     * Returns TRUE if this Version object equals to another.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return boolean
     */
    public function equals(Hostingcheck_Value_Version $other)
    {
        return $this->compareTo($other) == 0;
    }

    /**
     * Returns TRUE if the version value represented by this Version object
     * is greater than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return boolean
     */
    public function greaterThan(Hostingcheck_Value_Version $other)
    {
        return $this->compareTo($other) == 1;
    }

    /**
     * Returns TRUE if the version value represented by this Version object
     * is greater than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return boolean
     */
    public function greaterThanOrEqual(Hostingcheck_Value_Version $other)
    {
        return $this->greaterThan($other) || $this->equals($other);
    }

    /**
     * Returns TRUE if the version value represented by this Version object
     * is smaller than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return boolean
     */
    public function lessThan(Hostingcheck_Value_Version $other)
    {
        return $this->compareTo($other) == -1;
    }

    /**
     * Returns TRUE if the version value represented by this Version object
     * is smaller than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Version $other
     *
     * @return boolean
     */
    public function lessThanOrEqual(Hostingcheck_Value_Version $other)
    {
        return $this->lessThan($other) || $this->equals($other);
    }
}
