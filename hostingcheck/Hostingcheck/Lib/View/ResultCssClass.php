<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
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
