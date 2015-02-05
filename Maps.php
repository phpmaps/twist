<?php
namespace Twist;

use Twist;

class Maps extends Utilities
{
    public $log;

    public function __construct()
    {
        parent::__construct();
        
        $this->log = new Logger("Maps Constructor");
        
        add_action( 'wp_enqueue_scripts', array(&$this,'injectScripts'), 10);
        
        add_shortcode('basic_map', array($this,'addJsapiMap'));
        
        add_shortcode('leaflet_map', array($this,'addLeafletMap'));
        
    }
    
    public function injectScripts()
    {
        /**
         * TODO: FIGURE OUT HOW TO HANDLE CSS LOADS - AS THESE DON'T PLAY NICE
         */
        //wp_enqueue_style('leaflet-css', '//cdn.jsdelivr.net/leaflet/0.7.3/leaflet.css');

        //wp_enqueue_style('leaflet_map-css', PLUGIN_URL.'/templates/includes/css/leaflet_map.css');
        
        wp_enqueue_style('esri-css', 'http://js.arcgis.com/3.12/esri/css/esri.css');
        
        wp_enqueue_style( 'map_basic-css', PLUGIN_URL.'/templates/includes/css/jsapi_map.css' );
    
        
        
        

        $jsConfig = array(
    
            'a' => admin_url('admin-ajax.php'),
    
            'b' => "b",
    
            'c' => PLUGIN_URL . '/images/'
    
        );
    
        wp_localize_script('ui', 'appConfig', $jsConfig);
    }
    
    public function addJsapiMap()
    {
        wp_enqueue_script( 'arcgis-js', 'http://js.arcgis.com/3.12/' );
        
        wp_enqueue_script( 'map_basic-js', PLUGIN_URL.'/templates/includes/js/jsapi_map.js');
        
        if(true == true){
        
            $file = sprintf('%s', PLUGIN_DIR . 'Templates/' . 'jsapi_map.php');
        
            include_once $file;
        
        
        }
    }
    
    public function addLeafletMap()
    {
        wp_enqueue_script( 'jquery-js', '//code.jquery.com/jquery-2.1.1.min.js' );
        
        wp_enqueue_script( 'leaflet-js', '//cdn.jsdelivr.net/leaflet/0.7.3/leaflet.js');
        
        wp_enqueue_script( 'esri-leaflet-js', 'http://cdn-geoweb.s3.amazonaws.com/esri-leaflet/1.0.0-rc.5/esri-leaflet.js');

        wp_enqueue_script( 'leaflet-map-js', PLUGIN_URL.'/templates/includes/js/leaflet_map.js');
        
        if(true == true){
        
            $file = sprintf('%s', PLUGIN_DIR . 'Templates/' . 'leaflet_map.php');
        
            include_once $file;
        
        
        }
         
    }

    public function __destruct()
    {
        
    }
}

?>