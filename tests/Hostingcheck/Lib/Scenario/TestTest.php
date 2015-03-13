<?php
/**
 * Tests for Hostingcheck_Scenario_Test class.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Test_TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * Test the constructor.
     */
    public function testConstructor()
    {
        $title = 'Info test';
        $info = new Hostingcheck_Info_Text();
        $validators = new Hostingcheck_Scenario_Validators();
        $tests = new Hostingcheck_Scenario_tests();

        $test = new Hostingcheck_Scenario_Test(
            $title,
            $info,
            $validators,
            $tests
        );

        $this->assertEquals($title, $test->title());
        $this->assertEquals($info, $test->info());
        $this->assertEquals($validators, $test->validators());
        $this->assertEquals($tests, $test->tests());
    }
}
