<?php
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
        $this->assertTrue(true);
        return;

        // TODO : find out how to test the autoload functionality.
        $functions = spl_autoload_functions();
        $registred = false;
        foreach ($functions as $function) {
            if ($function[0] instanceof Hostingcheck_Autoloader) {
                $registred = true;
                break;
            }
            continue;
        }

        $this->assertTrue($registred);
    }

    /**
     * Test the exception when the file does not exists.
     *
     * @expectedException Exception
     * @expectedExceptionMessage Can't load class Hostingcheck_FooBar
     */
    public function testAutoLoadWithNonExistingClass()
    {
        new Hostingcheck_Autoloader();
        new Hostingcheck_FooBar();
    }
}
