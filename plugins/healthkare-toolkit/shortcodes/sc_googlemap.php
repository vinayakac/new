<?php
function healthkare_googlemap( $atts ) {
	
	extract( shortcode_atts( array( 'vc_map_lati' => '','vc_map_longi' => '', 'vc_address' => '', 'vc_zoomlevel' => '', 'vc_marker' => '' ), $atts ) );
	
	if( '' === $vc_zoomlevel ) {
		$vc_zoomlevel = 10;
	}
	
	ob_start();
	
	if($vc_map_lati != "" || $vc_map_longi != "" ) {
		?>
		<!-- Map Section -->
		<div class="map container-fluid no-left-padding no-right-padding">
			<div id="map-canvas-contact" class="map-canvas" data-lat="<?php echo esc_attr($vc_map_lati); ?>" data-lng="<?php echo esc_attr($vc_map_longi); ?>" data-marker="<?php if($vc_marker != "" ){ echo esc_url(wp_get_attachment_url($vc_marker,"full")); } else { echo esc_url( HEALTHKARE_LIB ).'images/marker.png'; }?>" data-string="<?php echo esc_html( $vc_address ); ?>" data-zoom="<?php echo esc_attr($vc_zoomlevel); ?>"></div>
		</div><!--  Map Section /- -->
		<?php
	}
	
	return ob_get_clean();
}

add_shortcode('healthkare_googlemap', 'healthkare_googlemap');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_googlemap',
		'name' => esc_html__( 'Google Map', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Latitute', "healthkare-toolkit" ),
				'param_name' => 'vc_map_lati',
				"description" => esc_html("e.g : 40.712784", "healthkare-toolkit"),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Longitute', "healthkare-toolkit" ),
				'param_name' => 'vc_map_longi',
				"description" => esc_html("e.g : -74.005941", "healthkare-toolkit"),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Marker Address', "healthkare-toolkit" ),
				'param_name' => 'vc_address',
				"description" => esc_html("e.g : 7307 San Pablo Drive South Ozone, NY 11420", "healthkare-toolkit"),
				'holder' => 'div',
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Map ZoomLevel", "healthkare-toolkit"),
				"param_name" => "vc_zoomlevel",
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Marker Image', "healthkare-toolkit" ),
				'param_name' => 'vc_marker',
			),
		),
	) );
}
?>