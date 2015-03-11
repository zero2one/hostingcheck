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
 *
 * @wip
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
     * @param Hostingcheck_Scenario_Tests $tests
     *     The tests configuration (array of settings).
     */
    public function __construct($name, $title, Hostingcheck_Scenario_Tests $tests)
    {
        $this->name = $name;
        $this->title = $title;
        $this->tests = $tests;
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
