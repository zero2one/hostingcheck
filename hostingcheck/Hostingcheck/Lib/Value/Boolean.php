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
        $mapping = $this->getMapping();

        if (!in_array($format, array_keys($mapping))) {
            throw new Exception(
                sprintf(
                    'Format %s is not supported.',
                    $format
                )
            );
        }
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
        return $value;
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
                $parsed = (bool) $value;
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
        switch ($value) {
            case '':
            case 'false':
            case 'null':
            case 'off':
            case 'no':
                $parsed = false;
                break;

            case 'true':
            case 'on':
            case 'yes':
                $parsed = true;
                break;

            default:
                $parsed = (bool) $value;
                break;
        }

        return $parsed;
    }
}
