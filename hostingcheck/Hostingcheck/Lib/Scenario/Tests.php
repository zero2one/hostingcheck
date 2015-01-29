<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A Seekable collection of tests.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Tests implements Countable, SeekableIterator
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
     *
     * @param array $tests
     *     The tests configuration (array of test settings).
     */
    public function __construct($tests)
    {
        foreach ($tests as $test) {
            if (empty($test['title'])) {
                continue;
            }
            if (empty($test['info'])) {
                continue;
            }

            if (empty($test['info args'])) {
                $test['info args'] = array();
            }
            if (empty($test['validators'])) {
                $test['validators'] = array();
            }

            $this->tests[] = new Hostingcheck_Scenario_Test(
                $test['title'],
                $test['info'],
                $test['info args'],
                $test['validators']
            );
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
     * @return Hostingcheck_Scenario_Test
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
