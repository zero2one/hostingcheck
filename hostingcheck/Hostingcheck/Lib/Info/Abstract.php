<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Abstract implementation of the value object.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Info_Abstract
    implements Hostingcheck_Info_Interface
{
    /**
     * {@inheritDoc}
     */
    protected $value;


    /**
     * {@inheritDoc}
     */
    public function getValue()
    {
        if (!($this->value instanceof Hostingcheck_Value_Interface)) {
            $this->collectValue();
        }
        return $this->value;
    }

    /**
     * Helper to extract and create the value.
     *
     * Will only be called the first time the getValue() method is called.
     */
    abstract protected function collectValue();
}
