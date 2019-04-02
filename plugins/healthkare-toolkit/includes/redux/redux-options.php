<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "healthkare_option";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'healthkare_option/opt_name', $opt_name );

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'menu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Theme Options', "healthkare-toolkit" ),
	'page_title'           => esc_html__( 'Theme Options', "healthkare-toolkit" ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => '',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => true,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
	// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

Redux::setArgs( $opt_name, $args );

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'healthkare_remove_demo' );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'General Settings', "healthkare-toolkit" ),
	'icon'         => 'fa fa-cogs',
	'id'         => 'general_settings',
	'fields'     => array(
		array(
			'id'       => 'info_siteloader',
			'type'     => 'info',
			'title'    => esc_html__( 'Site Loader', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_siteloader',
			'type'     => 'switch',
			'title'    => esc_html__( 'Site Loader', 'healthkare-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'info_rtl',
			'type'     => 'info',
			'title'    => esc_html__( 'RTL Setting', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_rtl_switch',
			'type'     => 'switch',
			'title'    => esc_html__( 'RTL', 'healthkare-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'info_color',
			'type'     => 'info',
			'title'    => esc_html__( 'Color Switcher Setting', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_colorswitcher',
			'type'     => 'switch',
			'title'    => esc_html__( 'Color Switcher', 'healthkare-toolkit' ),
			'default'  => "0",
			'on'       => 'On',
			'off'      => 'Off',
		),
		
		array(
			'id'       => 'opt_select_stylesheet',
			'type'     => 'image_select',
			'icon'     => 'fa fa-tasks',
			'title'    => esc_html__( 'Color Scheme', "healthkare-toolkit" ),
			'subtitle' => esc_html__( 'Select your themes alternative color scheme.', "healthkare-toolkit" ),

			// Must provide key => value(array:title|img) pairs for radio options
			'options'  => array(
				'default' => array(
					'alt' => 'Default Color',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/green.jpg'
				),
				
				'red' => array(
					'alt' => 'Red',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/red.jpg'
				),
				
				'skyblue' => array(
					'alt' => 'Skyblue',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/skyblue.jpg'
				),
				
				'orange' => array(
					'alt' => 'Orange',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/orange.jpg'
				),
				
				'coral' => array(
					'alt' => 'Coral',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/coral.jpg'
				),
				
				'cyan' => array(
					'alt' => 'Cyan',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/cyan.jpg'
				),
				
				'khaki' => array(
					'alt' => 'Khaki',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/khaki.jpg'
				),
				
				'pink' => array(
					'alt' => 'Pink',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/pink.jpg'
				),
				
				'slateblue' => array(
					'alt' => 'Slateblue',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/slateblue.jpg'
				),
				
				'gold' => array(
					'alt' => 'Gold',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/color/gold.jpg'
				),
			),
			'default'  => 'default'
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Page Header', "healthkare-toolkit" ),
	'icon'         => 'fa fa-credit-card-alt',
	'id'         => 'page_header',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_pageheader_img',
			'type'     => 'media',
			'url'      => true,
			'title'          => esc_html__( 'Page Header Image( Default )', 'healthkare-toolkit' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB )  . 'images/page-banner.jpg' ),
		),
		array(
			'id'       => 'opt_pageheader_color',
			'type'     => 'color',
			'url'      => true,
			'title'          => esc_html__( 'Title Text Color', 'healthkare-toolkit' ),
			'output'   => array( '.page-banner .page-banner-content h3'),
		),
		array(
			'id'       => 'opt_pageheaderbg_overlay',
			'type'     => 'color_rgba',
			'title'   => esc_html__( 'Background Overlay', "healthkare-toolkit" ),
			'subtitle' => esc_html__( 'Pick a color.', "healthkare-toolkit" ),
			'options' => array(
				'show_alpha_only'    => true
			),
			'output'   => array( "background-color" => ".page-banner.custombg_overlay:before" ),
		),
		array(
			'id'        => 'opt_pageheader_height',
			'type'      => 'slider',
			'title'     => esc_html__('Page Header Height', 'healthkare-toolkit'),
			'subtitle'       => esc_html__( 'Allow your users to choose minimum height of page header', 'healthkare-toolkit' ),
			"default"   => 330,
			"min"       => 330,
			"step"      => 1,
			"max"       => 500,
			'display_value' => 'label'
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html( 'Social Icons', "healthkare-toolkit" ),
	'icon'         => 'fa fa-share-alt',
	'id'         => 'social_icons',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'info_social_icon',
			'type'     => 'info',
			'title'          => esc_html__( 'Social Icons', 'healthkare-toolkit' ),
		),
		array(
			'id'             => 'opt_social_icons',
			'type'           => 'ow_repeater',
			'textOne'        => true,
			'image'          => false,
			'title'          => esc_html__( 'Social Icon Entries', 'healthkare-toolkit' ),
			'subtitle'       => __( '<u>Here you can use css class like following :</u><br><br>- Elegant Icons ( "<b>social_facebook</b>" )<br>- Stroke Gap ( "<b>icon icon-Like</b>" )<br>- Font Awesome ( "<b>fa fa-facebook</b>" )', 'healthkare-toolkit' ),
			'placeholder'    => array(
				'textOne'  => "Font Icon CSS Class",
			)
		),
	),
));

/* Google Map */
Redux::setSection( $opt_name, array(
	'title'  => esc_html__( 'Google Map', "healthkare-toolkit" ),
	'icon' => 'fa fa-map',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'=>'map_api',
			'type' => 'text',
			'title' => esc_html__( 'API Key', "healthkare-toolkit" ),
			'desc' => wp_kses( __( '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get Api Key</a>', "healthkare-toolkit" ), array( 'a' => array( 'target' => array(), 'href' => array() ) ) ),
		),
	),
) );

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Layout Settings', "healthkare-toolkit" ),
	'icon'         => 'fa fa-desktop',
	'id'         => 'layout_settings',
	'fields'     => array(
		
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Body Layout', "healthkare-toolkit" ),
	'icon'         => 'fa fa-desktop',
	'id'         => 'body_layout',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'info_layout_body',
			'type'     => 'info',
			'title'    => esc_html__( 'Body Layout', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'layout_body',
			'type'     => 'image_select',
			'icon'     => 'fa fa-tasks',
			'title'    => esc_html__( 'Body Layout', "healthkare-toolkit" ),
			'options'  => array(
				'fixed' => array(
					'alt' => 'Boxed',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/layout/boxed.png'
				),
				'fluid' => array(
					'alt' => 'Full',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/layout/full.png'
				),
			),			
			'default'  => 'fixed'
		),
		array(
			'id'       => 'info_sidebar_layout',
			'type'     => 'info',
			'title'    => esc_html__( 'Sidebar Layout', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'layout_sidebar',
			'type'     => 'image_select',
			'icon'     => 'fa fa-tasks',
			'title'    => esc_html__( 'Sidebar Settings', "healthkare-toolkit" ),
			'options'  => array(
				'right_sidebar' => array(
					'alt' => 'Right Sidebar',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/layout/right_side.png'
				),
				'left_sidebar' => array(
					'alt' => 'Left Sidebar',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/layout/left_side.png'
				),
				'no_sidebar' => array(
					'alt' => 'No Sidebar',
					'img' => esc_url( HEALTHKARE_LIB ) . 'images/layout/no_side.png'
				),
			),			
			'default'  => 'right_sidebar'
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Header/Footer', "healthkare-toolkit" ),
	'icon'         => 'fa fa-archive',
	'id'         => 'site_headerfooter',
	'fields'     => array(
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Header', "healthkare-toolkit" ),
	'icon'         => 'fa fa-credit-card',
	'subsection' => true,
	'id'         => 'site_header',
	'fields'     => array(
		
		array(
			'id'       => 'info_sticky',
			'type'     => 'info',
			'title'    => esc_html__( 'Sticky Menu', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_sticky_menu',
			'type'     => 'switch',
			'title'    => esc_html__( 'Sticky Menu', 'healthkare-toolkit' ),
			'default'  => "1",
			'1'       => 'On',
			'2'      => 'Off',
		),
		
		array(
			'id'       => 'opt_headertype',
			'type'     => 'select',
			'title'    => esc_html__( 'Header Layout', "healthkare-toolkit" ),
			'options'  => array(
				'1' => 'Layout 1',
				'2' => 'Layout 2',
				'3' => 'Layout 3',
			),
			'default'  => '1',
		),
		
		array(
			'id'       => 'info_extra_txt',
			'type'     => 'info',
			'title'    => esc_html__( 'Header Info Text', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_support_txt',
			'type'     => 'text',
			'title'    => esc_html__( 'Information Text', "healthkare-toolkit" ),
			'default'  => esc_html__('Support',"healthkare-toolkit"),
		),
		array(
			'id'       => 'opt_support_url',
			'type'     => 'text',
			'title'    => esc_html__( 'Information Text URL', "healthkare-toolkit" ),
			'default'  => '#',
		),
		
		/* Header Contact Details 1*/
		array(
			'id'       => 'info_contact',
			'type'     => 'info',
			'title'    => esc_html__( 'Contact Details 1', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_header_email_one',
			'type'     => 'text',
			'title'    => esc_html__( 'Email 1', "healthkare-toolkit" ),
			'default'  => 'example@gmail.com',
		),
		
		array(
			'id'       => 'opt_header_email_two',
			'type'     => 'text',
			'title'    => esc_html__( 'Email 2', "healthkare-toolkit" ),
			'default'  => 'example1@gmail.com',
		),
		
		array(
			'id'       => 'opt_header_contact',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Number', "healthkare-toolkit" ),
			'default'  => '+0123456789',
		),
		
		
		/* Header Contact Details 2 */
		array(
			'id'       => 'info_hdr_cnt',
			'type'     => 'info',
			'title'    => esc_html__( 'Contact Details 2', 'healthkare-toolkit' ),
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_add_icon',
			'type'     => 'text',
			'title'    => esc_html__( 'Address Icon', "healthkare-toolkit" ),
			'default'  => 'fa fa-clock-o',
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_add_infotxt',
			'type'     => 'text',
			'title'    => esc_html__( 'Address Text Info', "healthkare-toolkit" ),
			'default'  => esc_html__('We are Near by You ',"healthkare-toolkit"),
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_address',
			'type'     => 'text',
			'title'    => esc_html__( 'Address', "healthkare-toolkit" ),
			'default'  => esc_html__('Melbourne - Australia',"healthkare-toolkit"),
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_contact_icon',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Number Icon', "healthkare-toolkit" ),
			'default'  => 'fa fa-phone',
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_contact_infotxt',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Info Text', "healthkare-toolkit" ),
			'default'  => esc_html__('We Feel Happy to Talk',"healthkare-toolkit"),
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'opt_contact_number',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Number', "healthkare-toolkit" ),
			'default'  => '(01) 98 765 432 10',
			'required' => array( 'opt_headertype', '=', '1'),
		),
		
		array(
			'id'       => 'info_form',
			'type'     => 'info',
			'title'    => esc_html__( 'Appointment Contact Form ID', 'healthkare-toolkit' ),
		),
		
		array(
			'id'       => 'opt_appointment_txt',
			'type'     => 'text',
			'title'    => esc_html__( 'Form Text', "healthkare-toolkit" ),
			'default'  => esc_html__('Appointment',"healthkare"),
		),
		array(
			'id'       => 'opt_contactform_id',
			'type'     => 'text',
			'title'    => esc_html__( 'Contact Form Shortcode ID', "healthkare-toolkit" ),
			'desc' => esc_html__('Example For:[contact-form-7 id="6" title="Healthkare Contact Form"]', 'healthkare-toolkit'),
		),
		array(
			'id'       => 'opt_form_icon',
			'type'     => 'text',
			'title'    => esc_html__( 'Form Icon', "healthkare-toolkit" ),
			'default'  => esc_html__('icon icon-Files',"healthkare-toolkit"),
		),
		array(
			'id'       => 'opt_form_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Form Title', "healthkare-toolkit" ),
			'default'  => esc_html__('Fix Your Appointment',"healthkare-toolkit"),
		),
		
		/* Logo */
		array(
			'id'       => 'info_sitelogo',
			'type'     => 'info',
			'notice' => true,
			'style' => 'critical',
			'icon' => 'fa fa-cube',
			'title'    => esc_html__( 'Site Logo', 'healthkare-toolkit' ),
			'subtitle' => esc_html__( 'Choose Logo Type', 'healthkare-toolkit' ),
		),
		array(
			'id'       => 'opt_logotype',
			'type'     => 'select',
			'title'    => esc_html__( 'Logo Type', "healthkare-toolkit" ),
			'options'  => array(
				'1' => 'Site Title',
				'2' => 'Image',
				'3' => 'Custom Text',
			),
			'default'  => '2',
		),
		array(
			'id'             => 'opt_logo_size',
			'type'           => 'dimensions',
			'units'          => array( 'px' ),    // You can specify a unit value. Possible: px, em, %
			'units_extended' => 'true',  // Allow users to select any type of unit
			'title'          => esc_html__( 'Logo (Width/Height) Option', "healthkare-toolkit" ),
			'required' => array( 'opt_logotype', '=', '2' ),
		),
		array(
			'id'=>'opt_logoimg',
			'type' => 'media',
			'title' => esc_html__('Logo Upload', "healthkare-toolkit" ),
			'required' => array( 'opt_logotype', '=', '2' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB ) . 'images/logo.png' ),
		),
		array(
			'id'=>'opt_customtxt',
			'type' => 'text',
			'title' => esc_html__('Custom Text', "healthkare-toolkit" ),
			'required' => array( 'opt_logotype', '=', '3' ),
			'default'  => "Healthkare"
		),

	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Footer', "healthkare-toolkit" ),
	'icon'         => 'fa fa-window-maximize',
	'id'         => 'site_footer',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_footertype',
			'type'     => 'select',
			'title'    => esc_html__( 'Footer', "healthkare-toolkit" ),
			'options'  => array(
				'1' => 'Footer 1',
				'2' => 'Footer 2',
				'3' => 'Footer 3',
			),
			'default'  => '2',
		),
		
		array(
			'id'       => 'opt_footer_bg',
			'type'     => 'media',
			'url'      => true,
			'title'          => esc_html__( 'Footer Background Image( Default )', 'healthkare-toolkit' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB ) . 'images/ftr-bg.jpg' ),
		),
		
		array(
			'id'       => 'opt_footer_copyright',
			'type'     => 'editor',
			'title'    => esc_html__( 'Copyright Text', "healthkare-toolkit" ),
			'subtitle' => esc_html__( 'Use any of the features of WordPress editor inside your panel!', "healthkare-toolkit" ),
			'default'  => '&copy; Copyrights [year] Health Kare All Rights Reserved',
			 'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
	),
));

Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Other Pages', "healthkare-toolkit" ),
	'icon'         => 'el el-file',
	'id'         => 'other_pages',
	'fields'     => array(),
));


