<?php
function healthkare_featurestwo_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'title' => '', 'desc' => '' ), $atts ) );

	$section_header = "";
	if( $title != "" || $desc != "") {
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses( $title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop( $desc );
		$section_header .= "</div>";
	}

	Global $j;

	preg_match_all( '/featurestwo_inner([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
	
	$result = "<div class='features-section container-fluid no-left-padding no-right-padding'>";
	
		$result .= "<div class='container'>";
		
			$result .= "$section_header";
			
			if( isset( $matches[1] ) && !empty( array_filter( $matches[1] ) ) ) {
				
				$result .= "<div class='row'>";
				
					$result .= "<div class='features-details-tab'>";
				
						$result .= "<div class='col-md-4 col-sm-12 col-xs-12'>";
						
							$result .= "<ul class='nav nav-tabs' role='tablist'>";
							
								$i = 1;
								
								foreach( $matches[1] as $block ) {
									
									$attr = shortcode_parse_atts( $block[0] );
									$tab_title = $attr['title'];
									$tab_icon = $attr['icon'];
									$tab_desc = $attr['desc'];
									$rep_title = sanitize_title( $attr['title'] );

									if( $i == 1 ) {
										$cls = ' class="active"';
									} else { $cls = ""; }

									$result .= "<li role='presentation'$cls><a href='#$rep_title' aria-controls='$rep_title' role='tab' data-toggle='tab'><i class='$tab_icon'></i>$tab_title</a></li>";

									$i++;
								}
							$result .= "</ul>";
							
						$result .= "</div>";
					
						$result .= "<div class='col-md-8 col-sm-12 col-xs-12'>";
						
							$result .= "<div class='tab-content'>";
							
								$result .= do_shortcode( $content );
								
							$result .= "</div>";
							
						$result .= "</div>";
					
					$result .= "</div>";
					
				$result .= "</div>";
			}
		$result .= "</div>";
		
	$result .= "</div>";

	return $result;
}
add_shortcode( 'featurestwo_outer', 'healthkare_featurestwo_outer' );

function healthkare_featurestwo_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'title' => '', 'desc' => '', 'icon'=>'','sc_image'=>'','sc_video'=>'', 'sc_videotxt'=>''), $atts ) );

	$rep_title = sanitize_title( $title );

	Global $j;

	if( $j == 0 ) {
		$cls = " active";
	} else { $cls = ""; }
	
	$result = "<div role='tabpanel' class='tab-pane$cls' id='$rep_title'>";
	
		$result  .= wpautop($desc);
		
		if ( isset( $atts['plan_feature'] ) ) {
			
			$result .= "<div class='col-md-5 col-sm-6 col-xs-6 no-left-padding'>";
			
				$result .= "<ul>";
				
					foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

						if( !empty( $value['feature_name'] ) ) {
							
							$result .= "<li>".$value['feature_name']."</li>";
						}
					}
					
				$result .= "</ul>";
			
			$result .= "</div>";
		}
		
		$result .= "<div class='col-md-7 col-sm-6 col-xs-6'>";
		
			$result .= "<div class='video-work'>";
			
				$result .= wp_get_attachment_image($sc_image, 'healthkare_419_276');
				
				$result .= "<div class='video-section'>";
				
					$result .= "<a class='popup-vimeo' href='".esc_url($sc_video)."'><i class='fa fa-play'></i></a>";
					
					$result .= "<span>$sc_videotxt</span>";
					
				$result .= "</div>";
				
			$result .= "</div>";
			
		$result .= "</div>";
		
	$result .= "</div>";

	$j++;

	return $result;
}
add_shortcode( 'featurestwo_inner', 'healthkare_featurestwo_inner' );

// Parent Element
function vc_featurestwo_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Features 2", "healthkare-toolkit"),
		"base" => "featurestwo_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'featurestwo_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "title",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Short Description", "healthkare-toolkit"),
				"param_name" => "desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_featurestwo_outer' );

// Nested Element
function vc_featurestwo_inner() {

	vc_map( array(
		"name" => esc_html__("Feature 2", "healthkare-toolkit"),
		"base" => "featurestwo_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'featurestwo_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "iconpicker",
				"heading" => esc_html__("Select Icon", "healthkare-toolkit"),
				"param_name" => "icon",
		
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "title",
		
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "desc",
			),
			array(
				'type' => 'param_group',
				'value' => '',
				'param_name' => 'plan_feature',
				// Note params is mapped inside param-group:
				'params' => array(
					array(
						'type' => 'textfield',
						'value' => '',
						'heading' => 'Feature Name',
						'param_name' => 'feature_name',
					)
				)
			),
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Background Image Video", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Video Link", "healthkare-toolkit"),
				"param_name" => "sc_video",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Video Text", "healthkare-toolkit"),
				"param_name" => "sc_videotxt",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_featurestwo_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Featurestwo_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Featurestwo_Inner extends WPBakeryShortCode {
    }
}
?>