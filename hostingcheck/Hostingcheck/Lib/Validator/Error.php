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
 * This validator will always return a failure.
 *
 * Can be used to add a forced error to the result set.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validator_Error extends Hostingcheck_Validator_Abstract
{
    /**
     * Arguments to use during the validation.
     *
     * @var array
     */
    protected $arguments = array(
        'message' => 'An Error occurred.',
    );

    /**
     * {@inheritDoc}
     */
    public function validate(hostingcheck_Value_Interface $value)
    {
        $messages = array(
            new Hostingcheck_Message($this->arguments['message'])
        );
        return new Hostingcheck_Result_Failure($messages);
    }
}