/* Woocommerce Product Display Column */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Woocommerce Product Display', "healthkare-toolkit" ),
	'icon'         => 'fa fa-shopping-cart',
	'id'         => 'wc_display',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_wc_column',
			'type'     => 'select',
			'title'    => esc_html__('Select Option', 'healthkare-toolkit'), 
			'subtitle' => esc_html__('Display Item In Column Layout', 'healthkare-toolkit'),
			'options'  => array(
				'1' => '1 Column',
				'2' => '2 Column',
				'3' => '3 Column',
				'4' => '4 Column',
			),
			'default'  => '3',
		)
	),
));

/* Blog Single Post */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Blog Single Post Options', "healthkare-toolkit" ),
	'icon'         => 'fa fa-commenting-o',
	'id'         => 'blog_post',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_post_tags',
			'type'     => 'switch',
			'title'    => esc_html__( 'Tags', 'healthkare-toolkit' ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'opt_post_category',
			'type'     => 'switch',
			'title'    => esc_html__( 'Categories', 'healthkare-toolkit' ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),		
		array(
			'id'       => 'opt_post_author',
			'type'     => 'switch',
			'title'    => esc_html__( 'Author Details', 'healthkare-toolkit' ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'opt_post_share',
			'type'     => 'switch',
			'title'    => esc_html__( 'Social Share', "healthkare-toolkit" ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
		array(
			'id'       => 'opt_post_like',
			'type'     => 'switch',
			'title'    => esc_html__( 'Post Like', "healthkare-toolkit" ),
			'default'  => "1",
			'on'       => 'On',
			'off'      => 'Off',
		),
	),
));

/* Search Page */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Search Page', "healthkare-toolkit" ),
	'icon'         => 'fa fa-search',
	'id'         => 'page_search',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_search_bg',
			'type'     => 'media',
			'url'      => true,
			'title'          => esc_html__( 'Search Page Header Background Image( Default )', 'healthkare-toolkit' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB ) . 'images/page-banner.jpg' ),
		),
	),
));

