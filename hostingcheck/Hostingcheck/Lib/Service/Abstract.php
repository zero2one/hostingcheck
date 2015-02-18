<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * {@inheritdoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Service_Abstract
    implements Hostingcheck_Service_Interface
{
    /**
     * Config object.
     *
     * @var Hostingcheck_Config
     */
    protected $config;


    /**
     * The constructor accepts only one param: the configuration object.
     *
     * @param Hostingcheck_Config $config
     */
    public function __construct(Hostingcheck_Config $config)
    {
        $this->config = $config;
    }
}
