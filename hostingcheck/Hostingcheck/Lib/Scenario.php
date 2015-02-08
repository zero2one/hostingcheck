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
class Hostingcheck_Scenario extends Hostingcheck_Collection_Abstract
{
    /**
     * The group array keys.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->keys = array();
        parent::__construct();
    }

    /**
     * Add a group to the scenario.
     *
     * @param Hostingcheck_Scenario_Group $group
     */
    public function add($group)
    {
        $this->collection[$group->name()] = $group;
        $this->keys = array_keys($this->collection);
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
    function valid() {
        return isset($this->keys[$this->position]);
    }

    /**
     * Get the group scenario by its name.
     *
     * @param string $name
     *     The group name
     *
     * @return Hostingcheck_Scenario_Group|null
     *     Returns null if the group does not exists.
     */
    public function seek($name)
    {
        if (!isset($this->collection[$name])) {
            return null;
        }

        return $this->collection[$name];
    }
}