/* 404 Page */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( '404 Page', "healthkare-toolkit" ),
	'icon'         => 'fa fa-exclamation-triangle',
	'id'         => 'page_error',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_404_bg',
			'type'     => 'media',
			'url'      => true,
			'title'          => esc_html__( '404 Page Header Background Image( Default )', 'healthkare-toolkit' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB ) . 'images/page-banner.jpg' ),
		),
		array(
			'id'       => 'opt_error_img',
			'type'     => 'media',
			'url'      => true,
			'title'          => esc_html__( '404 Image( Default )', 'healthkare-toolkit' ),
			'default'  => array( 'url' => esc_url( HEALTHKARE_LIB ) . 'images/404.png' ),
		),
		array(
			'id'       => 'opt_error_title',
			'type'     => 'text',
			'title'    => esc_html__( 'Error Title', "healthkare-toolkit" ),
			'default'  => esc_html__('Oops, The page is not exist!',"healthkare"),
		),
		array(
			'id'       => 'opt_error_content',
			'type'     => 'editor',
			'title'    => esc_html__( 'Error Text', "healthkare-toolkit" ),
			'default'  => esc_html__('Just two good old boys never meaning no harm beats all you have ever saw been in trouble with the law since the day they was born so the most of day this is the tale of our castaways they re here for a long long time',"healthkare-toolkit"),
			 'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
	),
));

