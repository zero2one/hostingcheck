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
abstract class Hostingcheck_Value_Abstract
    implements Hostingcheck_Value_Interface
{
    /**
     * The retrieved value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * {@inheritDoc}
     */
    public function __construct($value = null)
    {
        $this->value = $value;
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
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
