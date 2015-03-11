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
