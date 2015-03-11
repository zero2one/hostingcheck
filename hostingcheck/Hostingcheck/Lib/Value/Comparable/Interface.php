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
 * A value that has the logic to be compared to another.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Value_Comparable_Interface
{
    /**
     * Compares this Version object to another.
     *
     * Returns an integer less than, equal to, or greater than zero
     * if the value of this Version object is considered to be respectively
     * less than, equal to, or greater than the other Version object.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return integer
     *     -1|0|1
     */
    public function compareTo(Hostingcheck_Value_Interface $other);

    /**
     * Returns TRUE if this Version object equals to another.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return boolean
     */
    public function equals(Hostingcheck_Value_Interface $other);

    /**
     * Returns TRUE if the version value represented by this Version object
     * is greater than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return boolean
     */
    public function greaterThan(Hostingcheck_Value_Interface $other);

    /**
     * Returns TRUE if the version value represented by this Version object
     * is greater than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return boolean
     */
    public function greaterThanOrEqual(Hostingcheck_Value_Interface $other);

    /**
     * Returns TRUE if the version value represented by this Version object
     * is smaller than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return boolean
     */
    public function lessThan(Hostingcheck_Value_Interface $other);

    /**
     * Returns TRUE if the version value represented by this Version object
     * is smaller than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Interface $other
     *
     * @return boolean
     */
    public function lessThanOrEqual(Hostingcheck_Value_Interface $other);
}
