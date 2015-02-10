<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for objects that can validate one value against another.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Validate_Compare_Interface
{
    /**
     * Helper to validate if the given value is the same as the expected value.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    public function isEqual(Hostingcheck_Value_Interface $value);

    /**
     * Validate if value is greater then or equal to min in the arguments.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    public function isMin(Hostingcheck_Value_Interface $value);

    /**
     * Validate if value is less then or equal to max in the arguments.
     *
     * @param Hostingcheck_Value_Interface $value
     *
     * @return null|Hostingcheck_Message
     *      Error message if the validation is not ok.
     */
    public function isMax(Hostingcheck_Value_Interface $value);
}
