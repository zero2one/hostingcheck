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
 * Class Hostingcheck_Config
 *
 * Container to store a configuration array and to get the values from it.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Config
{
    /**
     * The config array.
     * 
     * @var array
     */
    protected $config;
    
    
    /**
     * Constructor.
     *
     * @param array $config
     *      The configuration to use in the configuration class.
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    /**
     * Get a part of the config.
     * 
     * @param string $key
     * @param mixed $default
     *     The default value if key not in config
     * 
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = isset($this->config[$key])
            ? $this->config[$key]
            : $default;

        if (is_array($value)) {
            return new Hostingcheck_Config($value);
        }

        return $value;
    }
}
