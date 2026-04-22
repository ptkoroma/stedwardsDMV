<?php
/**
 * @package Mim Theme Plugin
 * @version 3.1
 * 
 * Plugin Name: Mim Theme Plugin
 * Plugin URI: http://regaltheme.com/plugins/mim-theme-plugin
 * Description: This plugin contains essential data for mim wordpress theme, To use Mim theme properly you must install this plugin.
 * Author: RegalTheme
 * Version: 3.1
 * Author URI: http://regaltheme.com/
 */


/**
 * Restrict direct access
 * 
 * @return void
 **/
if (! defined('ABSPATH') ) {
    exit;
}



/**
 * Mim theme main plugin class
 * @package Mim
**/
if (!class_exists('MimTheme_Plugin')) {


    require_once (__DIR__ . '/vendor/autoload.php');

    final class MimTheme_Plugin 
    {

        /*
         * plugin version
        */
        const mimversion = '3.1';


        
        private function __construct()
        {
            $this->define_constants();
            register_activation_hook(__FILE__ , [$this , 'activate'] );
            add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
            register_activation_hook(__FILE__, [ $this, 'MimTheme_plugin_activate']);
            add_action('admin_init', [ $this, 'Mim_Plugin_redirect']);
        }


        /**
         * Inisialize a singleton instnace  
         *
         * @return \MimTheme\Plugin
        **/
        public static function init(){
            static $instance = false;

            if ( $instance == false ) {
                $instance = new self();
            }

            return $instance;
        }


        /**
         * define constants
         *
         * @return void
        **/
        public function define_constants(){
            define('MIM_THEME_PLUGIN_ROOT', __FILE__);
            define('MIM_THEME_PLUGIN_VERSION', self::mimversion);
            define('MIM_THEME_PLUGIN_URL', plugin_dir_url(MIM_THEME_PLUGIN_ROOT));
            define('MIM_THEME_PLUGIN_ASSETS', plugin_dir_url(MIM_THEME_PLUGIN_ROOT) . 'assets/');
            define('MIM_THEME_PLUGIN_PATH', plugin_dir_path(MIM_THEME_PLUGIN_ROOT));
        }


        /**
         * Do stuff after plugin loaded
         *
         * @return void
        **/
        public function init_plugin (){
            new MimTheme\Plugin\Admin();
            new MimTheme\Plugin\Frontend();
        }




        /**
         * Do stuff upon plugin activation
         *
         * @return void
        **/
        public function activate (){
            $installed = get_option('mim_plugin_installed');
            if ( !$installed ) {
                update_option('mim_plugin_installed', time() );
            }
            update_option('mim_plugin_version', self::mimversion );


        }

        public function MimTheme_plugin_activate() {
            add_option('Mim_Plugin_do_activation_redirect', true);
        }

        public function Mim_Plugin_redirect() {
            if (get_option('Mim_Plugin_do_activation_redirect', false)) {
                delete_option('Mim_Plugin_do_activation_redirect');
                if(!isset($_GET['activate-multi']))
                {
                    wp_redirect("admin.php?page=mim-welcome");
                }
            }
        }


    }


    /**
     * Inisialize the main plugin   
     *
     * @return \MimTheme\Plugin
    **/
    function mim_theme_plugin(){
        return MimTheme_Plugin::init();
    }
    
    /*
    * Run the plugin
    */
    mim_theme_plugin();
}