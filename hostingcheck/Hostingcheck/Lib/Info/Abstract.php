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
