<?php
/* Redux Options */
if( !function_exists('healthkare_options') ) :

	function healthkare_options( $option, $arr = null ) {

		global $healthkare_option;

		if( $arr ) {

			if( isset( $healthkare_option[$option][$arr] ) ) {
				return $healthkare_option[$option][$arr];
			}
		}
		else {
			if( isset( $healthkare_option[$option] ) ) {
				return $healthkare_option[$option];
			}
		}
	}

endif;

/********************************************************/

if( ! function_exists('healthkare_add_allowed_tags') ) {

	function healthkare_add_allowed_tags( $tags ) {
	
		$tags['h1'] = array( 'class' => array(), 'style' => array() );
		$tags['h2'] = array( 'class' => array(), 'style' => array() );
		$tags['h3'] = array( 'class' => array(), 'style' => array() );
		$tags['h4'] = array( 'class' => array(), 'style' => array() );
		$tags['h5'] = array( 'class' => array(), 'style' => array() );
		$tags['h6'] = array( 'class' => array(), 'style' => array() );
		$tags['em'] = array( 'class' => array(), 'style' => array() );
		$tags['li'] = array( 'class' => array(), 'style' => array() );
		$tags['ul'] = array( 'class' => array(), 'style' => array() );		
		$tags['ol'] = array( 'class' => array(), 'style' => array() );
		$tags['p'] = array( 'class' => array(), 'style' => array() );
		$tags['span'] = array( 'class' => array(), 'style' => array() );
		$tags['ins'] = array( 'datetime' => array() );
		$tags['img'] = array( 'class' => array(), 'src' => array(), 'alt' => array(), 'style' => array() );
		$tags['a'] = array( 'class' => array(), 'href' => array(), 'target' => array(), 'title' => array(), 'style' => array() );
	
		return $tags;
	}
	add_filter('wp_kses_allowed_html', 'healthkare_add_allowed_tags');
}

/********************************************************/

if( ! function_exists("healthkare_wp_query") ) {

	function healthkare_wp_query( array $qry_args = array() ) {
		global $wp_query;
		wp_reset_query();
		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		$defaults = array(
			'paged'	=> $paged,
			'posts_per_page' => 10
		);
		$qry_args += $defaults;
		$wp_query = new WP_Query( $qry_args );
	}
}

/* ************************************************************************ */

if( !function_exists('healthkare_remove_excerpt') )  {

  function healthkare_remove_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
  
}

/* ************************************************************************ */

if( !function_exists('healthkare_excerpt') ) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function healthkare_excerpt($excerpt_length = 30) {
 
		global $post;
	 
		$word_count =  "";
	 
		$word_count = isset($word_count) && $word_count != "" ? $word_count : $excerpt_length;
	 
		$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '[...]') ? strstr($post_excerpt, '[...]', true) : $post_excerpt;
	 
		/** add by PR */
		if( $clean_excerpt != "" ) {
			
			$clean_excerpt = strip_shortcodes( healthkare_remove_excerpt($clean_excerpt) );
		 
			/** end PR mod */
		 
			$excerpt_word_array = explode (' ',$clean_excerpt);		 
			$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
 			
			$excerpt = implode(' ', $excerpt_word_array );
			
			if( $excerpt != "" ) {
				echo ''.$excerpt.' [...]';
			}
		}
 
	}
}
?>