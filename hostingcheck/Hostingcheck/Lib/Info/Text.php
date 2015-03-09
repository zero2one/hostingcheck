<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
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
