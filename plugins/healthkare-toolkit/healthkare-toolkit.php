<?php
/**
 * Plugin Name:  Healthkare Toolkit
 * Plugin URI:   http://www.onistaweb.com/
 * Description:  An easy to use theme plugin to add custom features to WordPress Theme.
 * Version:      1.1
 * Author:       Onista Web
 * Author URI:   http://www.onistaweb.com/
 * Author Email: onistaweb@gmail.com
 *
 * @package    HEALTHKARE_Theme_Toolkit
 * @since      1.0
 * @author     Onista Web
 * @copyright  Copyright (c) 2015-2016, Onista Web
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class HEALTHKARE_Theme_Toolkit {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  1.0
	 */
	public function __construct() {

		// Set constant path to the plugin directory.
		add_action( 'plugins_loaded', array( &$this, 'healthkare_constants' ), 1 );

		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( &$this, 'healthkare_i18n' ), 2 );

		// Load the plugin functions files.
		add_action( 'plugins_loaded', array( &$this, 'healthkare_includes' ), 3 );

		// Loads the admin styles and scripts.
		add_action( 'admin_enqueue_scripts', array( &$this, 'healthkare_admin_scripts' ) );

		// Loads the frontend styles and scripts.
		add_action( 'wp_enqueue_scripts', array( &$this, 'healthkare_frontend_scripts' ) ); 
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  1.0
	 */
	public function healthkare_constants() {

		// Set constant path to the plugin directory.
		define( 'HEALTHKARE_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// Set the constant path to the plugin directory URI.
		define( 'HEALTHKARE_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// Set the constant path to the inc directory.
		define( 'HEALTHKARE_INC', HEALTHKARE_DIR . trailingslashit( 'includes' ) );

		// Set the constant path to the shortcodes directory.
		define( 'HEALTHKARE_SC', HEALTHKARE_DIR . trailingslashit( 'shortcodes' ) );

		// Set the constant path to the assets directory.
		define( 'HEALTHKARE_LIB', HEALTHKARE_URI . trailingslashit( 'lib' ) );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 */
	public function healthkare_i18n() {
		load_plugin_textdomain( "healthkare-toolkit", false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 */
	public function healthkare_includes() {

		// Load CPT, CMB, Widgets
		require_once( HEALTHKARE_INC . 'inc.php' );
		require_once( HEALTHKARE_SC . 'inc.php' );
	}

	/**
	 * Loads the admin styles and scripts.
	 *
	 * @since  0.1.0
	 */
	function healthkare_admin_scripts() {
		
		// Loads the popup custom style.
		wp_enqueue_style( 'healthkare-toolkit-admin', trailingslashit( HEALTHKARE_LIB ) . 'css/admin.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'healthkare-toolkit-admin' , trailingslashit( HEALTHKARE_LIB ) . 'js/admin.js', array( 'jquery' ), '1.0', false );
	}

	/**
	 * Loads the frontend styles and scripts.
	 *
	 * @since  0.1.0
	 */
	 
	function healthkare_frontend_scripts() {
		$map_api = "";
		
		if( function_exists('healthkare_options') ) {
			$map_api = healthkare_options("map_api");
		}
		if( $map_api != "" ) {
			wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?key='.$map_api, array(), null, true );
		}
		else {
			wp_enqueue_script( 'gmap-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array(), null, true );
		}
		wp_enqueue_style( 'healthkare-toolkit', trailingslashit( HEALTHKARE_LIB ) . 'css/plugin.css', array(), '1.0', 'all' );
		wp_enqueue_script( 'healthkare-toolkit' , trailingslashit( HEALTHKARE_LIB ) . 'js/plugin.js', array( 'jquery' ), '1.0', false );
	}
	
}

new HEALTHKARE_Theme_Toolkit;