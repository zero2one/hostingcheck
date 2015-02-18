<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * A Seekable collection of objects.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Collection_Abstract implements Countable, SeekableIterator
{
    /**
     * The collection array.
     *
     * @var array
     */
    protected $collection;

    /**
     * The current position in the collection array.
     *
     * @var int
     */
    protected $position = 0;


    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->collection = array();
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
     * @return mixed
     */
    public function current() {
        return $this->collection[$this->position];
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
    public function valid() {
        return isset($this->collection[$this->position]);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
     * Get an element out of the collection based on its position within the
     * collection.
     *
     * @param int $position
     *     The position in the collection array.
     *
     * @return mixed|null
     *     Returns null if there is nothing stored in the given position.
     */
    public function seek($position)
    {
        if (!isset($this->collection[$position])) {
            return null;
        }

        return $this->collection[$position];
    }
}
