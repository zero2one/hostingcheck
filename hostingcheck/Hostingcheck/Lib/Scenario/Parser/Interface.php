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
interface Hostingcheck_Scenario_Parser_Interface
{
    /**
     * Construct the parser by passing the services container.
     *
     * @param Hostingcheck_Services $services
     */
    public function __construct(Hostingcheck_Services $services);
}
