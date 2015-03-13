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
 * View helper to get the css class name out of a Hostingcheck_Result_Interface
 * object.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
 class Hostingcheck_View_ResultCssClass
{
    /**
     * Run the helper.
     *
     * @param array $arguments
     *     The first element should be the Result object.
     *
     * @return string
     */
     public function resultCssClass($arguments)
     {
         $result = array_shift($arguments);
         $className = get_class($result);

         $lastUnderscorePosition = strrpos($className, '_');
         $cssClass = strtolower(substr($className, $lastUnderscorePosition + 1));
         return $cssClass;
     }
}
