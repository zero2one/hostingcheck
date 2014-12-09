<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * basic implementation of the Test Interface.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Test_Abstract {
    /**
     * The configuration object.
     *
     * @var Hostingcheck_Config
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param Hostingcheck_Config $config
     *      The config object, can be used during test run.
     */
    public function __construct(Hostingcheck_Config $config)
    {
        $this->config = $config;
    }
}
