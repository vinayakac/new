<?php
function healthkare_callout( $atts ) {
	
	extract( shortcode_atts( array( 'layout' => 'one', 'sc_bg' => '', 'sc_title_a' => '', 'sc_title_b' => '', 'sc_title' => '', 'sc_subtitle' => '', 'sc_desc' => '', 'sc_bg_left' => '', 'sc_bg_right' => '', 'sc_btn_txtone' => '', 'sc_btn_txttwo' => '', 'sc_btn_urlone' => '', 'sc_btn_urltwo' => '', ), $atts ) );
	
	$style = "";
	if( $sc_bg_right != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg_right ).");'";
	}
	else{
		$style = "";
	}
	
	$bgstyle = "";
	if( $sc_bg != "" ){
		$bgstyle = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$bgstyle = "";
	}

	if( $sc_bg_left != "" ){
		$leftstyle = " style='background-image: url(".wp_get_attachment_url( $sc_bg_left ).");'";
	}
	else{
		$leftstyle = "";
	}
	
	ob_start();
	
	if( $layout == 'one' ){
		?>	
		<!-- Promo Section -->
		<div class="promo-section container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $bgstyle );?>>
			<!-- Container -->
			<div class="container">
				<div class="promo-content">
					<?php if($sc_title_a != "" || $sc_title_b != "" ) { ?><h5><?php echo esc_attr($sc_title_a) ?> <a href="<?php echo esc_url($sc_btn_urlone); ?>" title="<?php echo esc_attr($sc_btn_txtone); ?>"><?php echo esc_attr($sc_btn_txtone); ?></a> <?php echo esc_attr($sc_title_b) ?></h5><?php } ?>
					<?php echo wpautop($sc_desc); ?>
					<a href="<?php echo esc_url($sc_btn_urltwo); ?>" class="our-gallery" title="<?php echo esc_attr($sc_btn_txttwo); ?>"><?php echo esc_attr($sc_btn_txttwo); ?></a>
				</div>
			</div><!-- Container /- -->
		</div><!-- Promo Section/- -->
		<?php
	}
	elseif( $layout == 'two' ){
		?>
		<!-- Consultation Section -->
		<div class="consultation-section container-fluid no-left-padding no-right-padding">
			<?php if($sc_bg_left != "") { ?><div class="col-md-5 col-sm-6 col-xs-6 no-padding consultation-img"<?php echo html_entity_decode( $leftstyle );?> ></div><?php } ?>
			<div class="col-md-7 col-sm-6 col-xs-6 consultation-img-right"<?php echo html_entity_decode( $style );?>>
				<div class="consultation-content">
					<?php if($sc_subtitle != "") { ?><h5><?php echo esc_attr($sc_subtitle); ?></h5><?php } ?>
					<?php if($sc_title != "") { ?><h3><?php echo esc_attr($sc_title); ?></h3><?php } ?>
					<?php echo wpautop($sc_desc); ?>
					<?php if($sc_btn_txtone != "") { ?><a href="<?php echo esc_url($sc_btn_urlone); ?>" title="<?php echo esc_attr($sc_btn_txtone); ?>" class="contact-link"><?php echo esc_attr($sc_btn_txtone); ?></a><?php } ?>
					<?php if($sc_btn_txttwo != "") { ?><a href="<?php echo esc_url($sc_btn_urltwo); ?>" title="<?php echo esc_attr($sc_btn_txttwo); ?>" class="contact-link view-more"><?php echo esc_attr($sc_btn_txttwo); ?></a><?php } ?>
				</div>
			</div>
		</div><!-- Consultation Section /- -->
		<?php
	}
	return ob_get_clean();
}

add_shortcode('healthkare_callout', 'healthkare_callout');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_callout',
		'name' => esc_html__( 'CallOut', "healthkare-toolkit" ),
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
				'heading' => esc_html__( 'Background Image Left Side', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
				"dependency" => Array('element' => "layout", 'value' => array( 'one' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
				"dependency" => Array('element' => "layout", 'value' => array( 'one' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
				"dependency" => Array('element' => "layout", 'value' => array( 'one' ) ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image Left Side', "healthkare-toolkit" ),
				'param_name' => 'sc_bg_left',
				"dependency" => Array('element' => "layout", 'value' => array( 'two' ) ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image Right Side', "healthkare-toolkit" ),
				'param_name' => 'sc_bg_right',
				"dependency" => Array('element' => "layout", 'value' => array('two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', "healthkare-toolkit" ),
				'param_name' => 'sc_title',
				"dependency" => Array('element' => "layout", 'value' => array( 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Sub Title', "healthkare-toolkit" ),
				'param_name' => 'sc_subtitle',
				"dependency" => Array('element' => "layout", 'value' => array( 'two' ) ),
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text 1', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_txtone',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button URL 1', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_urlone',
				"dependency" => Array('element' => "layout", 'value' => array( 'one', 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text 2', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_txttwo',
				"dependency" => Array('element' => "layout", 'value' => array(  'one', 'two' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button URL 2', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_urltwo',
				"dependency" => Array('element' => "layout", 'value' => array(  'one', 'two') ),
			),
		),
	) );
}
?>