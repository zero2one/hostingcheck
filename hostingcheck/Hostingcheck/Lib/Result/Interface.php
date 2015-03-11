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
    public function messages();

    /**
     * Has the result messages.
     *
     * @return bool
     */
    public function hasMessages();

    /**
     * Add a message to the result.
     *
     * @param Hostingcheck_Message $message
     */
    public function addMessage(Hostingcheck_Message $message);
}
