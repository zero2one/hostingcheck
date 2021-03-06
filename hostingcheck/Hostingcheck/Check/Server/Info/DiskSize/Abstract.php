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
 * Retrieve Disk size information.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Check_Server_Info_DiskSize_Abstract
    extends Hostingcheck_Info_Abstract
{
    /**
     * File path the information should be collected about.
     *
     * @var string
     */
    protected $path;

    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - path : The file path from where the disk size should be calculated.
     *          By default the path where this script is located will be used.
     */
    public function __construct($arguments = array())
    {
        $this->path = (isset($arguments['path']))
            ? $arguments['path']
            : dirname(__FILE__);
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        if (!is_dir($this->path)) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->value = $this->getSize();
    }

    /**
     * Method to get the actual disk size.
     *
     * @return Hostingcheck_Value_Byte
     */
    abstract protected function getSize();
}
