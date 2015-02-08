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
class Hostingcheck_Results extends Hostingcheck_Collection_Abstract
{
    /**
     * The group array keys.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * Counts of all the test result types in this result set.
     *
     * @var array
     */
    protected $countTests = array(
        'info' => 0,
        'success' => 0,
        'failure' => 0,
    );


    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->keys = array();
        parent::__construct();
    }

    /**
     * Add a group results set to the array of groups.
     *
     * @param Hostingcheck_Results_Group $group
     */
    public function add(Hostingcheck_Results_Group $group)
    {
        $key = $group->scenario()->name();
        $this->collection[$key] = $group;
        $this->keys = array_keys($this->collection);

        $this->updateCount($group);
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
     * Get the total count of tests that are info.
     *
     * @return int
     */
    public function countTestsInfo()
    {
        return $this->countTests['info'];
    }

    /**
     * Get the total count of tests that are a success.
     *
     * @return int
     */
    public function countTestsSuccess()
    {
        return $this->countTests['success'];
    }

    /**
     * Get the total count of tests that are a failure.
     *
     * @return int
     */
    public function countTestsFailure()
    {
        return $this->countTests['failure'];
    }

    /**
     * Test the total amount of validations performed on the collected info.
     */
    public function countTestsValidations()
    {
        return $this->countTestsSuccess() + $this->countTestsFailure();
    }

    /**
     * Count the total amount of tests.
     *
     * @return int
     */
    public function countTests()
    {
        return array_sum($this->countTests);
    }

    /**
     * Update the counts by getting the counts of the added group.
     *
     * @param Hostingcheck_Results_Group $group
     */
    protected function updateCount(Hostingcheck_Results_Group $group)
    {
        $this->countTests['info'] += $group->tests()->countInfo();
        $this->countTests['success'] += $group->tests()->countSuccess();
        $this->countTests['failure'] += $group->tests()->countFailure();
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
        if (!isset($this->collection[$name])) {
            return null;
        }

        return $this->collection[$name];
    }
}
