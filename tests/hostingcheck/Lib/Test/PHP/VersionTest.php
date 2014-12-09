<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2005-2014 Serial Graphics. (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Tests for Hostingcheck_Test_PHP_Version test.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Test_PHP_Version_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Check success method.
     */
    public function testRun()
    {
        $config = new Hostingcheck_Config(array());
        $test = new Hostingcheck_Test_PHP_Version($config);

        // Test minimum.
        $args = array('min' => '4.0.0');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result);
        $this->assertEquals(phpversion(), $result->getValue());
        $this->assertEmpty($result->getMessages());

        $args = array('min' => '8.0.0');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $this->assertEquals(phpversion(), $result->getValue());
        $messages = array('PHP version is to low, should be at least 8.0.0.');
        $this->assertEquals($messages, $result->getMessages());

        // Test maximum.
        $args = array('max' => '8.0.0');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result);
        $this->assertEmpty($result->getMessages());

        $args = array('max' => '4.0.0');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = array('PHP version is to high, should be at most 4.0.0.');
        $this->assertEquals($messages, $result->getMessages());

        // Test combination.
        $args = array('min' => '5', 'max' => '8');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Success', $result);
        $this->assertEmpty($result->getMessages());

        $args = array('min' => '8.1', 'max' => '4.2');
        $result = $test->run($args);
        $this->assertInstanceOf('Hostingcheck_Result_Failure', $result);
        $messages = array(
            'PHP version is to low, should be at least 8.1.',
            'PHP version is to high, should be at most 4.2.',
        );
        $this->assertEquals($messages, $result->getMessages());
    }
}
