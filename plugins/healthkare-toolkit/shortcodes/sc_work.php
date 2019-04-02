<?php
function healthkare_work( $atts ) {
	
	extract( shortcode_atts( array('sc_bg' => '', 'sc_title_a' => '', 'sc_title_b' => '','sc_desc' => '', 'sc_video_url' => '','sc_video_txt' => '',), $atts ) );
	
	$style = "";
	if( $sc_bg != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$style = "";
	}
	
	ob_start();
	
	?>
	<!-- Work Section -->
	<div class="work-section container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $style );?>>
		<!-- Container -->
		<div class="container">
			<?php
			if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
				?>
				<!-- Section Header -->
				<div class="section-header">
					<?php if($sc_title_a != "" || $sc_title_b != "" ) { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
					<?php echo wpautop($sc_desc); ?>
				</div><!-- Section Header /- -->
				<?php
			}
			?>
			<div class="video-section">
				<?php if($sc_video_url != "" ) { ?><a class="popup-vimeo" href="<?php echo esc_url($sc_video_url); ?>"><i class="fa fa-play"></i></a><?php } ?>
				<?php if($sc_video_txt != "" ) { ?><span><?php echo esc_attr($sc_video_txt); ?></span><?php } ?>
			</div>
		</div><!-- Container /- -->
	</div><!-- Work Section /- -->
	<?php
	return ob_get_clean();
}
add_shortcode('healthkare_work', 'healthkare_work');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_work',
		'name' => esc_html__( 'Work', "healthkare-toolkit" ),
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
				'heading' => esc_html__( 'Description Text', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video URL', "healthkare-toolkit" ),
				'param_name' => 'sc_video_url',
				'description' => esc_html__('Example For:: https://vimeo.com/139358538',"healthkare-toolkit"),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Video Text', "healthkare-toolkit" ),
				'param_name' => 'sc_video_txt',
			),
		),
	) );
}
?>