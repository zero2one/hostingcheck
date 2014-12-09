<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Test to get the current date time.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_DateNow extends Hostingcheck_Test_Abstract
{
    /**
     * Run the test.
     *
     * @param array $args
     *      Arguments to use in the test.
     *
     * @return Hostingcheck_Test_Result
     */
    public function run($args = array())
    {
        $now  = new DateTime();
        $result = new Hostingcheck_Result_Info($now->format('Y-m-d H:i (P)'));
        return $result;
    }
}