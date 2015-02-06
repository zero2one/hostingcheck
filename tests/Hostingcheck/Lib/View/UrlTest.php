<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_View_TestCssClass helper class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_View_Url_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test helper to create an URL based on action.
     */
    public function testUrlWithoutArguments()
    {
        $_SERVER['PHP_SELF'] = 'http://foobar.com';
        $helper = new Hostingcheck_View_Url();

        $arguments = array(
            'fooAction',
        );
        $this->assertEquals(
            'http://foobar.com?do=fooAction',
            $helper->url($arguments)
        );
    }

    /**
     * Test helper to create an URL based on action and parameters.
     */
    public function testUrlWithArguments()
    {
        $_SERVER['PHP_SELF'] = 'http://foobar.com';
        $helper = new Hostingcheck_View_Url();

        $arguments = array(
            'fooAction',
            array(
                'test1' => 1,
                'test2' => 2,
            )
        );
        $this->assertEquals(
            'http://foobar.com?do=fooAction&test1=1&test2=2',
            $helper->url($arguments)
        );
    }
}
