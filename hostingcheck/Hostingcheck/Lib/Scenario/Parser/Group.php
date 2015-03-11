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
 * Parse a group of tests out of a scenario config array.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_Group
    extends Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Parse a Group scenario out of a test config.
     *
     * @param string $name
     *     The machine name for the group.
     * @param array $config
     *     The config for a group, this contains:
     *     - title : The human name for the group.
     *     - tests : An optional array of group test configs.
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function parse($name, $config)
    {
        if (empty($config['title'])) {
            $config['title'] = '[NO TITLE]';
        }

        $parser = new Hostingcheck_Scenario_Parser_Tests($this->services);

        $group = new Hostingcheck_Scenario_Group(
            $name,
            $config['title'],
            $parser->parse($config)
        );
        return $group;
    }
}
