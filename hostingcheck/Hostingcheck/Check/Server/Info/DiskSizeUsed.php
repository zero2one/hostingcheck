<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Retrieve the disk size that is in use.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_Server_Info_DiskSizeUsed extends Check_Server_Info_DiskSize_Abstract
{
    /**
     * Get the used disk space.
     *
     * @return Hostingcheck_Value_Byte
     */
    protected function getSize()
    {
        $total = disk_total_space($this->path);
        $free = disk_free_space($this->path);
        $used = $total - $free;
        return new Hostingcheck_Value_Byte($used);
    }
}
