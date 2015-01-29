<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Collection of grouped test results.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results implements SeekableIterator, Countable
{
    /**
     * The results collection.
     *
     * @var array
     */
    protected $results;

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
        $this->results = array();
        $this->keys = array();
        $this->rewind();
    }

    /**
     * Add a group results set to the array of groups.
     *
     * @param Hostingcheck_Results_Group $group
     */
    public function add(Hostingcheck_Results_Group $group)
    {
        $key = $group->scenario()->name();
        $this->results[$key] = $group;
        $this->keys = array_keys($this->results);
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
        if (!isset($this->results[$name])) {
            return null;
        }

        return $this->results[$name];
    }
}
