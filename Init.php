<?php
/*
 Plugin Name: Twist (Esri w/ Wordpress)
 Plugin URI: http://github.com/phpmaps/map-plugin
 Description: Prototype ArcGIS Tech w/ Wordpress
 Version: 1.0 rev 1 (Blue Jay)
 Author: Doug Carroll
 Author URI: http://phpmaps.github.io/me/
 */

namespace Twist;

use Twist;
/**
 *
 * @author Doug Carroll 
 * @email dougbcarroll@gmail.com
 *        
 */

define('PLUGIN_NAME', "Twist (Esri w/ Wordpress)");
        
        define('PLUGIN_DIR', plugin_dir_path(__FILE__));
        
        define('PLUGIN_URL', WP_PLUGIN_URL."/".dirname(plugin_basename(__FILE__)));


function loader($file){
    
    $classes = array(
        PLUGIN_DIR . 'Utilities.php',
        PLUGIN_DIR . 'Logger.php',
        PLUGIN_DIR . 'Reg.php',
        PLUGIN_DIR . 'Maps.php'
    
    );
    
    foreach ($classes as $k => $file){
        
        $file = sprintf('%s', $file);
        
        if(is_file($file) && !class_exists($file) ){
        
            include_once $file;
        
        }
    }
}

if(!function_exists('loader')){

    spl_autoload_register('Twist\loader');

}

//$registration = new \Reg(__FILE__);

$log = new Logger("Creating Logger");

$maps = new Maps();


?>