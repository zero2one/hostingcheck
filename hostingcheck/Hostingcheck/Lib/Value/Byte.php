<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Value that indicates that the requested value is not supported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Byte extends Hostingcheck_Value_Abstract
{
    /**
     * Special format string to auto calculate the best value.
     *
     * @var string
     */
    const AUTO = 'AUTO';

    /**
     * Format used to represent the date as a string.
     *
     * @var string
     */
    protected $format = self::AUTO;

    /**
     * The minimal precision when formatting the bytes.
     *
     * @var int
     */
    protected $precision = 2;

    /**
     * Holder to store the mapping in.
     *
     * @var array
     */
    protected $mapping = array();

    /**
     * How much is 1 Kilo
     *
     * @var int
     */
    protected $kilo = 1024;


    /**
     * {@inheritDoc}
     */
    public function __construct($value = null)
    {
        if (is_null($value)) {
            $value = 0;
        }
        $this->value = $this->toBytes($value);
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     *     The number of Bytes.
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Helper to set the desired byte format.
     *
     * @param string $format
     *      A supported Byte format.
     *      Supported formats:
     *      - B : Bytes
     *      - K : KiloBytes
     *      - M : MegaBytes
     *      - G : GigaBytes
     *      - T : TeraBytes
     *      - AUTO : Auto round to nearest value smaller then 1024.
     * @param int precision
     *      Number of digits in the resulting formatted value.
     *
     * @return Hostingcheck_Value_Byte
     */
    public function setFormat($format, $precision = 0)
    {
        // Check if format is supported.
        $this->checkFormat($format);

        // Set the format.
        $this->format = $format;
        $this->precision = (int) $precision;

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
     * Return the string version of the byte.
     */
    public function __toString()
    {
        $value = $this->getValue();
        $string = $this->format($value, $this->format, $this->precision);
        return $string;
    }

    /**
     * Compares this Byte object to another.
     *
     * Returns an integer less than, equal to, or greater than zero
     * if the value of this Money object is considered to be respectively
     * less than, equal to, or greater than the other Money object.
     *
     * @param Hostingcheck_Value_Byte $other
     *      Byte value to compare to.
     *
     * @return integer
     *      -1|0|1
     */
    public function compareTo(Hostingcheck_Value_Byte $other)
    {
        if ($this->getValue() == $other->getValue()) {
            return 0;
        }
        return $this->getValue() < $other->getValue()
            ? -1
            : 1;
    }

    /**
     * Returns TRUE if this Byte object equals to another.
     *
     * @param Hostingcheck_Value_Byte $other
     *
     * @return boolean
     */
    public function equals(Hostingcheck_Value_Byte $other)
    {
        return $this->compareTo($other) == 0;
    }

    /**
     * Returns TRUE if the byte value represented by this Byte object
     * is greater than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Byte $other
     *
     * @return boolean
     */
    public function greaterThan(Hostingcheck_Value_Byte $other)
    {
        return $this->compareTo($other) == 1;
    }

    /**
     * Returns TRUE if the byte value represented by this Byte object
     * is greater than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Byte $other
     *
     * @return boolean
     */
    public function greaterThanOrEqual(Hostingcheck_Value_Byte $other)
    {
        return $this->greaterThan($other) || $this->equals($other);
    }

    /**
     * Returns TRUE if the byte value represented by this Byte object
     * is smaller than that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Byte $other
     *
     * @return boolean
     */
    public function lessThan(Hostingcheck_Value_Byte $other)
    {
        return $this->compareTo($other) == -1;
    }

    /**
     * Returns TRUE if the byte value represented by this Byte object
     * is smaller than or equal that of another, FALSE otherwise.
     *
     * @param Hostingcheck_Value_Byte $other
     *
     * @return boolean
     */
    public function lessThanOrEqual(Hostingcheck_Value_Byte $other)
    {
        return $this->lessThan($other) || $this->equals($other);
    }


    /**
     * Convert to bytes.
     *
     * @param string $value
     *
     * @return int
     */
    protected function toBytes($value)
    {
        $info = $this->extract($value);

        $multiplier = $this->getMappingByFormat($info['format']);
        return intval($info['value'] * $multiplier);
    }

    /**
     * Format the string based on the current set format.
     *
     * @param int $value
     *     The value in bytes.
     * @param string $format
     *     The format to format the string.
     * @param int $precision
     *     The precision to use in the formatted string.
     *
     * @return string
     */
    protected function format($value, $format, $precision)
    {
        if ($format === self::AUTO) {
            return $this->formatAuto($value, $precision);
        }

        $divider = $this->getMappingByFormat($format);
        $value = round($this->value / $divider, $precision);

        // Check for empty results.
        if (empty($value)) {
            return '0';
        }
        return $value . $format;
    }

    /**
     * Auto format the value by looking for the multiplier
     * where the value < 1024.
     *
     * @param int $value
     *     The value in bytes.
     * @param int $precision
     *     The precision to use in the formatted string.
     *
     * @return string
     */
    protected function formatAuto($value, $precision)
    {
        $mapping = $this->getMapping();
        foreach ($mapping as $format => $divider) {
            // Check if the value is still greather or equal as the divider.
            if ($value < ($divider * $this->kilo)) {
                break;
            }
        }

        return $this->format($value, $format, $precision);
    }

    /**
     * Mapping between format & value.
     *
     * @return array
     */
    protected function getMapping()
    {
        if (empty($this->mapping)) {
            $K = $this->kilo;
            $this->mapping = array(
                'B' => 1,
                'K' => $K,
                'M' => $K * $K,
                'G' => $K * $K * $K,
                'T' => $K * $K * $K * $K,
                'P' => $K * $K * $K * $K * $K,
            );
        }

        return $this->mapping;
    }

    /**
     * Get the mapping by the format.
     *
     * @param string $format
     *     The format (K, M, G, ...) used as the scale of the value.
     *
     * @return int
     */
    protected function getMappingByFormat($format)
    {
        $this->checkFormat($format);
        $mapping = $this->getMapping();
        return $mapping[$format];
    }

    /**
     * Split the given value in the value and the format.
     *
     * @param $value
     *     The value to split.
     *
     * @return array
     *      The splitted string containing:
     *      - value
     *      - format
     *
     * @throws Exception
     *     If the given value is not valid.
     */
    protected function extract($value)
    {
        // Prepare value.
        $value = trim(strtoupper($value));

        // Build the pattern.
        $mapping = $this->getMapping();
        $pattern = '/^([0-9]+\.?[0-9]*|\.?[0-9]+)\s?(['
            . implode('|', array_keys($mapping))
            . ']?)$/';

        // Extract info.
        preg_match_all($pattern, $value, $found);

        // Validate info.
        if (empty($found[0])) {
            throw new Exception(
                sprintf(
                    '%s is not a valid value',
                    $value
                )
            );
        }

        // Properly format the value.
        $value = $found[1][0];
        $format = $found[2][0];
        if (isset($value[0]) && $value[0] === '.') {
            $value = '0' . $value;
        }
        $value = trim($value, '.');

        // If no format, format = B.
        if (empty($format)) {
            $format = 'B';
        }

        // Return the result.
        return array(
            'value' => $value,
            'format' => $format,
        );
    }
}
