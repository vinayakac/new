<?php
function healthkare_contactform( $atts ) {
	
	extract( shortcode_atts( array( 'sc_title_a' => '', 'sc_title_b' => '', 'sc_desc' => '', 'id'=> ''  ), $atts ) );
	
	ob_start();
	
	?>
	
	<!-- Contact Us -->
	<div class="contact-us container-fluid no-left-padding no-right-padding">
		<!-- Container -->
		<div class="container">
			<!-- Row -->
			<div class="row">
				<?php
				if( $sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
					?>
					<!-- Section Header -->
					<div class="section-header">
						<h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3>
						<?php echo wpautop($sc_desc); ?>
					</div><!-- Section Header /- -->
					<?php
				}
				echo do_shortcode('[contact-form-7 id="'.esc_attr( $id ).'"]');
				?>
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Contact Us /- -->
	
	<?php
	
	return ob_get_clean();
}

add_shortcode('healthkare_contactform', 'healthkare_contactform');

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
		'base' => 'healthkare_contactform',
		'name' => esc_html__( 'Contact Form', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(			
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
				'holder' => 'div',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text', "healthkare-toolkit" ),
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