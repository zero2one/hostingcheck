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
class Hostingcheck_Scenario_Group implements Countable, SeekableIterator
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
     * @var array
     */
    protected $tests = array();

    /**
     * The current position in the iterator array.
     *
     * @var int
     */
    protected $position = 0;


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

        foreach ($tests as $test) {
            // TODO: create the test object and add it to the array.
        }

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
        return $this->tests[$this->position];
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function key() {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function next() {
        ++$this->position;
    }

    /**
     * {@inheritdoc}
     */
    function valid() {
        return isset($this->tests[$this->position]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->tests);
    }

    /**
     * Get the group element by the group name.
     *
     * @param int $position
     *     The position in the tests array.
     *
     * @return Hostingcheck_Scenario_Test|null
     *     Returns null if the test does not exists.
     */
    public function seek($position)
    {
        if (!isset($this->tests[$position])) {
            return null;
        }

        return $this->tests[$position];
    }
}
