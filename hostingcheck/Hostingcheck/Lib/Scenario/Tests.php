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
class Hostingcheck_Scenario_Tests extends Hostingcheck_Collection_Abstract
{
    /**
     * Add a test scenario to the collection.
     *
     * @param Hostingcheck_Scenario_Test $test
     */
    public function add(Hostingcheck_Scenario_Test $test)
    {
        $this->collection[] = $test;
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Scenario_Test
     */
    public function current() {
        return parent::current();
    }

    /**
     * Get a test scenario by its position in the collection.
     *
     * @param int $position
     *     The position in the collection.
     *
     * @return Hostingcheck_Scenario_Test|null
     *     Returns null if the test does not exists.
     */
    public function seek($position)
    {
        return parent::seek($position);
    }
}
