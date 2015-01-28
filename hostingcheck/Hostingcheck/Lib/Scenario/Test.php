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
     * The class name to retrieve the info.
     *
     * @var string
     */
    protected $info;

    /**
     * The optional arguments to retrieve the info.
     *
     * @var array
     */
    protected $arguments;

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
     * @param string $info
     *     The info class name.
     * @param array $arguments
     *     The optional arguments to retrieve the info.
     * @param array $validators
     *     An optional array configuration of validators.
     */
    public function __construct($title, $info, $arguments = array(), $validators = array())
    {
        $this->title = $title;
        $this->info = $info;
        $this->arguments = $arguments;
        $this->validators = new Hostingcheck_Scenario_Validators($validators);
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
     * Get the info class name for this test.
     *
     * @return string
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * Get the arguments to use when retrieving the info.
     *
     * @return array
     */
    public function arguments()
    {
        return $this->arguments;
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
