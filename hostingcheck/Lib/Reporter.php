<?php
/**
 * Hostingcheck_Reporter
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Reporter
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Hostingcheck_Reporter
{
    /**
     * Generates the report as a string
     * 
     * @return string
     */
    public function generate()
    {
        return 'TEST 1234';
    }
    
    /**
     * Print out the report to the screen
     * 
     * @return void
     */
    public function printScreen()
    {
        echo $this->generate();
    }
    
    
    /**
     * Forces a download of the report
     * 
     * @return void
     */
    public function download()
    {
        
    }
    
}
