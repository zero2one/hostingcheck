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
        $url = htmlentities(strip_tags($_SERVER['SCRIPT_NAME']));

        $args = $this->extractArgs($arguments);
        if (!empty($args)) {
            $url .= '?' . implode('&', $args);
        }

        return $url;
    }

    /**
     * Get the args from the arguments.
     *
     * @param array $arguments
     *
     * @return array
     *     Array of GET args (if any).
     */
    protected function extractArgs($arguments)
    {
        $args = array();
        $action = array_shift($arguments);
        $parameters = array_shift($arguments);

        if ($action) {
            $args[] = 'do=' . $action;
        }
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                $args[] = $key . '=' . $value;
            }
        }

        return $args;
    }
}
