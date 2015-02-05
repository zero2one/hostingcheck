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
     * Array to keep track of the number of test result types.
     *
     * @var array
     */
    protected $count = array(
        'info' => 0,
        'success' => 0,
        'failure' => 0,
    );


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
        $this->updateCount($test);
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
     * Get the number of tests with info.
     *
     * @return int
     */
    public function countInfo()
    {
        return $this->count['info'];
    }

    /**
     * Get the number of valid tests.
     *
     * @return int
     */
    public function countSuccess()
    {
        return $this->count['success'];
    }

    /**
     * Get the number of failure tests.
     *
     * @return int
     */
    public function countFailure()
    {
        return $this->count['failure'];
    }

    /**
     * Count the number of validations in this collection.
     *
     * @return int
     */
    public function countValidations()
    {
        return $this->countSuccess() + $this->countFailure();
    }

    /**
     * Helper to update the counts when a new test is added.
     *
     * @param Hostingcheck_Results_Test $result
     */
    protected function updateCount(Hostingcheck_Results_Test $result)
    {
        $type = get_class($result->result());

        switch ($type) {
            case 'Hostingcheck_Result_Info':
                $this->count['info']++;
                break;

            case 'Hostingcheck_Result_Success':
                $this->count['success']++;
                break;

            case 'Hostingcheck_Result_Failure':
                $this->count['failure']++;
                break;
        }
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
