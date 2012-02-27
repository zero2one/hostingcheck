<?php
/**
 * Hostingcheck_Test_Interface
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Test
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Hostingcheck_Test_Interface
{
    /**
     * Constructor
     * 
     * @param $options
     *     An array with the test specific configuration
     * 
     * @return void
     */
    public function __construct($options = array());
    
    /**
     * Run all the tests
     * 
     * @param void
     * 
     * @return Hostingcheck_Test_Interface
     */
    public function run();
    
    /**
     * Reset the test. This will remove all previous test results
     * 
     * @param void
     * 
     * @return Hostingcheck_Test_Interface
     */
    public function reset();
    
    /**
     * Get the report as an array
     * 
     * @param void
     * 
     * @return array
     */
    public function getResults();
    
    /**
     * Add a result to the results array
     * 
     * @param string $group
     *     The group to who the test should be added
     * @param string $type
     *     The result type (see TYPE_ contstants)
     * @param string $check
     *     The check that has been performed
     * @param string $result
     *     (optional) The result value
     * @param string $info
     *     Extra info
     * 
     * @return Hostingcheck_Test_Interface
     */
    public function addResult($group, $type, $check, $result = null, $info = null);
    
    /**
     * Return the report as a string
     * 
     * @param void
     * @return string
     */
    public function __toString();
}
