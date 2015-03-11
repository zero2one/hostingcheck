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
 * {@inheritdoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Service_Abstract
    implements Hostingcheck_Service_Interface
{
    /**
     * Config object.
     *
     * @var Hostingcheck_Config
     */
    protected $config;

    /**
     * Get the error from the service.
     *
     * @var string
     */
    protected $error;


    /**
     * {@inheritdoc}
     */
    public function __construct(Hostingcheck_Config $config)
    {
        $this->config = $config;
        $this->resetError();
    }

    /**
     * {@inheritdoc}
     */
    public function hasError()
    {
        $error = $this->getError();
        return !empty($error);
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Set an error from an string.
     *
     * @param string $error
     */
    protected function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Helper to set the last error message.
     *
     * @param Exception $exception
     */
    protected function setErrorFromException(Exception $exception)
    {
        $this->setError($exception->getMessage());
    }

    /**
     * Helper to reset the last error message.
     */
    protected function resetError()
    {
        $this->error = null;
    }
}
