<?php
// Start with an underscore to hide fields from custom fields list
$prefix = 'healthkare_cf_';

/* Post : healthkare_treatments */
$cmb_treatments = new_cmb2_box( array(
	'id'            => $prefix . 'metabox_treatments',
	'title'         => esc_html__( 'Treatments Options', "healthkare-toolkit" ),
	'object_types'  => array( 'hk_treatments' ), // Post type
	'context'       => 'normal',
	'priority'      => 'high',
	'show_names'    => true, // Show field names on the left
) );

/* Video Option */
$cmb_treatments->add_field( array(
    'name' => 'Embed Video URL',
    'desc' => 'Enter Embeds URL. Example For: vimeo.com/27209688',
    'id'   => $prefix .'video_embed',
    'type' => 'oembed',
) );

/* Treatment Details */
$cmb_grp_treatments = $cmb_treatments->add_field( array(
	'id'          => $prefix . 'treatments_grp',
	'type'        => 'group',
	'options'     => array(
		'group_title'   => esc_html__( 'Treatment Details Box {#}', 'healthkare-toolkit' ), // {#} gets replaced by row number
		'add_button'    => esc_html__( 'Add Item', 'healthkare-toolkit' ),
		'remove_button' => esc_html__( 'Remove Item', 'healthkare-toolkit' ),
	),
) );

$cmb_treatments->add_group_field( $cmb_grp_treatments, array(
	'name' => 'Title',
	'id'   => 'group_title',
	'type' => 'text',
) );

$cmb_treatments->add_group_field( $cmb_grp_treatments, array(
	'name' => 'Value',
	'id'   => 'group_value',
	'type' => 'text',  
) );

/* Treatment Details */
$cmb_treatments->add_field( array(
	'name' => __( 'Specialized Treatments Descriptions', "healthkare-toolkit" ),
	'id'   => $prefix . 'special_desc',
	'type' => 'wysiwyg',
	'options' => array(
		'textarea_rows' => get_option('default_post_edit_rows', 3), // rows="..."
	),
) );


$cmb_grp_treatments = $cmb_treatments->add_field( array(
	'id'          => $prefix . 'special_treatment_grp',
	'type'        => 'group',
	'options'     => array(
		'group_title'   => esc_html__( 'Specialized Treatments Details {#}', 'healthkare-toolkit' ), // {#} gets replaced by row number
		'add_button'    => esc_html__( 'Add Item', 'healthkare-toolkit' ),
		'remove_button' => esc_html__( 'Remove Item', 'healthkare-toolkit' ),
	),
) );

$cmb_treatments->add_group_field( $cmb_grp_treatments, array(
	'name' => 'Title',
	'id'   => 'special_title',
	'type' => 'text',
) );

$cmb_treatments->add_group_field( $cmb_grp_treatments, array(
	'name' => 'Image',
	'id'   => 'group_image',
	'type' => 'file',  
) );
?>