/* Admin Login */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Admin Login Page', "healthkare-toolkit" ),
	'icon'         => 'fa fa-lock',
	'id'         => 'page_admin',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'opt_adminlogo',
			'type'     => 'media',
			'title'    => esc_html__( 'Logo Image', "healthkare-toolkit" ),
		),
		array(
			'id'       => 'opt_adminbg_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Background Color', "healthkare-toolkit" ),
		),
		array(
			'id'       => 'opt_adminbg_img',
			'type'     => 'media',
			'title'    => esc_html__( 'Background Image', "healthkare-toolkit" ),
		),
		array(
			'id'       => 'opt_admincolor',
			'type'     => 'color',
			'title'    => esc_html__( 'Text Color', "healthkare-toolkit" ),
		),
	),
));

/* Custom Css */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Custom CSS', "healthkare-toolkit" ),
	'id'         => 'custom_css',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'        => 'custom_css_desktop',
			'type'      => 'ace_editor',
			'title'     => esc_html__('Custom CSS for 992 to Larger Screen Resolution (iPad Landscape & Desktop)', 'healthkare-toolkit'),
			'subtitle'  => esc_html__('Paste your CSS code here.', 'healthkare-toolkit'),
			'mode'      => 'css',
			'theme'     => 'monokai',
		),
		array(
			'id'        => 'custom_css_tablet',
			'type'      => 'ace_editor',
			'title'     => esc_html__('Custom CSS for 768px to 991px Screen Resolution (iPad Portrait)', 'healthkare-toolkit'),
			'subtitle'  => esc_html__('Paste your CSS code here.', 'healthkare-toolkit'),
			'mode'      => 'css',
			'theme'     => 'monokai',
		),
		array(
			'id'        => 'custom_css_mobile',
			'type'      => 'ace_editor',
			'icon'     => "fa fa-tasks",
			'title'     => esc_html__('Custom CSS for 767px to Lower Screen Resolution (iPhone Landscape)', 'healthkare-toolkit'),
			'subtitle'  => esc_html__('Paste your CSS code here.', 'healthkare-toolkit'),
			'mode'      => 'css',
			'theme'     => 'monokai',
		),
	),
));

