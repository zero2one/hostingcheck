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
 * A Seekable collection of test validators.
 *
 * @author Peter Decuyper <peter@serial-graphics.be>
 */
class Hostingcheck_Scenario_Validators extends Hostingcheck_Collection_Abstract
{
    /**
     * Add a validator to the array.
     *
     * @param Hostingcheck_Validator_Interface $validate
     */
    public function add(Hostingcheck_Validator_Interface $validate)
    {
        $this->collection[] = $validate;
    }

    /**
     * {@inheritdoc}
     *
     * @return Hostingcheck_Validator_Interface
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
     * @return Hostingcheck_Validator_Interface|null
     *     Returns null if no validator is found in the collection.
     */
    public function seek($position)
    {
        return parent::seek($position);
    }
}
