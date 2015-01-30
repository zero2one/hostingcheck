<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * The test scenario.
 *
 * The test scenario needs a scenario array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario implements SeekableIterator, Countable
{
    /**
     * The groups defined in the scenario.
     *
     * @var array
     */
    protected $groups = array();

    /**
     * The group array keys.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * The current position in the group array.
     *
     * @var int
     */
    protected $position = 0;


    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->groups = array();
        $this->keys = array();
        $this->rewind();
    }

    /**
     * Add a group to the scenario.
     *
     * @param Hostingcheck_Scenario_Group $group
     */
    public function add($group)
    {
        $this->groups[$group->name()] = $group;
        $this->keys = array_keys($this->groups);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind() {
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function current() {
        return $this->seek($this->key());
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function key() {
        return $this->keys[$this->position];
    }

    /**
     * {@inheritdoc}
     */
    public function next() {
        $this->position++;
    }

    /**
     * {@inheritdoc}
     */
    function valid() {
        return isset($this->keys[$this->position]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->keys);
    }

    /**
     * Get the group element by the group name.
     *
     * @param string $name
     *     The group name
     *
     * @return Hostingcheck_Scenario_Group|null
     *     Returns null if the group does not exists.
     */
    public function seek($name)
    {
        if (!isset($this->groups[$name])) {
            return null;
        }

        return $this->groups[$name];
    }
}
