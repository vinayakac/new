<?php
/* CPT : Treatments */
if ( ! function_exists('healthkare_cpt_treatments') ) {

	add_action( 'init', 'healthkare_cpt_treatments', 0 );

	function healthkare_cpt_treatments() {

		$labels = array(
			'name' =>  esc_html__('Treatments', "healthkare-toolkit" ),
			'singular_name' => esc_html__('Treatments', "healthkare-toolkit" ),
			'add_new' => esc_html__('Add New', "healthkare-toolkit" ),
			'add_new_item' => esc_html__('Add New Treatments', "healthkare-toolkit" ),
			'edit_item' => esc_html__('Edit Treatments', "healthkare-toolkit" ),
			'new_item' => esc_html__('New Treatments', "healthkare-toolkit" ),
			'all_items' => esc_html__('All Treatments', "healthkare-toolkit" ),
			'view_item' => esc_html__('View Treatments', "healthkare-toolkit" ),
			'search_items' => esc_html__('Search Treatments', "healthkare-toolkit" ),
			'not_found' =>  esc_html__('No Treatments found', "healthkare-toolkit" ),
			'not_found_in_trash' => esc_html__('No Treatments found in Trash', "healthkare-toolkit" ),
			'parent_item_colon' => '',
			'menu_name' => esc_html__('Treatments', "healthkare-toolkit")
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'show_in_menu' => true, 
			'query_var' => true,
			'supports' => array( 'title','thumbnail','editor' ),
			'rewrite'  => array( 'slug' => 'treatments-item' ),
			'has_archive' => false, 
			'capability_type' => 'post', 
			'hierarchical' => false,
			'menu_position' => 106,
			'menu_icon' => 'dashicons-images-alt2',
		);
		register_post_type( 'hk_treatments', $args );
	}
}
/* Register Custom Taxonomy */
add_action( 'init', 'healthkare_tax_treatments', 1 );
function healthkare_tax_treatments() {

	$labels = array(
		'name'                       => _x( 'Treatments Categories', 'Taxonomy General Name', 'healthkare-toolkit' ),
		'singular_name'              => _x( 'Treatments Categories', 'Taxonomy Singular Name', 'healthkare-toolkit' ),
		'menu_name'                  => esc_html__( 'Treatments Category', 'healthkare-toolkit' ),
		'all_items'                  => esc_html__( 'All Items', 'healthkare-toolkit' ),
		'parent_item'                => esc_html__( 'Parent Item', 'healthkare-toolkit' ),
		'parent_item_colon'          => esc_html__( 'Parent Item:', 'healthkare-toolkit' ),
		'new_item_name'              => esc_html__( 'New Item Name', 'healthkare-toolkit' ),
		'add_new_item'               => esc_html__( 'Add New Item', 'healthkare-toolkit' ),
		'edit_item'                  => esc_html__( 'Edit Item', 'healthkare-toolkit' ),
		'update_item'                => esc_html__( 'Update Item', 'healthkare-toolkit' ),
		'view_item'                  => esc_html__( 'View Item', 'healthkare-toolkit' ),
		'separate_items_with_commas' => esc_html__( 'Separate items with commas', 'healthkare-toolkit' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove items', 'healthkare-toolkit' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'healthkare-toolkit' ),
		'popular_items'              => esc_html__( 'Popular Items', 'healthkare-toolkit' ),
		'search_items'               => esc_html__( 'Search Items', 'healthkare-toolkit' ),
		'not_found'                  => esc_html__( 'Not Found', 'healthkare-toolkit' ),
		'items_list'                 => esc_html__( 'Items list', 'healthkare-toolkit' ),
		'items_list_navigation'      => esc_html__( 'Items list navigation', 'healthkare-toolkit' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'healthkare_treatments_tax', array( 'hk_treatments' ), $args );
}
?>