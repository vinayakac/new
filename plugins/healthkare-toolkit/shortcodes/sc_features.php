<?php
function healthkare_features( $atts, $content) {
	
	extract( shortcode_atts( array( 'sc_image' => '', 'sc_title_a' => '', 'sc_title_b' => '','sc_desc' => '', 'sc_btn_txt' => '', 'sc_btn_url' => '' ), $atts ) );
	
	ob_start();
	
	?>
	
	<!-- Mission Section -->
	<div class="mission-section container-fluid no-left-padding no-right-padding">
		<div class="mission-details">
			<?php
			if( $sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
				?>
				<!-- Section Header -->
				<div class="section-header">
					<?php if( $sc_title_a != "" || $sc_title_b != "" ) { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
					<?php echo wpautop($sc_desc); ?>
				</div><!-- Section Header /- -->
				<?php
			}
			?>
			<div class="features-details">
				<?php
				if ( isset( $atts['plan_feature'] ) ) {
					?>
					<ul>
						<?php
							$result = "";
							$cnt = 1;
							foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {
								
								if( !empty( $value['feature_name'] ) ) {
									$result .="<li class='col-md-6 col-sm-6 col-xs-6'>".esc_attr( $value['feature_name'] )."</li>";
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
				if( $sc_btn_txt != "" ) {
					?><a href="<?php echo esc_url($sc_btn_url); ?>" class="read-more" title="<?php echo esc_attr($sc_btn_txt); ?>"><?php echo esc_attr($sc_btn_txt); ?><i class="fa fa-long-arrow-right"></i></a>
					<?php
				}
				?>
			</div>
		</div>
	</div><!-- Mission Section /- -->
	
	<?php
	
	return ob_get_clean();
}

add_shortcode('healthkare_features', 'healthkare_features');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_features',
		'name' => esc_html__( 'Features', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Short Description', "healthkare-toolkit" ),
				'param_name' => 'sc_desc'
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
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_txt',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button URL', "healthkare-toolkit" ),
				'param_name' => 'sc_btn_url',
			),
			
		),
	) );
}
?>