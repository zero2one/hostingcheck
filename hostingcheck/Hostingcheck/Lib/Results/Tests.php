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
 * A Seekable collection of tests results.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Results_Tests extends Hostingcheck_Collection_Abstract
{
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
     * Mapping between the Hostingcheck_Result class name and the count keys.
     *
     * @var array
     */
    protected $mapping = array(
        'Hostingcheck_Result_Info' => 'info',
        'Hostingcheck_Result_Success' => 'success',
        'Hostingcheck_Result_Failure' => 'failure',
    );


    /**
     * Add a test result to the tests collection.
     *
     * @param Hostingcheck_Results_Test
     */
    public function add(Hostingcheck_Results_Test $test)
    {
        $this->collection[] = $test;
        $this->updateCount($test);
        $this->updateCountSubs($test);
    }

    /**
     * Add multiple test results at once by passing them in a
     * Hostingcheck_Results_Tests collection.
     *
     * @param Hostingcheck_Results_Tests $tests
     */
    public function addMultiple(Hostingcheck_Results_Tests $tests) {
        foreach ($tests as $test) {
            $this->add($test);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Results_Test
     */
    public function current() {
        return parent::current();
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
        $key = $this->mapping[$type];
        $this->count[$key] = $this->count[$key] + 1;
    }

    /**
     * Helper to update the counts from the subtests of the added test.
     *
     * @param Hostingcheck_Results_test $result
     */
    protected function updateCountSubs(Hostingcheck_Results_Test $result)
    {
        // Add the sub test counts.
        $this->count['info']    += $result->tests()->countInfo();
        $this->count['success'] += $result->tests()->countSuccess();
        $this->count['failure'] += $result->tests()->countFailure();
    }

    /**
     * Get a test result by its position in the collection.
     *
     * @param int $position
     *     The position in the tests array.
     *
     * @return Hostingcheck_Results_Test|null
     *     Returns null if the test does not exists.
     */
    public function seek($position)
    {
        return parent::seek($position);
    }
}
