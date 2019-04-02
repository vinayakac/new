<?php
function healthkare_image( $atts ) {
	
	extract( shortcode_atts( array( 'sc_image' => '' ), $atts ) );
	
	if($sc_image != ""){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_image).");'";
	}
	else {
		$style = "";
	}
	
	ob_start();
	
	?>
	
	<div class="image-section"<?php echo html_entity_decode( $style ); ?>></div>
	
	<?php
	
	return ob_get_clean();
}

add_shortcode('healthkare_image', 'healthkare_image');

if( function_exists('vc_map') ) {
	
	vc_map( array(
		'base' => 'healthkare_image',
		'name' => esc_html__( 'Image', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', "healthkare-toolkit" ),
				'param_name' => 'sc_image',
			),
		),
	) );
}
?>