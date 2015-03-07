<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Interface for the parser.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Scenario_Parser_Abstract
{
    /**
     * Services container.
     *
     * @var Hostingcheck_Services $services
     */
    protected $services;


    /**
     * {@inheritDoc}
     */
    public function __construct(Hostingcheck_Services $services)
    {
        $this->services = $services;
    }

    /**
     * Helper to get the full class name.
     *
     * Is a wrapper around the Hostingcheck_Scenario_Parser_ClassName
     *
     * @param string $type
     *     The class type.
     * @param string $name
     *     The short version of the name.
     *
     * @return string
     */
    public function getClassName($type, $name)
    {
        $parser = new Hostingcheck_Scenario_Parser_ClassName();
        return $parser->parse($type, $name);
    }
}
