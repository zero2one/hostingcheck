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
 * Value that indicates that the requested value is not supported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_NotSupported extends Hostingcheck_Value_Abstract
{
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {
        $string = 'Not Supported';

        $value = (string) $this->getValue();
        if (!empty($value)) {
            $string = $value;
        }

        return $string;
    }
}
