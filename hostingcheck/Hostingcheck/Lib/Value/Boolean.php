<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Value that represents a boolean value.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Boolean extends Hostingcheck_Value_Abstract
{
    /**
     * Possible formats.
     *
     * @var string
     */
    const BOOLEAN = 'boolean';
    const INTEGER = 'integer';
    const YES_NO  = 'yes_no';
    const ON_OFF  = 'on_off';

    /**
     * Format used to represent the date as a string.
     *
     * @var string
     */
    protected $format = self::BOOLEAN;

    /**
     * Supported formats.
     *
     * @var array
     */
    protected $formats = array(
        self::BOOLEAN,
        self::INTEGER,
        self::YES_NO,
        self::ON_OFF,
    );

    /**
     * Mapping of predefined string representations of boolean values.
     *
     * @var array
     */
    protected $mapping = array(
        ''      => false,
        'null'  => false,
        'false' => false,
        'true'  => true,
        'off'   => false,
        'on'    => true,
        'no'    => false,
        'yes'   => true,
    );


    /**
     * {@inheritDoc}
     */
    public function __construct($value = false)
    {
        $this->value = $this->parse($value);
    }

    /**
     * Helper to set the desired string format of the boolean.
     *
     * @param string $format
     *      A supported output format.
     *      Supported formats:
     *      - boolean : Will output True or False.
     *      - integer : Will output 1 or 0.
     *      - yes_no  : Will output Yes or No
     *      - on_off  : Will output On or Off
     *
     * @return Hostingcheck_Value_Boolean
     */
    public function setFormat($format)
    {
        // Check if format is supported.
        $this->checkFormat($format);

        // Set the format.
        $this->format = $format;

        return $this;
    }

    /**
     * Return the string version of the boolean.
     */
    public function __toString()
    {
        $value = $this->getValue();
        $string = $this->format($value, $this->format);
        return $string;
    }

    /**
     * Validate if the format is supported.
     *
     * @param string $format
     *     The format to use in the string version of the value.
     *
     * @throws Exception
     *     If the format is not supported.
     */
    protected function checkFormat($format)
    {
        if (!in_array($format, $this->formats)) {
            throw new Exception(
                sprintf(
                    'Format %s is not supported.',
                    $format
                )
            );
        }
    }

    /**
     * Format the string based on the current set format.
     *
     * @param bool $value
     *     The boolean value
     * @param string $format
     *     The format to format the string.
     *
     * @return string
     */
    protected function format($value, $format)
    {
        switch($format) {
            case self::INTEGER:
                $string = $this->formatInteger($value);
                break;

            case self::ON_OFF:
                $string = $this->formatOnOff($value);
                break;

            case self::YES_NO:
                $string = $this->formatYesNo($value);
                break;

            case self::BOOLEAN:
            default:
                $string = $this->formatBoolean($value);
                break;
        }

        return $string;
    }

    /**
     * Format the string as a boolean value.
     *
     * @param bool $value
     *     The boolean value
     *
     * @return string
     *     "false" or "true".
     */
    protected function formatBoolean($value)
    {
        return ($value)
            ? 'true'
            : 'false';
    }

    /**
     * Format the string as an integer value.
     *
     * @param bool $value
     *     The boolean value
     *
     * @return string
     *     "0" or "1".
     */
    protected function formatInteger($value)
    {
        return ($value)
            ? '1'
            : '0';
    }

    /**
     * Format the string as on/off value.
     *
     * @param bool $value
     *     The boolean value
     *
     * @return string
     *     "off" or "on".
     */
    protected function formatOnOff($value)
    {
        return ($value)
            ? 'on'
            : 'off';
    }

    /**
     * Format the string as a yes/no value.
     *
     * @param bool $value
     *     The boolean value
     *
     * @return string
     *     "no" or "yes".
     */
    protected function formatYesNo($value)
    {
        return ($value)
            ? 'yes'
            : 'no';
    }

    /**
     * Parse a boolean out of the given value.
     *
     * @param mixed $value
     *     The value as boolean, integer or string.
     *
     * @return bool
     */
    protected function parse($value)
    {
        switch (gettype($value)) {
            case 'boolean':
                $parsed = $value;
                break;

            case 'integer':
            case 'double':
                $parsed = $this->parseNumeric($value);
                break;

            case 'NULL':
                $parsed = false;
                break;

            case 'string':
                $parsed = $this->parseString($value);
                break;

            default:
                $parsed = (bool) $value;
                break;
        }

        return $parsed;
    }

    /**
     * Parse a string into a boolean.
     *
     * @param string $value
     *
     * @return bool
     */
    protected function parseString($value)
    {
        if (is_numeric($value) || is_float($value)) {
            $parsed = $this->parseNumeric($value);
        }
        else {
            $parsed = $this->parsePredefined($value);
        }

        return $parsed;
    }

    /**
     * Parse numeric values.
     *
     * @param mixed $value
     *     The value to parse.
     *
     * @return bool
     */
    protected function parseNumeric($value)
    {
        return (bool) floatval($value);
    }

    /**
     * Parse by using a predefined map.
     *
     * @param mixed $value
     *     The value to parse.
     *
     * @return bool
     */
    protected function parsePredefined($value)
    {
        $value = trim(strtolower($value));

        if (array_key_exists($value, $this->mapping)) {
            $parsed = $this->mapping[$value];
        }
        else {
            $parsed = (bool) $value;
        }

        return $parsed;
    }
}
