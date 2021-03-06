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
 * Abstract implementation of the Result interface.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Result_Abstract
    implements Hostingcheck_Result_Interface
{
    /**
     * Array of Hostingcheck_Message() 's.
     *
     * @var array
     */
    protected $messages;


    /**
     * {@inheritDoc}
     */
    public function __construct($messages = array())
    {
        $this->messages = array();
        foreach ($messages as $message) {
            $this->addMessage($message);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function messages()
    {
        return $this->messages;
    }

    /**
     * {@inheritDoc}
     */
    public function hasMessages()
    {
        return (bool) count($this->messages());
    }

    /**
     * {@inheritDoc}
     */
    public function addMessage(Hostingcheck_Message $message)
    {
        $this->messages[] = $message;
    }
}
