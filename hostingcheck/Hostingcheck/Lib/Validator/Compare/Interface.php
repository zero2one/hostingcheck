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
 * Interface for objects that can validator one value against another.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Validator_Compare_Interface
{
    /**
     * Helper to validator if the given value is the same as the expected value.
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
