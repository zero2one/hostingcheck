<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * View helper to create a full URL based on a given controller action.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_View_Url
{
    /**
     * Run the helper.
     *
     * @param array $arguments
     *     The first parameter should be the action name (do).
     *     The second parameter has the optional extra get parameters.
     *
     * @return string
     */
    public function url($arguments)
    {
        $action = array_shift($arguments);
        $parameters = array_shift($arguments);

        $url = htmlentities(strip_tags($_SERVER['PHP_SELF']));
        $args = array();

        if ($action) {
            $args[] = 'do=' . $action;
        }
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $args[] = $key . '=' . $value;
            }
        }

        if ($args) {
            $url .= '?' . implode('&', $args);
        }

        return $url;
    }
}
