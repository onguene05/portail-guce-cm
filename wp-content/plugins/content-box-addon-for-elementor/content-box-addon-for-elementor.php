<?php
/**
 * Plugin Name: 		Content Box Addon For Elementor
 * Plugin URI:  		https://blocksera.com/wordpress-plugins/content-box-addon-for-elementor
 * Author: 				Blocksera
 * Author URI:			https://blocksera.com
 * Description: 		7 unique content box addon designs to your web pages using this Elementor addon.
 * Version:     		1.1
 * Requires at least:   4.7
 * Tested up to:        5.1.1
 * License: 			GPL v3
 * Text Domain: 		cbae-lang
 * Domain Path: 		/languages
 *
**/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

define('CBAE_VERSION', '1.1');
define('CBAE_MINIMUM_ELEMENTOR_VERSION', '1.1.2');
define('CBAE_PATH', plugin_dir_path( __FILE__ ) );
define('CBAE_URL', plugin_dir_url( __FILE__ ) );

require_once CBAE_PATH.'includes/elementor-checker.php';

class Content_Box_Addon {
    
	private static $_instance = null;
	
	public static function get_instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
    public function init() {
        load_plugin_textdomain('cbae-lang', false, CBAE_PATH . 'languages');
    }
	
	public function __construct() {
		if ( self::$_instance ) {
			return;
        }
        
		self::$_instance = $this;
		
		add_action( 'plugins_loaded', array( $this, 'cbae_plugin_loaded') );
		
		add_action('elementor/widgets/widgets_registered',array( $this, 'cbae_elements'));
		add_action('elementor/frontend/after_enqueue_styles', array( $this, 'cbae_enqueue_scripts') );
	}

	public function cbae_plugin_loaded() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'cbae_widgets_fail_load' );
			return;
		}
	
		if ( ! version_compare( ELEMENTOR_VERSION, CBAE_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', 'cbae_fail_load_out_of_date' );
			return;
		}
	}
	
	public function cbae_elements(){
		require_once CBAE_PATH.'includes/widgets.php';
	}

	public function cbae_enqueue_scripts(){
		wp_enqueue_style( 'cbae-admin-style', CBAE_URL . 'assets/css/admin.css', array(), CBAE_VERSION );
	}

}


function Content_Box_Addon() {
    return Content_Box_Addon::get_instance();
}

$GLOBALS['Content_Box_Addon'] = Content_Box_Addon();