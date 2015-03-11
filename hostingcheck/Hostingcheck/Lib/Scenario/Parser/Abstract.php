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
