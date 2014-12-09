<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
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
     * The value of the result.
     *
     * @var string
     */
    protected $value;

    /**
     * The messages array.
     *
     * @var array
     */
    protected $messages = array();


    /**
     * {@inheritDoc}
     */
    public function __construct($value, $messages = array())
    {
        $this->value = $value;

        if (!empty($messages) && is_array($messages)) {
            $this->messages = $messages;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
