<?php
function healthkare_appoinmentform( $atts ) {
	
	extract( shortcode_atts( array( 'sc_bg' => '', 'sc_title_a' => '', 'sc_title_b' => '','sc_desc' => '', 'id' => '' ), $atts ) );
	
	$style = "";

	if( $sc_bg != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$style = "";
	}
	
	ob_start();
	
	?>
	<!-- Appoinment Section -->
	<div class="appoinment-section container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $style );?>>
		<!-- Container -->
		<div class="container">
			<?php
			if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
				?>
				<!-- Section Header -->
				<div class="section-header3">
					<?php if($sc_title_a != "" || $sc_title_b != "" ) { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
					<?php echo wpautop( wp_kses( $sc_desc, wp_kses_allowed_html() ) ); ?>
				</div><!-- Section Header /- -->
				<?php
			}
			if($id != "" ) {
				?>
				<div class="row">
					<?php echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]'); ?>
				</div>
				<?php
			}
			?>
		</div><!-- Container /- -->
	</div><!-- Appoinment Section /- -->	
	
	<?php
	
	return ob_get_clean();
}
add_shortcode('healthkare_appoinmentform', 'healthkare_appoinmentform');

if( function_exists('vc_map') ) {
	
	/**
	 * Add Shortcode To Visual Composer
	*/
	$healthkare_cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

	$healthkare_contactforms = array();
	
	if ( $healthkare_cf7 ) {
		foreach ( $healthkare_cf7 as $cform ) {
			$healthkare_contactforms[ $cform->post_title ] = $cform->ID;
		}
	} 
	else {
		$healthkare_contactforms[ esc_html__( 'No contact forms found', 'healthkare-toolkit' ) ] = 0;
	}
	vc_map( array(
		'base' => 'healthkare_appoinmentform',
		'name' => esc_html__( 'Appoinment Form', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Short Description Text', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select Contact Form', 'healthkare-toolkit' ),
				'param_name' => 'id',
				'value' => $healthkare_contactforms,
				'save_always' => true,
				'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'healthkare-toolkit' ),
			),
		),
	) );
}
?>