/* Typography Css */
Redux::setSection( $opt_name, array(
	'title'      => esc_html__( 'Typography', "healthkare-toolkit" ),
	'icon'         => 'fa fa-text-height ',
	'id'         => 'site_typography',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'       => 'info_body_font',
			'type'     => 'info',
			'title'    => esc_html__( 'Body Font Settings', 'healthkare-toolkit' ),
		),
		array(
			'id'          => 'opt_body_font',
			'type'        => 'typography', 
			'title'       => esc_html__('Body Style', 'healthkare-toolkit'),
			'google'      => true, 
			'font-backup' => false,
			'subsets'      => false,
			'text-align'      => false,
			'line-height'      => false,
			'output'      => array('body'),
			'units'       =>'px',
			'subtitle'    => esc_html__('Body Style', 'healthkare-toolkit'),
		),
		array(
			'id' => 'notice_critical11',
			'type' => 'info',
			'notice' => true,
			'style' => 'critical',
			'icon' => 'fa fa-font',
			'title' => esc_html__('H1 to H6 Styling', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Typography settings H1 to H6 Tags', 'healthkare-toolkit'),
		),
		array(
			'id' => 'h1-font',
			'type' => 'typography',
			'title' => esc_html__('H1', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h1',
		),
		array(
			'id' => 'h2-font',
			'type' => 'typography',
			'title' => esc_html__('H2', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h2',
		),
		array(
			'id' => 'h3-font',
			'type' => 'typography',
			'title' => esc_html__('H3', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h3',
		),
		array(
			'id' => 'h4-font',
			'type' => 'typography',
			'title' => esc_html__('H4', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h4',
		),
		array(
			'id' => 'h5-font',
			'type' => 'typography',
			'title' => esc_html__('H5', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h5',
		),
		array(
			'id' => 'h6-font',
			'type' => 'typography',
			'title' => esc_html__('H6', 'healthkare-toolkit'),
			'subtitle' => esc_html__('Specify the Heading font properties.', 'healthkare-toolkit'),
			'google' => true,
			'text-align' =>false,
			'output' => 'h6',
		),
	),
));

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'healthkare_remove_demo' ) ) {
	function healthkare_remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
			), null, 2 );

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}
}