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
     *
     * @param array $scenario
     *     The scenario config array to use for this object.
     */
    public function __construct($scenario)
    {
        foreach ($scenario as $name => $info) {
            if (empty($info['title'])) {
                continue;
            }
            if (empty($info['tests'])) {
                continue;
            }

            $this->groups[$name] = new Hostingcheck_Scenario_Group(
                $name,
                $info['title'],
                $info['tests']
            );
        }

        $this->keys = array_keys($this->groups);
        $this->rewind();
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
