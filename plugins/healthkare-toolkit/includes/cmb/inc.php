<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

if( ! function_exists("healthkare_get_sidebars") ) {

	function healthkare_get_sidebars() {

		global $wp_registered_sidebars;

		$sidebar_options = array();

		$dwidgetarea = array( "" => "Select an Option" );

		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebar_options[$sidebar['id']] = $sidebar['name'];
		}
		return array_merge( $dwidgetarea, $sidebar_options );
	}
}
add_action( 'cmb2_init', 'register_healthkare_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function register_healthkare_metabox() {
	
	$footersidebar = array(
		"none" => "Select Widget Area",
		"sidebar-3" => "Footer Sidebar 1",
		"sidebar-4" => "Footer Sidebar 2",
		"sidebar-5" => "Footer Sidebar 3",
		"sidebar-6" => "Footer Sidebar 4",
		"sidebar-7" => "Footer Sidebar 5",
		"sidebar-8" => "Footer Sidebar 6",
		"sidebar-9" => "Footer Sidebar 7",
		"sidebar-10" => "Footer Sidebar 8"
	);

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'healthkare_cf_';

	/* ## Page/Post Options ---------------------- */

	/* - Page Description */
	$cmb_page = new_cmb2_box( array(
		'id'            => $prefix . 'metabox_page',
		'title'         => esc_html__( 'Page Options', "healthkare-toolkit" ),
		'object_types'  => array( 'page', 'post','hk_treatments','product'), // Post type
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
	) );

	$cmb_page->add_field( array(
		'name'             => 'Content Top/Bottom Padding',
		'desc'             => 'If your content section need to have just after header area without space, please select an option Off',
		'id'               => $prefix . 'content_padding',
		'type'             => 'select',
		'default'          => 'on',
		'options'          => array(
			'on' => esc_html__( 'On', "healthkare-toolkit" ),
			'off'   => esc_html__( 'Off', "healthkare-toolkit" ),
		),
	) );

	$cmb_page->add_field( array(
		'name'             => 'Content Left/Right Padding',
		'desc'             => 'If your content section need to have Left/Right without space, please select an option Off',
		'id'               => $prefix . 'clr_padding',
		'type'             => 'select',
		'default'          => 'on',
		'options'          => array(
			'on' => esc_html__( 'On', "healthkare-toolkit" ),
			'off'   => esc_html__( 'Off', "healthkare-toolkit" ),
		),
	) );

	$cmb_page->add_field( array(
		'name'             => 'Page Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'page_owlayout',
		'type'             => 'radio',
		'default'          => 'none',
		'options'          => array(
			'none' =>  '<img title="Default" src="'. HEALTHKARE_LIB .'images/layout/none.png" />',
			'fixed' =>  '<img title="Fixed" src="'. HEALTHKARE_LIB .'images/layout/boxed.png" />',
			'fluid' =>  '<img title="Fluid" src="'. HEALTHKARE_LIB .'images/layout/full.png" />'
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Sidebar Position',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'sidebar_owlayout',
		'type'             => 'radio',
		'default'          => 'none',
		'options'          => array(
			'none' =>  '<img src="'. HEALTHKARE_LIB .'images/layout/none.png" />',
			'right_sidebar' =>  '<img src="'. HEALTHKARE_LIB .'images/layout/right_side.png" />',
			'left_sidebar' =>  '<img src="'. HEALTHKARE_LIB .'images/layout/left_side.png" />',
			'no_sidebar' =>  '<img src="'. HEALTHKARE_LIB .'images/layout/no_side.png" />',
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Widget Area',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'widget_area',
		'type'             => 'select',
		'options'          => healthkare_get_sidebars(),
	) );
	$cmb_page->add_field( array(
		'name'             => 'Page Header',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'page_title',
		'type'             => 'select',
		'default'          => 'enable',
		'options'          => array(
			'enable' => esc_html__( 'Enable', "healthkare-toolkit" ),
			'disable'   => esc_html__( 'Disable', "healthkare-toolkit" ),
		),
	) );

	$cmb_page->add_field( array(
		'name' => esc_html__( 'Page Banner Image', "healthkare-toolkit" ),
		'desc' => esc_html__( 'Upload an image or enter a URL.', "healthkare-toolkit" ),
		'id'   => $prefix . 'page_header_img',
		'type' => 'file',
	) );
	
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Description', "healthkare-toolkit" ),
		'id'   => $prefix . 'banner_desc',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => get_option('default_post_edit_rows', 5), // rows="..."
		),
	) );
	
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Page Specific Logo', "healthkare-toolkit" ),
		'id'   => $prefix . 'custom_logo',
		'type' => 'file',
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Header Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'header_layout',
		'type'             => 'select',
		'options'          => array(
			'' => esc_html__( 'Select Layout', "healthkare-toolkit" ),
			'1' => esc_html__( 'Layout 1', "healthkare-toolkit" ),
			'2' => esc_html__( 'Layout 2', "healthkare-toolkit" ),
			'3' => esc_html__( 'Layout 3', "healthkare-toolkit" ),
		),
	) );

	$cmb_page->add_field( array(
		'name'             => 'Footer Layout',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_layout',
		'type'             => 'select',
		'options'          => array(
			'' => esc_html__( 'Select Footer Type', "healthkare-toolkit" ),
			'1' => esc_html__( 'Layout 1', "healthkare-toolkit" ),
			'2' => esc_html__( 'Layout 2', "healthkare-toolkit" ),
			'3' => esc_html__( 'Layout 3', "healthkare-toolkit" ),
		),
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Footer Widget Area 1',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_widget_area1',
		'type'             => 'select',
		'options'          => $footersidebar,
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Footer Widget Area 2',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_widget_area2',
		'type'             => 'select',
		'options'          => $footersidebar,
	) );
	
	$cmb_page->add_field( array(
		'name'             => 'Footer Widget Area 3',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_widget_area3',
		'type'             => 'select',
		'options'          => $footersidebar,
	) );
	$cmb_page->add_field( array(
		'name'             => 'Footer Widget Area 4',
		'desc'             => 'Select an option',
		'id'               => $prefix . 'footer_widget_area4',
		'type'             => 'select',
		'options'          => $footersidebar,
	) );
	
	
	$prefix_cmb = "cmb_";

	/* ## Post Options ---------------------- */
	require_once( $prefix_cmb . "post.php");
	
	/* ## Treatments Options ---------------------- */
	require_once( $prefix_cmb . "treatments.php");
}

add_action( 'cmb2_admin_init', 'register_healthkare_user_profile_metabox' );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function register_healthkare_user_profile_metabox() {
	$prefix = 'healthkare_user_';

	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'User Profile Metabox', 'healthkare-toolkit' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'healthkare-toolkit' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	$cmb_user->add_field( array(
		'name'    => esc_html__( 'Position/Designation', 'healthkare-toolkit' ),
		'id'      => $prefix . 'designation',
		'type'    => 'text',
	) );

	$cmb_user->add_field( array(
		'name' => esc_html__( 'Facebook URL :', 'healthkare-toolkit' ),
		'id'   => $prefix . 'fb_url',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Twitter URL :', 'healthkare-toolkit' ),
		'id'   => $prefix . 'tw_url',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Google Plus URL :', 'healthkare-toolkit' ),
		'id'   => $prefix . 'gp_url',
		'type' => 'text_url',
	) );
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Linkedin URL :', 'healthkare-toolkit' ),
		'id'   => $prefix . 'lin_url',
		'type' => 'text_url',
	) );
}