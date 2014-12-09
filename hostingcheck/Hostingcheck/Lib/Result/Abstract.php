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
     * Constructor.
     *
     * @param string $value
     *      The value of the result.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     *      The result value of the test.
     */
    public function getValue()
    {
        return $this->value;
    }
}
