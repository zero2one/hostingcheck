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
class Hostingcheck_Scenario_Validators extends Hostingcheck_Collection_Abstract
{
    /**
     * Add a validator to the array.
     *
     * @param Hostingcheck_Validate_Interface $validate
     */
    public function add(Hostingcheck_Validate_Interface $validate)
    {
        $this->collection[] = $validate;
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Validate_Interface
     */
    public function current() {
        return parent::current();
    }

    /**
     * Get a validator by its position in the collection.
     *
     * @param int $position
     *     The position in the collection.
     *
     * @return Hostingcheck_Validate_Interface|null
     *     Returns null if no validator is found in the collection.
     */
    public function seek($position)
    {
        return parent::seek($position);
    }
}
