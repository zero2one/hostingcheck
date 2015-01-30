<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
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
     * The optional validators to validate the info.
     *
     * @var string
     */
    protected $validators;


    /**
     * Class constructor.
     *
     * @param string $title
     *     The human title for the test.
     * @param Hostingcheck_Info_Interface $info
     *     The info object.
     * @param Hostingcheck_Scenario_Validators
     *     The validators to use in the test.
     */
    public function __construct(
        $title,
        Hostingcheck_Info_Interface $info,
        Hostingcheck_Scenario_Validators $validators
    )
    {
        $this->title = $title;
        $this->info = $info;
        $this->validators = $validators;
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
     * Get the validator to validate the retrieved info.
     *
     * @return Hostingcheck_Scenario_Validators
     */
    public function validators()
    {
        return $this->validators;
    }
}
