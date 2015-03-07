<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Parse a fully qualified class name out of the short version.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Parser_ClassName
{
    /**
     * Parse the full class name out of the short class name.
     *
     * @param string $type
     *     The class type.
     * @param string $name
     *     The short version of the name.
     *
     * @return string
     */
    public function parse($type, $name)
    {
        $type = ucfirst(strtolower($type));

        $checkClass = $this->getClassNameCheck($type, $name);
        return (!is_null($checkClass))
            ? $checkClass
            : $this->getClassNameHostingcheck($type, $name);
    }

    /**
     * Create a Hostingcheck_ prefixed class name.
     *
     * @param string $type
     *     The class type.
     * @param string $name
     *     The short version of the class name.
     *
     * @return string
     *     The class name.
     */
    protected function getClassNameHostingcheck($type, $name)
    {
        $className = 'Hostingcheck_' . $type . '_' . $name;
        return $className;
    }

    /**
     * Create a Check_ prefixed class name.
     *
     * @param string $type
     *     The class type.
     * @param string $name
     *     The short version of the class name.
     *
     * @return string|null
     *     Retuns null if not an classname from the check namespace.
     */
    protected function getClassNameCheck($type, $name)
    {
        $className = null;

        $split = explode('_', $name);
        if (1 < count($split) && $this->isCheckPrefix($split[0])) {
            $prefix = array_shift($split);
            $suffix = implode('_', $split);
            $className = 'Check_' . $prefix . '_' . $type . '_' . $suffix;
        }

        return $className;
    }

    /**
     * Check if the given first part of the class name is a check prefix.
     *
     * @param string $prefix
     *     The prefix to test.
     *
     * @return bool
     *     Prefix exists.
     */
    protected function isCheckPrefix($prefix)
    {
        $path = HOSTINGCHECK_BASEPATH . '/Hostingcheck/Check/' . $prefix;
        return file_exists($path);
    }
}
