<?php
namespace Twist;

use Twist;

/**
 *
 * @author doug5997
 *        
 */
class Utilities
{
    
    private $config;
    
    private $connection;
    
    public $log;
    
    
    function __construct()
    {
        $this->log = new Logger('Constructed Utilities');
               
    }
    
    public function quote($value)
    {
        $item = sprintf("'%s'", $value);
        
        return $item;
    }
    
    public function hasPrefix($value, $prefix)
    {
        return stripos($value, $prefix) === 0;
        
    }
    
    private function getConfig()
    {
        if($this->config != null){
            
            return;
            
        }else{
            
            $file = PLUGIN_DIR . 'app.ini';
            
            if (!$this->config = parse_ini_file($file, TRUE)) {
            
                $this->log->log('Problem reading app.ini.');
            
                //TODO SEND EMAIL ALERT
            }
        }
    }
    
    private function createConnection()
    {
        global $wpdb;
        
        if($this->connection != null) {
            
            $connection = $this->connection;
            
        }else{
        
            $this->getConfig();
            
            $settings = $this->config;
            
            $credentials = implode(",",array(
                $settings['staging']['user'],
                $settings['staging']['password'], 
                $settings['staging']['dbname'],
                $settings['staging']['host']        
            ));
            
            $this->connection = new wpdb($this->credentials);
            
            $connection = $this->connection;
        }
        
        return $connection;
    }
    
    public function getConnection()
    {
        $connection =  $this->createConnection();
        
        return $connection;
    }
    
    public function contains($haystack, $needle)
    {
        return stripos($haystack, $needle) !== false ? true : false;
    }
    
    public function createProjectsTable()
    {
        global $wpdb;
        $table = "CREATE TABLE IF NOT EXISTS cab_Projects_Table(id INT NOT NULL AUTO_INCREMENT,uid INT NOT NULL,project TINYTEXT NOT NULL,created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated TIMESTAMP, PRIMARY KEY ( id ))";
        $results = $wpdb->get_results($table);
        $dump = print_r($results, true);
        $this->log->log($dump);
    }
    
    
    public function insertProjectName($args)
    {
        global $wpdb;
        try {
            $uid = addslashes($args['uid']);
            $projectName = addslashes($args['projectName']);
            $insert = "INSERT INTO _Projects_Table (id, uid, project) VALUES (null, '$uid','$projectName')";
            $this->log->log($insert);
            $results = $wpdb->get_results($insert);
            $this->log->log(print_r($results));
        }catch (\Exception $e){
            $this->log->log("error");
        }
    }
    
    public function selectProjectName($args)
    {
        global $wpdb;
        try {
            $uid = addslashes($args['uid']);
            $select = "SELECT project FROM _Projects_Table WHERE uid = $uid";
            $this->log->log($select);
            $results = $wpdb->get_results($select);
            return $results;
        }catch (\Exception $e){
            $this->log->log("select project names error");
        }
    }
    

    /**
     */
    function __destruct()
    {
        
        // TODO - Insert your code here
    }
}

?>