<?php
function healthkare_welcome( $atts ) {
	
	extract( shortcode_atts( array( 'sc_title_a' => '', 'sc_title_b' => '', 'sc_desc' => '', 'sc_desc_two' => '', 'sc_image' => ''  ), $atts ) );
	
	ob_start();
	
	?>
	<!-- Welcome Section -->
	<div class="welcome-section container-fluid no-left-padding no-right-padding">
		<div class="col-md-7 col-sm-7 col-xs-7 welcome-details">
			<?php
			if( $sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
				?>
				<!-- Section Header -->
				<div class="section-header">
					<?php
					if( $sc_title_a != "" || $sc_title_b != "" ) {
						?>
						<h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3>
						<?php
					}
					echo wpautop($sc_desc);
					?>
				</div><!-- Section Header /- -->
				<?php
			}
			?>
			<div class="welcome-content">
				<?php
					echo wpautop( wp_kses( $sc_desc_two, wp_kses_allowed_html() ) );

					if ( isset( $atts['plan_feature'] ) ) {
						?>
						<ul>
							<?php
								$result = "";
								$cnt = 1;
								foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {
									
									if( !empty( $value['feature_name'] ) ) {
										$result .="<li class='col-md-6 col-sm-6 col-xs-6'>".$value['feature_name']."</li>";
									}
									else {
										$result = "";
									}
									$cnt++;
								}
								echo html_entity_decode ($result);
							?>
						</ul>
						<?php
					}
				?>
			</div>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-5 welcome-img" data-image="<?php echo wp_get_attachment_url($sc_image,"full"); ?>"></div>
	</div><!-- Welcome Section /- -->
	<?php
	
	return ob_get_clean();
}

add_shortcode('healthkare_welcome', 'healthkare_welcome');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_welcome',
		'name' => esc_html__( 'Welcome', "healthkare-toolkit" ),
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
				'holder' => 'div',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Short Description Text', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text 2', "healthkare-toolkit" ),
				'param_name' => 'sc_desc_two',
			),
			array(
				'type' => 'param_group',
				'value' => '',
				'param_name' => 'plan_feature',
				'params' => array(
					array(
						'type' => 'textfield',
						'value' => '',
						'heading' => 'Feature Name',
						'param_name' => 'feature_name',
					),
				)
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', "healthkare-toolkit" ),
				'param_name' => 'sc_image',
			),
		),
	) );
}
?>