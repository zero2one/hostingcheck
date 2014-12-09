<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Test to add informational text to the report.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_Info extends Hostingcheck_Test_Abstract
{
    /**
     * Run the test.
     *
     * @param array $args
     *      Arguments to use in the test.
     *      There should be only one argument:
     *      - value : the value to show in the result.
     *
     * @return Hostingcheck_Result_Info
     */
    public function run($args = array())
    {
        $value = empty($args['value'])
            ? null
            : $args['value'];
        $result = new Hostingcheck_Result_Info($value);
        return $result;
    }
}