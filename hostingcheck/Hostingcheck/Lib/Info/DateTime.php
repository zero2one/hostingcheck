<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the current Date-Time.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_DateTime extends Hostingcheck_Info_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - date   : The date string (YYYY-MM-DD HH:ii:ss) to use to create the
     *            value. If no date is given, now will be used.
     * - format : The date-time format to use to represent as string.
     *            Supported formats :
     *            @link http://php.net/manual/en/function.date.php
     */
    public function __construct($arguments = array())
    {
        // Create the value.
        if (empty($arguments['date'])) {
            $date = new DateTime();
        }
        else {
            $date = new DateTime($arguments['date']);
        }

        $this->value = new Hostingcheck_Value_DateTime($date);
    }
}
