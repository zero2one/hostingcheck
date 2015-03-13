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
 * Retrieve the current Date-Time or the date passed as argument.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_DateTime extends Hostingcheck_Info_Abstract
{
    /**
     * The date string to create the date from.
     *
     * @pvar string
     */
    protected $dateString;

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
        $this->dateString = (empty($arguments['date']))
            ? 'now'
            : $arguments['date'];
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        $date = new DateTime($this->dateString);
        $this->value = new Hostingcheck_Value_DateTime($date);
    }
}
