<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Info class that checks if a given table exists in the database.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_MySQL_Info_Table
    extends Hostingcheck_Info_Service_Abstract
{
    /**
     * Database service.
     *
     * @var Hostingcheck_Service_Database
     */
    protected $service;

    /**
     * The table name.
     *
     * @var string
     */
    protected $name;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - service : The database service that should be used to collect the info.
     * - name    : The name of the table we want to check if it exists.
     */
    public function __construct($arguments = array())
    {
        // Set the service.
        parent::__construct($arguments);

        // Set the database name.
        if (empty($arguments['name'])) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }
        $this->name = $arguments['name'];
    }

    /**
     * Helper to extract and create the value.
     */
    protected function collectValue()
    {
        $conn = $this->service()->connection();
        /* @var $conn PDO */

        $stmnt = $conn->prepare('SHOW TABLES LIKE ?');
        $stmnt->execute(array($this->name));

        if ($stmnt->rowCount() === 1) {
            $this->value = new Hostingcheck_Value_Text($this->name);
        }
        else {
            $this->value = new Hostingcheck_Value_NotFound();
        }
    }

    /**
     * Get the service from the info object.
     *
     * @return Hostingcheck_Service_Database
     */
    public function service()
    {
        return $this->service;
    }
}
