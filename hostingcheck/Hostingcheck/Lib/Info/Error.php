<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * The error Info object can be used to add manually an Error to the test.
 *
 * This is used by @link Hostingcheck_Scenario_Parser_Test to put an error in
 * the test results when a part of the scenario could not be parsed or uses not
 * supported class names.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Error extends Hostingcheck_Info_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - error  : The info that should be stored as the value of this object.
     */
    public function __construct($arguments = array())
    {
        // Create the value.
        if (!empty($arguments['error'])) {
            $this->value = new Hostingcheck_Value_Error($arguments['error']);
        }
        else {
            $this->value = new Hostingcheck_Value_Error();
        }
    }
}
