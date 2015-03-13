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
 * Parse a scenario array to a Scenario object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse a scenario out of an scenario config.
     *
     * @param array $config
     *     An array containing an array of group config arrays.
     *     Each array item key is the machine name of the group.
     *
     * @return Hostingcheck_Scenario
     */
    public function parse($config)
    {
        $parser = new Hostingcheck_Scenario_Parser_Group($this->services);

        $scenario = new Hostingcheck_Scenario();
        $groupsConfig = array();

        if (!empty($config) && is_array($config)) {
            $groupsConfig = $config;
        }

        foreach ($groupsConfig as $groupName => $groupConfig) {
            $group = $parser->parse($groupName, $groupConfig);
            $scenario->add($group);
        }

        return $scenario;
    }
}
