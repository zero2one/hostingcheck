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
interface Hostingcheck_Info_Interface
{
    /**
     * Constructor.
     *
     * @param array $arguments
     *      The optional arguments needed to retrieve the value.
     */
    public function __construct($arguments = array());

    /**
     * Get the value.
     *
     * @return Hostingcheck_Value_Interface
     */
    public function getValue();
}
