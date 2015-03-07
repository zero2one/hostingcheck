<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a scenario array to a Scenario object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser {
    /**
     * Services to use when creating the info objects.
     *
     * @var Hostingcheck_Services
     */
    protected $services;


    /**
     * Constructor.
     *
     * @param Hostingcheck_Services $services
     */
    public function __construct($services)
    {
        $this->services = $services;
    }

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
    public function group($name, $config)
    {
        $parser = new Hostingcheck_Scenario_Parser_Group($this->services);
        return $parser->parse($name, $config);
    }

    /**
     * Parse a scenario out of an scenario config.
     *
     * @param array $config
     *     An array containing an array of group config arrays.
     *     Each array item key is the machine name of the group.
     *
     * @return Hostingcheck_Scenario
     */
    public function scenario($config)
    {
        $scenario = new Hostingcheck_Scenario();
        $groupsConfig = array();

        if (!empty($config) && is_array($config)) {
            $groupsConfig = $config;
        }

        foreach ($groupsConfig as $groupName => $groupConfig) {
            $scenario->add($this->group($groupName, $groupConfig));
        }

        return $scenario;
    }

    /**
     * Construct the full class name from the short name.
     *
     * @param string $type
     *     The class type.
     * @param string $className
     *     The short version of the name.
     *
     * @return string
     */
    protected function createClassName($type, $className)
    {
        $parser = new Hostingcheck_Scenario_Parser_ClassName();
        return $parser->parse($type, $className);
    }
}
