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
class Check_PHP_Info_Extension_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check get value method.
     */
    public function testGetValue()
    {
        $jsonVersion = phpversion('json');
        $info = new Check_PHP_Info_Extension(array('name' => 'json'));
        $this->assertInstanceOf(
            'Hostingcheck_Value_Version',
            $info->getValue()
        );
        $this->assertEquals($jsonVersion, $info->getValue()->getValue());

        $name = 'foo_bar_fake_extension';
        $value = new Check_PHP_Info_Extension(array('name' => $name));
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );

        $value = new Check_PHP_Info_Extension(array());
        $this->assertInstanceOf(
            'Hostingcheck_Value_NotSupported',
            $value->getValue()
        );
    }
}
