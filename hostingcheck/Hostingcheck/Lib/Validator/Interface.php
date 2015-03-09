<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for the validators.
 *
 * The value object is used to retrieve information. That information will be
 * used to be validated or as information in the report.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Validator_Interface
{
    /**
     * Constructor.
     *
     * @param array $arguments
     *      The optional arguments needed to validator.
     */
    public function __construct($arguments = array());

    /**
     * Validate a given value.
     *
     * @param Hostingcheck_Value_Interface $value
     *      The value to validator.
     *
     * @return Hostingcheck_Result_Interface
     */
    public function validate(Hostingcheck_Value_Interface $value);
}
