<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
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
