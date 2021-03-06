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
 * Value that indicates that the requested value is not supported.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Value_Byte extends Hostingcheck_Value_Comparable
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
     * Pattern to identify the value and the format out of a given string.
     *
     * @var string
     */
    protected $pattern;


    /**
     * {@inheritDoc}
     */
    public function __construct($value = null)
    {
        $this->createPattern();

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
     *      - P : PetaBytes
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
        $format = $this->getAutoFormat($value);
        return $this->format($value, $format, $precision);
    }

    /**
     * Get format that results in the smallest number and the largest format.
     *
     * @param int $value
     *     The value in bytes
     *
     * @return string
     *     The format to use.
     */
    protected function getAutoFormat($value)
    {
        $mapping = $this->getMapping();
        $format = 'B';

        foreach ($mapping as $format => $divider) {
            // Check if the value is still greather or equal as the divider.
            if ($value < ($divider * $this->kilo)) {
                return $format;
            }
        }

        return $format;
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
     * @param string $value
     *     The value to split.
     *
     * @return array
     *      The splitted string containing:
     *      - value
     *      - format
     */
    protected function extract($value)
    {
        $value = trim(strtoupper($value));
        $raw = $this->extractRaw($value);

        $clean = array(
            'value' => $this->cleanValue($raw['value']),
            'format' => $this->cleanFormat($raw['format']),
        );

        return $clean;
    }

    /**
     * Split the given string in a raw value and format part.
     *
     * @param string $value
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
    protected function extractRaw($value)
    {
        // Extract info.
        preg_match_all($this->pattern, $value, $found);

        // Validate info.
        if (empty($found[0])) {
            throw new Exception(
                sprintf(
                    '%s is not a valid value',
                    $value
                )
            );
        }

        $result = array(
            'value' => $found[1][0],
            'format' => $found[2][0]
        );
        return $result;
    }

    /**
     * Get the clean version of the value.
     *
     * @param string $value
     *     The value as extracted from teh raw string.
     *
     * @return string
     *     The cleaned up version of the value.
     *
     * @throws Exception
     *     If the given value is not valid.
     */
    protected function cleanValue($value)
    {
        // Format decimal number.
        if (isset($value[0]) && $value[0] === '.') {
            $value = '0' . $value;
        }

        // Make sure we remove trailing ".".
        return trim($value, '.');
    }

    /**
     * Get the clean version of the format.
     *
     * @param string $format
     *     The format as extracted from the raw string.
     *
     * @return string
     *     The format string.
     */
    protected function cleanFormat($format)
    {
        if (empty($format)) {
            $format = 'B';
        }

        return $format;
    }

    /**
     * Create the pattern to identify the value and the format.
     */
    protected function createPattern()
    {
        if (!$this->pattern) {
            $mapping = $this->getMapping();
            $this->pattern = '/^([0-9]+\.?[0-9]*|\.?[0-9]+)\s?(['
                . implode('|', array_keys($mapping))
                . ']?)$/';
        }
    }
}
