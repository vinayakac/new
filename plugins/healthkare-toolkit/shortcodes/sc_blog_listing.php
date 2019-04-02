<?php
function healthkare_blog_listing( $atts ) {
	
	extract( shortcode_atts( array( 'sc_layout' => 'one' ), $atts ) );
	
	ob_start();
	
	if($sc_layout == "one") {
		query_posts('posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged') );
			
		if ( have_posts() ) {
			?>
			<div class="blog-listing blog-section2 latest-news">
				<div class="row">
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();
							$css = "";
							if( ! has_post_thumbnail() ) {
								$css = "no-post-thumbnail";
							}
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class($css); ?>>
							<div class="col-md-5 col-sm-6 col-xs-6">
								<div class="entry-cover">
									<?php
										if ( is_sticky() && is_home() ) {
											?><span class="sticky-post"><?php esc_html_e( 'Featured', "healthkare" ); ?></span><?php
										}
										if( get_post_format() == "gallery" && count( get_post_meta( get_the_ID(), 'healthkare_cf_post_gallery', 1 ) ) > 0 && is_array( get_post_meta( get_the_ID(), 'healthkare_cf_post_gallery', 1 ) ) ) {
											?>
											<!-- Carousel -->
											<div id="blog-carousel-<?php echo esc_attr(the_ID()); ?>" class="carousel slide" data-ride="carousel">
												<div class="carousel-inner" role="listbox">
													<?php
													$active=1;
													foreach ( (array) get_post_meta( get_the_ID(), 'healthkare_cf_post_gallery', 1 ) as $attachment_id => $attachment_url ) {
														?>
														<div class="item<?php if( $active == 1 ) { echo ' active'; } ?>">
															<?php echo wp_get_attachment_image( $attachment_id, 'healthkare_335_310' ); ?>
														</div>
														<?php
														$active++;
													} ?>
												</div>
												<a title="Previous" class="left carousel-control" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="prev">
													<span class="fa fa-chevron-left" aria-hidden="true"></span>
												</a>
												<a title="Next" class="right carousel-control" href="#blog-carousel-<?php echo esc_attr(the_ID()); ?>" role="button" data-slide="next">
													<span class="fa fa-chevron-right" aria-hidden="true"></span>
												</a>
											</div><!-- /.carousel -->
											<?php
										}
										if( get_post_format() == "audio" ) {
											if( get_post_meta( get_the_ID(), 'healthkare_cf_post_audio_source', 1 ) == "soundcloud_link" && get_post_meta( get_the_ID(), 'healthkare_cf_post_soundcloud_url', 1 ) != "" ) {
												?>
												<iframe src="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_post_soundcloud_url', 1 ) ); ?>"></iframe>
												<?php
											}
											elseif( get_post_meta( get_the_ID(), 'healthkare_cf_post_audio_source', 1 ) == "audio_upload_local" && get_post_meta( get_the_ID(), 'healthkare_cf_post_audio_local', 1 ) != "" ) {
												?>
												<audio controls>
													<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_post_audio_local', 1 ) ); ?>" type="audio/mpeg">
													<?php esc_html_e("Your browser does not support the audio element.","healthkare-toolkit"); ?>
												</audio>
												<?php
											}
										}
										if( get_post_format() == "video" ) {
											if( get_post_meta( get_the_ID(), 'healthkare_cf_post_video_source', 1 ) == "video_link" && get_post_meta( get_the_ID(), 'healthkare_cf_post_video_link', 1 ) != "" ) {
												echo wp_oembed_get( esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_post_video_link', true ) ) );
											}
											elseif( get_post_meta( get_the_ID(), 'healthkare_cf_post_video_source', 1 ) == "video_embed_code" && get_post_meta( get_the_ID(), 'healthkare_cf_post_video_embed', 1 ) != "" ) {
												echo get_post_meta( get_the_ID(), 'healthkare_cf_post_video_embed', 1 );
											}
											elseif( get_post_meta( get_the_ID(), 'healthkare_cf_post_video_source', 1 ) == "video_upload_local" && get_post_meta( get_the_ID(), 'healthkare_cf_post_video_local', 1 ) != "" ) {
												?>
												<video controls>
													<source src="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_post_video_local', 1 ) ); ?>" type="video/mp4">
													<?php esc_html_e("Your browser does not support the video tag.","healthkare-toolkit"); ?>
												</video> 
												<?php
											}
										}
										if( has_post_thumbnail() && ( get_post_format() != "audio" && get_post_format() != "video" && get_post_format() != "gallery" ) ) {
											?>
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('healthkare_335_310'); ?>
											</a>
											<?php
										}
									?>
									<div class="post-date"><a href="<?php the_permalink(); ?>"><p><?php echo get_the_date('j'); ?></p> <span><?php echo get_the_date('M'); ?></span></a></div>
								</div>
							</div>
							<div class="col-md-7 col-sm-6 col-xs-6">
								<div class="entry-header">
									<h3 class="entry-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								</div>
								<div class="entry-content">
									<p><?php healthkare_excerpt(25); ?></p>
								</div>
								<div class="entry-meta">
									<div class="byline"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a><i class="fa fa-user"></i><?php esc_html_e('By ',"healthkare-toolkit"); ?></div>
									<div class="post-comment">
										<a href="<?php comments_link(); ?>">
											<i class="fa fa-comments-o"></i>
											<?php 
												comments_number( 
													esc_html__('0 Comment',"healthkare-toolkit"),
													esc_html__('1 Comment',"healthkare-toolkit"),
													esc_html__('% Comments',"healthkare-toolkit")
												);
											?>
										</a>
									</div>
									<div class="post-share">
										<span><i class="fa fa-share-alt"></i><?php esc_html_e('Share',"healthkare-toolkit"); ?></span>
										<ul class="social-share">
											<li><a href="javascript: void(0)" data-action="facebook" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-facebook"></i></a></li>
											<li><a href="javascript: void(0)" data-action="twitter" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-twitter"></i></a></li>
											<li><a href="javascript: void(0)" data-action="linkedin" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-linkedin"></i></a></li>
											<li><a href="javascript: void(0)" data-action="google-plus" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="javascript: void(0)" data-action="linkedin" data-title="<?php the_title(); ?>" data-url="<?php echo esc_url(the_permalink()); ?>"><i class="fa fa-linkedin"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</article>
						<?php
					// End the loop.
					endwhile;
					
					// Previous/next page navigation.				
					the_posts_pagination( array(
						'prev_text'          => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Prev', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
						'next_text'          => wp_kses( __( 'Next <i class="fa fa-angle-double-right"></i>', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "healthkare-toolkit" ) . ' </span>',
					) );		
					
					// Reset Query
					wp_reset_query();
					
					?>
				</div>
			</div>
			<?php
		}
	}
	elseif($sc_layout == 'two') {
		query_posts('posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged') );
		
		if ( have_posts() ) {
			?>
			<div class="blog-listing">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( "template-parts/content",get_post_format());

				// End the loop.
				endwhile;
				
				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Prev', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
					'next_text'          => wp_kses( __( 'Next <i class="fa fa-angle-double-right"></i>', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "healthkare-toolkit" ) . ' </span>',
				) );		
				
				// Reset Query
				wp_reset_query();
				?>
			</div>
			<?php
		}
	}
	
	return ob_get_clean();
}

add_shortcode('healthkare_blog_listing', 'healthkare_blog_listing');

if( function_exists('vc_map') ) {
	
	vc_map( array(
		'base' => 'healthkare_blog_listing',
		'name' => esc_html__( 'Blog Listing', "healthkare-toolkit" ),
		'class' => '',
		"category" => esc_html__("Healthkare Theme", "healthkare-toolkit"),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select a Layout', "healthkare-toolkit" ),
				'param_name' => 'sc_layout',
				'description' => esc_html__( 'Default Layout 1 Set', 'healthkare-toolkit' ),
				'value' => array(
					esc_html__( 'Layout 1', "healthkare-toolkit" ) => 'one',
					esc_html__( 'Layout 2', "healthkare-toolkit" ) => 'two',
				),
			),
			array(
				'type' => 'info',
				'heading' => esc_html__( 'No Need To Settings', "healthkare-toolkit" ),
				'param_name' => 'label',
				'holder' => 'div',
			),
			
		),
	) );
}
?>