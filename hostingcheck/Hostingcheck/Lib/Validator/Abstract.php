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
 * Abstract implementation of the Hostingcheck_Validator_Interface
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
abstract class Hostingcheck_Validator_Abstract
    implements Hostingcheck_Validator_Interface
{
    /**
     * Arguments to use during the validation.
     *
     * @var array
     */
    protected $arguments = array();

    /**
     * {@inheritDoc}
     */
    public function __construct($arguments = array())
    {
        foreach ($arguments as $key => $argument) {
            if (array_key_exists($key, $this->arguments)) {
                $this->arguments[$key] = $argument;
            }
        }
    }
}
