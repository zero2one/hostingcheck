<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Test the PHP version number.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_PHP_Version extends Hostingcheck_Test_Abstract
{
    /**
     * Run the test.
     *
     * @param array $args
     *      Arguments to use in the test:
     *      - min : The minimum version to compare with (inclusive).
     *      - max : The maximum version to compare with (inclusive).
     *
     * @return Hostingcheck_Result_Interface
     */
    public function run($args = array())
    {
        $phpVersion = phpversion();
        $messages = array();

        if (!empty($args['min'])
            && version_compare($phpVersion, $args['min']) < 0
        ) {
            $messages[] = sprintf(
                'PHP version is to low, should be at least %s.',
                $args['min']
            );
        }
        if (!empty($args['max'])
            && version_compare($phpVersion, $args['max']) > 0
        ) {
            $messages[] = sprintf(
                'PHP version is to high, should be at most %s.',
                $args['max']
            );
        }

        if (count($messages)) {
            return new Hostingcheck_Result_Failure($phpVersion, $messages);
        }

        return new Hostingcheck_Result_Success($phpVersion);
    }
}