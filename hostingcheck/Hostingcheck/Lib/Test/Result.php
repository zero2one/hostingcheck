<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Result value object of a test.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_Result {
    /**
     * Is the test result positive.
     *
     * @var bool
     */
    protected $success = false;

    /**
     * The test result value.
     *
     * @var string
     */
    protected $value;


    /**
     * Constructor.
     *
     * @param bool $success
     *      The result success status.
     * @param string $value
     *      The result value.
     */
    public function __construct($success, $value)
    {
        $this->success = (bool) $success;
        $this->value = $value;
    }

    /**
     * Is the result successful?
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * Get the result value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
