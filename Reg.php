<?php
namespace Twist;

/**
 *
 * @author Doug Carroll 
 * @email dougbcarroll@gmail.com
 *        
 */

class Reg extends Utilities
{
    /**
     * Log object used for writing messages
     * @var Log
     */
    
    public $log;
    
    
    function __construct($file)
    {
        parent::__construct();
        
        $this->log = new Logger();
        
        register_activation_hook($file, array(&$this, "activate"));
        
        register_deactivation_hook($file, array(&$this, "deactivate"));
    }
    
    public function activate()
    {
        $this->log->log("Plugin activated");
        
        try {
            
            $this->log->log("Creating saved quotes table");
            
            $this->createSavedQuotesTable();
            
            $this->log->log("Created saved quotes table successfully");
            
        } catch (Exception $e) {
            
            $this->log->log("Error could not create saved quotes table!");
            
        }
        
        try {
            
            $this->log->log("Creating projects table");
            
            $this->createProjectsTable();
            
            $this->log->log("Created projects table successfully");
            
        } catch (Exception $e) {
            
            $this->log->log("Error could not create projects table!");
            
        }
        
        
        
    }
    
    public function deactivate()
    {
        $this->log->log("Plugin deactived");
        
    }
    
    function __destruct()
    {
        
        // TODO - Insert your code here
    }
    
}

?>