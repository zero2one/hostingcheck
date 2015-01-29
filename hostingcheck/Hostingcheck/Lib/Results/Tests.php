<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A Seekable collection of tests results.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Tests implements Countable, SeekableIterator
{
    /**
     * The tests in the collection
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
     */
    public function __construct()
    {
        $this->tests = array();
        $this->rewind();
    }

    /**
     * Add a test result to the tests collection.
     *
     * @param Hostingcheck_Results_Test
     */
    public function add(Hostingcheck_Results_Test $test)
    {
        $this->tests[] = $test;
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
     * @return Hostingcheck_Results_Test
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
        $this->position++;
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
