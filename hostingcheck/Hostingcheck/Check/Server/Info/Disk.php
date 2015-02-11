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
class Check_Server_Info_Disk extends Hostingcheck_Info_Abstract
{
    /**
     * Type of disk information that will be collected.
     *
     * @var string
     */
    protected $type = 'total';

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
        if (isset($arguments['name'])) {
            $this->type = $arguments['name'];
        }

        $this->path = (isset($arguments['path']))
            ? $arguments['path']
            : dirname(__FILE__);
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        if (!file_exists($this->path) || !is_dir($this->path)) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        switch ($this->type) {
            case 'total':
                $this->value = $this->spaceTotal();
                return;

            case 'free':
                $this->value = $this->spaceFree();
                return;

            case 'used':
                $this->value = $this->spaceUsed();
                return;

            default:
                $this->value = new Hostingcheck_Value_NotSupported();
                return;
        }
    }

    /**
     * Get the total disk size.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function spaceTotal()
    {
        $size = disk_total_space($this->path);
        return new Hostingcheck_Value_Byte($size);
    }

    /**
     * Get the free disk space.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function spaceFree()
    {
        $size = disk_free_space($this->path);
        return new Hostingcheck_Value_Byte($size);
    }

    /**
     * Get the used disk space.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function spaceUsed()
    {
        $total = $this->spaceTotal();
        $free = $this->spaceFree();
        $used = $total->getValue() - $free->getValue();
        return new Hostingcheck_Value_Byte($used);
    }
}
