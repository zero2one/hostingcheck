<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Base service to represent a database based on the PDO extension.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Service_Database extends Hostingcheck_Service_Abstract
{
    /**
     * The DB connection.
     *
     * @var PDO
     */
    protected $connection;


    /**
     * Checks if the service is available by trying to connect to it.
     *
     * @return bool
     */
    public function isAvailable()
    {
        $conn = $this->connection();
        return (!empty($conn));
    }

    /**
     * Get the DB connection.
     *
     * If not connected yet, connect first.
     *
     * @return PDO|false
     */
    public function connection()
    {
        return $this->connect();
    }

    /**
     * Connect to the database.
     *
     * @return PDO|false
     */
    protected function connect()
    {
        if (is_null($this->connection)) {
            try {
                $this->connection = new PDO(
                    $this->config->get('dsn'),
                    $this->config->get('username'),
                    $this->config->get('password'),
                    (array) $this->config->get('options', array())
                );
            }
            catch (PDOException $exception) {
                $this->setErrorFromException($exception);
            }
        }

        return $this->connection;
    }
}
