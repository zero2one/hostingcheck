<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Validate a version number.
 *
 * {@inheritDoc}
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Validate_Version extends Hostingcheck_Validate_Abstract
{
    /**
     * Arguments to use during the validation.
     *
     * @var array
     */
    protected $arguments = array(
        'equal' => null,
        'min' => null,
        'max' => null,
    );


    /**
     * {@inheritDoc}
     */
    public function validate(hostingcheck_Value_Interface $value)
    {
        $version = (string) $value;
        $messages = array();

        // If an equals value is given, check only if that is valid.
        if (!empty($this->arguments['equal'])) {
            $messages[] = $this->isEqual($version);
        }
        else {
            // Validate a minimal version.
            if (!empty($this->arguments['min'])) {
                $messages[] = $this->isMin($version);
            }

            // Validate a maximum version.
            if (!empty($this->arguments['max'])) {
                $messages[] = $this->isMax($version);
            }
        }

        // If there are messages, the version is not valid.
        $messages = array_values(array_filter($messages));
        return (count($messages))
            ? new Hostingcheck_Result_Failure($messages)
            : new Hostingcheck_Result_Success();
    }

    /**
     * Helper to validate if the given version is the same as the expected..
     *
     * @param string $version
     *      The version number to compare.
     *
     * @return string
     *      Error message if the validation is not ok.
     */
    protected function isEqual($version)
    {
        $equal = $this->arguments['equal'];

        if (version_compare($version, $equal) !== 0) {
            return sprintf(
                'Version is not equal to %s.',
                $equal
            );
        }
    }

    /**
     * Helper to validate te minimal version.
     *
     * @param string $version
     *      The version number to compare.
     *
     * @return string
     *      Error message if the validation is not ok.
     */
    protected function isMin($version)
    {
        $min = $this->arguments['min'];

        if (version_compare($version, $min) < 0) {
            return sprintf(
                'Version is to low, should be at least %s.',
                $min
            );
        }
    }

    /**
     * Helper to validate the maximum version.
     *
     * @param string $version
     *      The version number to compare.
     *
     * @return bool
     *      Result of the comparison.
     */
    protected function isMax($version)
    {
        $max = $this->arguments['max'];

        if (version_compare($version, $max) > 0) {
            return sprintf(
                'Version is to high, should be at most %s.',
                $max
            );
        }
    }
}
