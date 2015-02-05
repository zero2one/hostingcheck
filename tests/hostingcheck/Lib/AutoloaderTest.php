<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Autoloader class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Autoloader_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor (will adds itself to the autload registry).
     */
    public function testConstruct()
    {
        $autoloader = new Hostingcheck_Autoloader();

        $functions = spl_autoload_functions();
        $registred = false;
        foreach ($functions as $function) {
            if ($function[0] instanceof Hostingcheck_Autoloader) {
                $registred = true;
                break;
            }

            continue;
        }

        $this->assertTrue(true);
    }
}