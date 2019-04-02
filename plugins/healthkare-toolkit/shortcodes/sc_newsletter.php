<?php
function healthkare_newsletter( $atts, $content ) {
	
	extract( shortcode_atts( array( 'layout' => 'one', 'sc_bg' =>'', 'sc_title_a' => '', 'sc_title_b' => '' ), $atts ) );
	
	$style = "";
	if( $sc_bg != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$style = "";
	}
	
	ob_start();
	
	if( $layout == 'one' ){
		?>			
		<!-- Newsletter -->
		<div class="newsletter-section container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $style );?>>
			<!-- Container -->
			<div class="container">
				<!-- Row -->
				<div class="row">
					<?php
					if($sc_title_a != "" || $sc_title_b != "" ) {
						?>
						<div class="col-md-5 col-sm-6 col-xs-6 newsletter-title">
							<h3><strong><?php echo esc_attr($sc_title_a); ?></strong> <?php echo esc_attr($sc_title_b); ?></h3>
						</div>
						<?php
					}
					?>
					<div class="col-md-7 col-sm-6 col-xs-6 newsletter-form">
						<?php echo do_shortcode($content); ?>
					</div>
				</div><!-- Row /- -->
			</div><!-- Container /- -->
		</div><!-- Newsletter /- -->		
		<?php
	}
	elseif( $layout == 'two' ){
		?>
		<!-- Newsletter -->
		<div class="newsletter-section newsletter-section2 container-fluid no-left-padding no-right-padding" <?php echo html_entity_decode( $style );?>>
			<!-- Container -->
			<div class="container">
				<!-- Row -->
				<div class="row">
					<?php
					if($sc_title_a != "" || $sc_title_b != "" ) {
						?>
						<div class="col-md-5 col-sm-6 col-xs-6 newsletter-title">
							<h3><strong><?php echo esc_attr($sc_title_a); ?></strong> <?php echo esc_attr($sc_title_b); ?></h3>
						</div>
						<?php
					} ?>
					<div class="col-md-7 col-sm-6 col-xs-6 newsletter-form">
						<?php echo do_shortcode($content); ?>
					</div>
				</div><!-- Row /- -->
			</div><!-- Container /- -->
		</div><!-- Newsletter /- -->
		
		<?php
	}	
	return ob_get_clean();
}

add_shortcode('healthkare_newsletter', 'healthkare_newsletter');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_newsletter',
		'name' => esc_html__( 'News Letter', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select a Layout', "healthkare-toolkit" ),
				'param_name' => 'layout',
				'description' => esc_html__( 'Default Layout 1 Set', 'healthkare-toolkit' ),
				'value' => array(
					esc_html__( 'Layout 1', "healthkare-toolkit" ) => 'one',
					esc_html__( 'Layout 2', "healthkare-toolkit" ) => 'two',
				),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Newsletter Shortcode ID', "healthkare-toolkit" ),
				'param_name' => 'content',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
		),
	) );
}
?>