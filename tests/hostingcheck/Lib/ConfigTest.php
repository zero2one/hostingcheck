<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Config class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Config_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test retrieving the data from the config.
     */
    public function testGet()
    {
        $configArray = array(
            'test1' => 'test 12345',
            'test2' => array(
                'test2.1', 'test2.2'
            ),
            'test3' => null,
            'test4' => 0,
            'test5' => '',
        );
        $config = new Hostingcheck_Config($configArray);

        // Default non existing.
        $this->assertNull($config->get('foo'));

        // With non-array default.
        $default = 'baz';
        $this->assertEquals($default, $config->get('foo', $default));

        // With array default.
        $defaultArray = array($default);
        $foo = $config->get('foo', $defaultArray);
        $this->assertInstanceOf('Hostingcheck_Config', $foo);
        $this->assertEquals(
            $default,
            $config->get('foo', $defaultArray)
                   ->get(0)
        );

        // Different values.
        $this->assertEquals($configArray['test1'], $config->get('test1'));

        $test2 = $config->get('test2');
        $this->assertInstanceOf('Hostingcheck_Config', $test2);

        $this->assertEquals($configArray['test2'][0], $test2->get(0));
        $this->assertEquals($configArray['test2'][1], $test2->get(1));

        // Empty like values.
        $this->assertEquals($configArray['test3'], $config->get('test3'));
        $this->assertEquals($configArray['test4'], $config->get('test4'));
        $this->assertEquals($configArray['test5'], $config->get('test5'));
    }
}
