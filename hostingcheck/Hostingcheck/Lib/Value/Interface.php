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
 * Interface for the value object.
 *
 * The value object is used to retrieve information. That information will be
 * used to be validated or as information in the report.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Value_Interface
{
    /**
     * Constructor.
     *
     * @param mixed $value
     *     The value to use in the value object.
     */
    public function __construct($value = null);

    /**
     * Get the raw value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * To string method in case we want to print the value.
     *
     * @return string
     */
    public function __toString();
}
