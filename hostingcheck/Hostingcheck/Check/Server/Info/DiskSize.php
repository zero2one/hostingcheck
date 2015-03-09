<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the total disk size.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSize extends Check_Server_Info_DiskSize_Abstract
{
    /**
     * Get the total disk size.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getSize()
    {
        $size = disk_total_space($this->path);
        return new Hostingcheck_Value_Byte($size);
    }
}
