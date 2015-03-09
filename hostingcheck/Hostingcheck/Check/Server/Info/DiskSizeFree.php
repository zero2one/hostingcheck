<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the free disk space.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSizeFree extends Check_Server_Info_DiskSize_Abstract
{
    /**
     * Get the free disk space.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getSize()
    {
        $size = disk_free_space($this->path);
        return new Hostingcheck_Value_Byte($size);
    }
}
