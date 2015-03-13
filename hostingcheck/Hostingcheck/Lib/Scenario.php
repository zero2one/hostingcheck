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
 * The test scenario.
 *
 * The test scenario needs a scenario array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario extends Hostingcheck_Collection_Keyed
{
    /**
     * Add a group to the scenario.
     *
     * @param Hostingcheck_Scenario_Group $group
     */
    public function add(Hostingcheck_Scenario_Group $group)
    {
        $this->collection[$group->name()] = $group;
        $this->updateKeys();
    }
}
