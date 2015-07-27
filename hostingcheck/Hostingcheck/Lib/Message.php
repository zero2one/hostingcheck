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
 * A Message containing the message string and optional parameters.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Message
{
    /**
     * The message string.
     *
     * @var string
     */
    protected $message;

    /**
     * The message parameters.
     *
     * They will be used to replace placeholders in the message string.
     *
     * @var array
     */
    protected $parameters = array();


    /**
     * Create a new message.
     *
     * The constructor has a message an optional parameters to be used in the
     * message string.
     * Create a parametrised string by putting every variable between {}.
     *
     * Example:
     * <code>
     * $message = 'There are {count} messages for {user}.';
     * $parameters = array('count' => 5, 'user' => 'John Doe');
     *
     * $message = new Hostingcheck_Message($message, $parameters);
     * </code>
     *
     * @param string $message
     *     The message string.
     * @param array $parameters
     *     Optional parameters to use in the message string.
     */
    public function __construct($message, $parameters = array())
    {
        $this->message = $message;
        if (!empty($parameters) && is_array($parameters)) {
            $this->parameters = $parameters;
        }
    }

    /**
     * Get the message string filled with the parameters.
     *
     * @return string
     */
    public function message()
    {
        if (empty($this->parameters)) {
            $message = $this->message;
        }
        else {
            $message = $this->messageFilled();
        }

        return $message;
    }

    /**
     * To string method.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->message();
    }

    /**
     * Helper to get the message filled with the parameters.
     *
     * @return string
     */
    protected function messageFilled()
    {
        $search = array();
        $replace = array();

        foreach ($this->parameters as $key => $value) {
            $search[] = '#{' . $key . '}#';
            $replace[] = (string) $value;
        }

        return preg_replace($search, $replace, $this->message);
    }
}
