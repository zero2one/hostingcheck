<?php
/**
 * Hostingcheck (https://github.com/zero2one/hostingcheck)
 *
 * @link      https://github.com/zero2one/hostingcheck source repository.
 * @copyright Copyright (c) 2014 Serial Graphics (http://serial-graphics.be)
 * @license   http://opensource.org/licenses/GPL-2.0 GNU Public License
 */


/**
 * Represents a collection with name-keyed values.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Collection_Keyed extends Hostingcheck_Collection_Abstract
{
    /**
     * The keys of the elements in the collection.
     *
     * @var array
     */
    protected $keys = array();

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->updateKeys();
    }

    /**
     * {@inheritdoc}
     */
    public function current() {
        return $this->seek($this->key());
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function key() {
        return $this->keys[$this->position];
    }

    /**
     * {@inheritdoc}
     */
    public function valid() {
        return isset($this->keys[$this->position]);
    }

    /**
     * Get the item its name key.
     *
     * @param string $name
     *     The key name.
     *
     * @return mixed|null
     *     Returns null if there is nothing stored for the given named key.
     */
    public function seek($name)
    {
        if (!isset($this->collection[$name])) {
            return null;
        }

        return $this->collection[$name];
    }

    /**
     * Update the keys in the collection.
     */
    protected function updateKeys()
    {
        $this->keys = array_keys($this->collection);
    }
}
