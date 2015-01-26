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
     *     The tests configuration (array of settings).
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

            $infoArgs = !empty($test['info args'])
                ? $test['info args']
                : array();
            $validator = !empty($test['validator'])
                ? $test['validator']
                : null;
            $validatorArgs = !empty($test['validator args'])
                ? $test['validator args']
                : null;

            $this->tests[] = new Hostingcheck_Scenario_Test(
                $test['title'],
                $test['info'],
                $infoArgs,
                $validator,
                $validatorArgs
            );
        }

        $this->rewind();
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
