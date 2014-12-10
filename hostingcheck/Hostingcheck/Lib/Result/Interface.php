<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for all result objects.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Result_Interface
{
    /**
     * Constructor.
     *
     * @param array $messages
     *      Optional messages.
     */
    public function __construct($messages = array());

    /**
     * Get the messages (if any).
     *
     * @return array
     *      Array of all messages in the result.
     */
    public function getMessages();
}
