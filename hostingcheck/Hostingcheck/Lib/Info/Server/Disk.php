<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the Server OS information.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Server_Disk extends Hostingcheck_Info_Abstract
{
    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - name : What disk info we want.
     *          Options are:
     *          - free  : Available space.
     *          - used  : Used disk space.
     *          - total : Total disksize.
     * - path : The file path from where the disk size should be calculated.
     *          By default the path where this script is located will be used.
     */
    public function __construct($arguments = array())
    {
        $name = (isset($arguments['name']))
            ? $arguments['name']
            : 'total';

        $path = (isset($arguments['path']))
            ? $arguments['path']
            : dirname(__FILE__);
        if (!file_exists($path) || !is_dir($path)) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        switch ($name) {
            case 'free':
                $size = disk_free_space($path);
                $this->value = new Hostingcheck_Value_Byte($size);
                return;

            case 'used':
                $size = disk_total_space($path) - disk_free_space($path);
                $this->value = new Hostingcheck_Value_Byte($size);
                return;

            case 'total':
                $size = disk_total_space($path);
                $this->value = new Hostingcheck_Value_Byte($size);
                return;

            default:
                $this->value = new Hostingcheck_Value_NotSupported();
                return;
        }
    }
}
