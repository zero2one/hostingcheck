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
     * Supported arguments:
     * - date   : The date to use as the value.
     * - format : The date-time format to use to represent as string.
     *            Supported formats :
     *            @link http://php.net/manual/en/function.date.php
     */
    public function __construct($arguments = array())
    {
        // Create the value.
        if (empty($arguments['date'])) {
            $this->value = new DateTime();
        }
        else {
            $this->value = new DateTime($arguments['date']);
        }

        // Set the format to use during the to string method.
        if (!empty($arguments['format'])) {
            $this->format = $arguments['format'];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        return $this->getValue()->format($this->format);
    }
}