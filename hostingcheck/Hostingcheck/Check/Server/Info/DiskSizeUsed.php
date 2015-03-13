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
