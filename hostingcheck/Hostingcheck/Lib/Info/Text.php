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
 * Simple value container.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Info_Text extends Hostingcheck_Info_Abstract
{
    /**
     * The text to create the value from.
     *
     * @var string
     */
    protected $textString;

    /**
     * {@inheritDoc}
     *
     * Supported arguments:
     * - text  : The info that should be stored as the value of this object.
     */
    public function __construct($arguments = array())
    {
        if (!empty($arguments['text'])) {
            $this->textString = $arguments['text'];
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function collectValue()
    {
        $this->value = new Hostingcheck_Value_Text($this->textString);
    }
}
