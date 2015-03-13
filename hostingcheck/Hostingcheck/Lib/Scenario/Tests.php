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
