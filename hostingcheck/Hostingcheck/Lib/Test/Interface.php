<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for all test classes.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
interface Hostingcheck_Test_Interface {
    /**
     * Constructor.
     *
     * @param Hostingcheck_Config $config
     *      The config object, can be used during test run.
     */
    public function __construct(Hostingcheck_Config $config);

    /**
     * Run the test.
     *
     * @param array $args
     *      Arguments to use in the test.
     *
     * @return Hostingcheck_Test_Result
     */
    public function run($args = array());
}
