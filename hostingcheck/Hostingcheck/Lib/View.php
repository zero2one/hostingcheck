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
 * Class Hostingcheck_View
 *
 * View script renderer.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_View
{
    /**
     * The base path where all view scripts are located.
     *
     * @var string
     */
    protected $path;

    /**
     * The optional template script name that should be used to render the
     * content in.
     *
     * @var string
     */
    protected $template;


    /**
     * Class constructor.
     *
     * @param string $path
     *      Base path where all the views are located.
     * @param string $template
     *      The optional template script name that should be used to render the
     *      content in.
     *
     * @throws Exception
     *      If the base path does not exists.
     */
    public function __construct($path, $template = null)
    {
        if (!file_exists($path)) {
            throw new Exception(
                sprintf(
                    'View scripts path "%s" is not valid.',
                    $path
                )
            );
        }
        $this->path = $path;
        $this->template = $template;
    }

    /**
     * Render html output.
     *
     * @param string $script
     *      The filename (without the .phtml extention) of the view script to
     *      render.
     * @param array $vars
     *     The variables to use in the template.
     *     The variable key will be used as the variable name in the template.
     *
     * @return string
     *      The rendered output.
     */
    public function render($script, $vars = array())
    {
        // Create full path to the view script.
        $file = $this->path . DIRECTORY_SEPARATOR . $script . '.phtml';

        // Extract the set script variables so we can use them.
        extract($vars);

        // Render and capture the output.
        ob_start();
            include($file);
            $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

    /**
     * Render html output within the template.
     *
     * @param string $script
     *      The filename (without the .phtml extention) of the view script to
     *      render.
     * @param array $vars
     *     The variables to use in the template.
     *     The variable key will be used as the variable name in the template.
     * @param string $template
     *      (optional) template to use. If no template is provided, the view
     *      template (if any) will be used.
     *
     * @return string
     *      The rendered output.
     */
    public function renderTemplate($script, $vars = array(), $template = null)
    {
        // Render the content first.
        $output = $this->render($script, $vars);

        // Render the content within the template (if any).
        if (empty($template)) {
            $template = $this->template;
        }
        if (!empty($template)) {
            $vars['content'] = $output;
            $output = $this->render($template, $vars);
        }

        return $output;
    }

    /**
     * Magic function to call view helpers by their classname.
     *
     * Example:
     * Calling the Hostingcheck_View_ResultClassName can be done by calling
     * $view->resultClassName()
     *
     * @param string $name
     *     The helper name.
     * @param array $arguments
     *     The parameters (if any).
     *
     * @return mixed
     *     The result of the helper output.
     */
    public function __call($name, $arguments = array())
    {
        $className = 'Hostingcheck_View_' . ucfirst($name);
        $class = new $className();
        return $class->$name($arguments);
    }
}
