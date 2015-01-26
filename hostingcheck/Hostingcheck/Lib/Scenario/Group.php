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
class Hostingcheck_Scenario_Group
{
    /**
     * The group (machine) name.
     *
     * @var string
     */
    protected $name;

    /**
     * The group (human) title.
     *
     * @var string
     */
    protected $title;

    /**
     * The tests defined in the group.
     *
     * @var Hostingcheck_Scenario_Tests
     */
    protected $tests;

    /**
     * Class constructor.
     *
     * @param string $name
     *     The machine name.
     * @param string $title
     *     The human title for the group.
     * @param array $tests
     *     The tests configuration (array of settings).
     */
    public function __construct($name, $title, $tests)
    {
        $this->name = $name;
        $this->title = $title;
        $this->tests = new Hostingcheck_Scenario_Tests($tests);
    }

    /**
     * Get the machine name of the group.
     *
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the human name (title) of the group.
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * Get the tests collection.
     *
     * @return Hostingcheck_Scenario_Tests
     */
    public function tests()
    {
        return $this->tests;
    }
}
