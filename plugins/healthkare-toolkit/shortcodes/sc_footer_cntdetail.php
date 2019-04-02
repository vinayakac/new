<?php
function healthkare_footer_cntdetail( $atts ) {
	
	extract( shortcode_atts( array( 'sc_address' => '', 'sc_phone_one' => '', 'sc_phone_two' => '', 'sc_email_one' => '', 'sc_email_two' => '', 'fb_url' => '', 'ln_url' => '','gp_url' => '','tw_url' => '',), $atts ) );
	
	ob_start();
	
	?>
	
	<!-- Contact Details -->
	<div class="contact-details container-fluid no-left-padding no-right-padding">
		<!-- Container -->
		<div class="container">
			<div class="contact-box">
				<?php
				if($sc_address != "" ) {
					?>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="contact-info">
							<i class="icon icon-Pointer"></i>
							<?php echo wpautop($sc_address); ?>
						</div>
					</div>
					<?php
				}
				if($sc_phone_one != "" || $sc_phone_two != "" ) {
					?>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="contact-info">
							<i class="icon icon-Phone2"></i>
							<p><a href="tel:<?php echo esc_html(str_replace(" ", "", $sc_phone_one ) ); ?>" title="<?php echo esc_attr($sc_phone_one); ?>" class="phone"><?php echo esc_attr($sc_phone_one); ?></a></p>
							<p><a href="tel:<?php echo esc_html(str_replace(" ", "", $sc_phone_two ) ); ?>" title="<?php echo esc_attr($sc_phone_two); ?>" class="phone"><?php echo esc_attr($sc_phone_two); ?></a></p>
						</div>
					</div>
					<?php
				}
				if($sc_email_one != "" || $sc_email_two != "" ) {
					?>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="contact-info">
							<i class="icon icon-Mail"></i>
							<p><a href="mailto:<?php echo esc_attr($sc_email_one); ?>" title="<?php echo esc_attr($sc_email_one); ?>"><?php echo esc_attr($sc_email_one); ?></a></p>
							<p><a href="mailto:<?php echo esc_attr($sc_email_two); ?>" title="<?php echo esc_attr($sc_email_two); ?>"><?php echo esc_attr($sc_email_two); ?></a></p>
						</div>
					</div>
					<?php
				}
				if($fb_url != "" || $ln_url != "" || $gp_url != "" || $tw_url != "" ) { 
					?>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<ul class="contact-socials">
							<?php if($fb_url != "") { ?><li><a href="<?php echo esc_url($fb_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
							<?php if($ln_url != "") { ?><li><a href="<?php echo esc_url($ln_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
							<?php if($gp_url != "") { ?><li><a href="<?php echo esc_url($gp_url); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
							<?php if($tw_url != "") { ?><li><a href="<?php echo esc_url($tw_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
						</ul>
					</div>
					<?php
				}
				?>
			</div>
		</div><!-- Container /- -->
	</div><!-- Contact Details /- -->
	<?php
	
	return ob_get_clean();
}
add_shortcode('healthkare_footer_cntdetail', 'healthkare_footer_cntdetail');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_footer_cntdetail',
		'name' => esc_html__( 'Contact Details', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Address', "healthkare-toolkit" ),
				'param_name' => 'sc_address',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Phone Number 1', "healthkare-toolkit" ),
				'param_name' => 'sc_phone_one',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Phone Number 2', "healthkare-toolkit" ),
				'param_name' => 'sc_phone_two',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Email 1', "healthkare-toolkit" ),
				'param_name' => 'sc_email_one',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Email 2', "healthkare-toolkit" ),
				'param_name' => 'sc_email_two',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Facebook URL', "healthkare-toolkit" ),
				'param_name' => 'fb_url',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Linkedin URL', "healthkare-toolkit" ),
				'param_name' => 'ln_url',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Google Plus URL', "healthkare-toolkit" ),
				'param_name' => 'gp_url',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Twitter URL', "healthkare-toolkit" ),
				'param_name' => 'tw_url',
			),
		),
	) );
}
?>