<?php
/**
 * Tests for Hostingcheck_View class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_View_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     *
     * @expectedException Exception
     * @expectedExceptionMessage View scripts path "/fake/path" is not valid.
     */
    public function testConstructorWithFaultPath()
    {
        new Hostingcheck_View('/fake/path');
    }

    /**
     * Test the method to render a single view script.
     */
    public function testRender()
    {
        $path = __DIR__ . '/../Views';
        $view = new Hostingcheck_View($path);

        $vars = array('foo' => 'TEST 123');
        $output = $view->render('script', $vars);
        $this->assertEquals('<p>TEST 123</p>', $output);
    }

    /**
     * Test the method to render a view script within a template file.
     */
    public function testRenderTemplate()
    {
        $path = __DIR__ . '/../Views';
        $view = new Hostingcheck_View($path, 'template');

        $vars = array('foo' => 'TEST 123');
        $output = $view->renderTemplate('script', $vars);
        $this->assertEquals('<div><p>TEST 123</p></div>', $output);

        $output = $view->renderTemplate('script', $vars, 'template-custom');
        $this->assertEquals('<section><p>TEST 123</p></section>', $output);
    }

    /**
     * Test the __call() magic method run helper plugins.
     */
    public function testExistingHelper()
    {
        $path = __DIR__ . '/../Views';
        $view = new Hostingcheck_View($path, 'template');

        $result = new Hostingcheck_Result_Failure();
        $this->assertEquals('failure', $view->resultCssClass($result));
    }
}
