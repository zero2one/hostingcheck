<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Info class to get the MySQL version.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_MySQL_Info_Version
    extends Hostingcheck_Info_Service_Abstract
{
    /**
     * Helper to extract and create the value.
     *
     * Will get "available" if the service is available.
     * Wil use the error message from the service if it is not available.
     */
    protected function collectValue()
    {
        $conn = $this->service()->connection();
        /* @var $conn PDO */

        $stmnt = $conn->prepare('SELECT VERSION() AS MYSQL_VERSION');
        $stmnt->execute();
        $row = $stmnt->fetch(PDO::FETCH_ASSOC);

        preg_match('/^[0-9.]*/', $row['MYSQL_VERSION'], $matches);
        $this->value = new Hostingcheck_Value_Version($matches[0]);
    }
}
