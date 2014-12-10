<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Value_PHP_Extension.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_PHP_Extension_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $jsonVersion = phpversion('json');
        $value = new Hostingcheck_Value_PHP_Extension(array('name' => 'json'));
        $this->assertEquals($jsonVersion, $value->getValue());

        $name = 'foo_bar_fake_extension';
        $value = new Hostingcheck_Value_PHP_Extension(array('name' => $name));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );

        $value = new Hostingcheck_Value_PHP_Extension(array());
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );
    }
}
