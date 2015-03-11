<?php
/**
 * This file is part of Hostingcheck.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2015 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/MIT
 */


/**
 * A group of tests.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Test
{
    /**
     * The test Title.
     *
     * @var string
     */
    protected $title;

    /**
     * The info object.
     *
     * @var Hostingcheck_Info_Interface
     */
    protected $info;

    /**
     * The optional validators to validator the info.
     *
     * @var Hostingcheck_Scenario_Validators
     */
    protected $validators;

    /**
     * Optional set of nested tests that will only run if the parent test is
     * not failed.
     *
     * @var Hostingcheck_Scenario_Tests
     */
    protected $tests;


    /**
     * Class constructor.
     *
     * @param string $title
     *     The human title for the test.
     * @param Hostingcheck_Info_Interface $info
     *     The info object.
     * @param Hostingcheck_Scenario_Validators $validators
     *     The validators to use in the test.
     * @param Hostingcheck_Scenario_Tests $tests
     *     A test can have a nested set of tests.
     *     These tests are only run if this test is failed.
     */
    public function __construct(
        $title,
        Hostingcheck_Info_Interface $info,
        Hostingcheck_Scenario_Validators $validators,
        Hostingcheck_Scenario_Tests $tests
    )
    {
        $this->title = $title;
        $this->info = $info;
        $this->validators = $validators;
        $this->tests = $tests;
    }

    /**
     * Get the title of this test.
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * Get the info object for this test.
     *
     * @return Hostingcheck_Info_Interface
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * Get the validator to validator the retrieved info.
     *
     * @return Hostingcheck_Scenario_Validators
     */
    public function validators()
    {
        return $this->validators;
    }

    /**
     * Get the tests that are nested within the test.
     *
     * @return Hostingcheck_Scenario_Tests
     */
    public function tests()
    {
        return $this->tests;
    }
}
