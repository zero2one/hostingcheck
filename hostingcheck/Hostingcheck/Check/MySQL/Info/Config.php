<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Info class to get a MySQL config from the variables table.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Check_MySQL_Info_Config
    extends Hostingcheck_Info_Service_Abstract
{
    /**
     * Database service.
     *
     * @var Hostingcheck_Service_Database
     */
    protected $service;

    /**
     * The config key (variables name) we need to collect the data for.
     *
     * @var string
     */
    protected $key;

    /**
     * Format to be used for the value.
     *
     * @var string
     */
    protected $format;


    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - service : The database service that should be used to collect the info.
     * - name    : The name of the config variable we want to collect the
     *             information from.
     */
    public function __construct($arguments = array())
    {
        // Set the service.
        parent::__construct($arguments);

        if (empty($arguments['name'])) {
            $this->value = new Hostingcheck_Value_NotSupported();
            return;
        }

        $this->key = $arguments['name'];
        $this->format = (isset($arguments['format'])
            && class_exists($arguments['format'])
        )
            ? $arguments['format']
            : 'Hostingcheck_Value_Text';
    }

    /**
     * Helper to extract and create the value.
     */
    protected function collectValue()
    {
        $conn = $this->service()->connection();
        /* @var $conn PDO */

        $stmnt = $conn->prepare('SHOW VARIABLES LIKE ?');
        $stmnt->execute(array($this->key));
        $row = $stmnt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $this->value = new Hostingcheck_Value_NotSupported();
        }
        else {
            $value = $row['Value'];
            $this->value = new $this->format($value);
        }
    }
}
