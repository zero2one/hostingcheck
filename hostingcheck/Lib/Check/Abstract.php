<?php
/**
 * Hostingcheck_Check_Abstract
 *
 * @category   Hostingcheck
 * @package    Hostingcheck_Check
 * @copyright  Copyright (c) 2012 Serial Graphics (http://serial-graphics.be)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Hostingcheck_Check_Abstract implements Hostingcheck_Check_Interface
{
    /**
     * The types
     * 
     * @var string
     */
    const TYPE_INFO     = 'info';
    const TYPE_OK       = 'ok';
    const TYPE_OPTIONAL = 'optional';
    const TYPE_WARNING  = 'warning';
    const TYPE_ERROR    = 'error';
    
    
    /**
     * The options array
     * 
     * @var array
     */
    protected $_options = array();
    
    /**
     * The results
     * 
     * @var array
     */
    protected $_results = array();
    
    /**
     * The types count
     */
    protected $_count   = array();
    
  
    /**
     * Constructor
     * 
     * @param array $options
     *     An array with the test specific configuration
     */
    public function __construct($options = array())
    {
        if(!empty($options)) {
            array_merge_recursive($this->_options, $options);
        }
        
        $this->reset();
    }
    
    /**
     * Run all the tests
     * 
     * @return Hostingcheck_Check_Interface
     */
    public function run()
    {
        // get all the methods starting with test
        $reflection = new ReflectionClass($self);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $tests   = array();
        foreach($methods AS $method) {
            if(preg_match('/^test/', $method)) {
                $tests[] = $method;
            }
        }
        
        // run all the tests
        foreach($tests AS $test) {
            call_user_func(array($self, $method));
        }
        
        return $self;
    }
    
    /**
     * Reset the test. This will remove all previous test results
     * 
     * @param void
     * @return Hostingcheck_Check_Interface
     */
    public function reset()
    {
        $this->_results = array();
        $this->_count   = array();
        
        $reflection = new ReflectionClass($this);
        $constants  = $reflection->getConstants();
        foreach($constants AS $name => $value) {
            if(!preg_match('/^TYPE_/', $name)) {
                continue;
            }
            
            $this->_count[$value] = 0;
        }
    }
    
    /**
     * Add a result to the results array
     * 
     * @param string $group
     *     The group to who the test should be added
     * @param string $type
     *     The result type (see TYPE_ constants)
     * @param string $check
     *     The check that has been performed
     * @param string $result
     *     (optional) The result value
     * @param string $info
     *     Extra info
     * 
     * @return Hostingcheck_Check_Interface
     */
    public function addResult($group, $type, $check, $result = null, $info = null)
    {
        $this->_results[$group] = array(
            'type'   => $type,
            'check'  => $check,
            'result' => $result,
            'info'   => $info,
        );
        $this->_count[$type]++;
        
        return self;
    }
    
    /**
     * Get the report as an array
     * 
     * @param void
     * @return array
     */
    public function getResults()
    {
        return $this->_results;
    }
    
    /**
     * Get the count as an array
     * 
     * @param void
     * @return array
     */
    public function getCount()
    {
        return $this->_count;
    }
    
    /**
     * Return the report as a string
     * 
     * @param void
     * @return string
     */
    public function __toString()
    {
        $reporter = new Hostingcheck_Reporter();
        return $reporter->print($this);
    }
}
