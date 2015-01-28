<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A Seekable collection of test validators.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Validators implements Countable, SeekableIterator
{
    /**
     * The validators in the collection
     *
     * @var array
     */
    protected $validators = array();

    /**
     * The current position in the iterator array.
     *
     * @var int
     */
    protected $position = 0;


    /**
     * Class constructor.
     *
     * @param array $validators
     *     The validators configuration (array of settings).
     */
    public function __construct($validators)
    {
        foreach ($validators as $info) {
            if (empty($info['validator'])) {
                continue;
            }
            $validatorClass = $info['validator'];

            if (!class_exists($validatorClass)) {
                continue;
            }

            if (empty($info['args'])) {
                $info['args'] = array();
            }

            $this->validators[] = new $validatorClass($info['args']);
        }

        $this->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind() {
        $this->position = 0;
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Scenario_Group
     */
    public function current() {
        return $this->validators[$this->position];
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function key() {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function next() {
        $this->position++;
    }

    /**
     * {@inheritdoc}
     */
    function valid() {
        return isset($this->validators[$this->position]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->validators);
    }

    /**
     * Get the group element by the group name.
     *
     * @param int $position
     *     The position in the tests array.
     *
     * @return Hostingcheck_Scenario_Test|null
     *     Returns null if the test does not exists.
     */
    public function seek($position)
    {
        if (!isset($this->validators[$position])) {
            return null;
        }

        return $this->validators[$position];
    }
}
