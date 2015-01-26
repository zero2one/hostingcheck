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
    protected $infoArguments;

    /**
     * The optional validator to validate the info.
     *
     * @var string
     */
    protected $validator;

    /**
     * The arguments for the optional validator.
     *
     * @var array
     */
    protected $validatorArguments;


    /**
     * Class constructor.
     *
     * @param string $title
     *     The human title for the test.
     * @param string $info
     *     The info class name.
     * @param array $infoArguments
     *     The optional arguments to retrieve the info.
     * @param string $validator
     *     The optional validator to validate the info.
     * @param array $validatorArguments
     *     The optional arguments for the validator.
     */
    public function __construct(
        $title,
        $info,
        $infoArguments = array(),
        $validator = null,
        $validatorArguments = array()
    )
    {
        $this->title = $title;
        $this->info = $info;
        $this->infoArguments = $infoArguments;
        $this->validator = $validator;
        $this->validatorArguments = $validatorArguments;
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
    public function infoArguments()
    {
        return $this->infoArguments;
    }

    /**
     * Get the validator to validate the retrieved info.
     *
     * @return string
     */
    public function validator()
    {
        return $this->validator;
    }

    /**
     * Get the validator arguments.
     *
     * @return array
     */
    public function validatorArguments()
    {
        return $this->validatorArguments;
    }
}
