<?php
/**
 * Tests for Hostingcheck_View_TestCssClass helper class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_View_TestCssClass_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test helper to get the result className.
     */
    public function testTestCssClass()
    {
        $helper = new Hostingcheck_View_ResultCssClass();

        $result = new Hostingcheck_Result_Info();
        $this->assertEquals('info', $helper->resultCssClass(array($result)));

        $result = new Hostingcheck_Result_Failure();
        $this->assertEquals('failure', $helper->resultCssClass(array($result)));

        $result = new Hostingcheck_Result_Success();
        $this->assertEquals('success', $helper->resultCssClass(array($result)));
    }
}
