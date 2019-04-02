<?php
function healthkare_blog( $atts ) {
	
	extract( shortcode_atts( array( 'layout' => 'one', 'sc_title_a' => '', 'sc_title_b' => '', 'sc_desc' => '', 'posts_display' => '' ), $atts ) );
	
	if( '' === $posts_display ) :
		$posts_display = 3;
	endif;
	
	$qry = new WP_Query( array(
		'post_type'=> 'post',
		'posts_per_page' => $posts_display,
	) );
	
	ob_start();
	
	if( $layout == 'one' ){
		?>
		<!-- Latest News -->
		<div class="blog-section latest-news container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
					if( $sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
					if(  $qry->have_posts() ) {
						?>
						<!-- Row -->
						<div class="row">
							<?php
								while ( $qry->have_posts() ) : $qry->the_post();
									$css = "";
									if( ! has_post_thumbnail() ) {
										$css = " no-post-thumbnail";
									}
									?>
									<div class="col-md-4 col-sm-6 col-xs-6">
										<article <?php post_class($css . "" ); ?>>
											<div class="entry-cover">
												<?php
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
																		<?php echo wp_get_attachment_image( $attachment_id, 'healthkare_370_250' ); ?>
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
															<?php the_post_thumbnail('healthkare_370_250'); ?>
														</a>
														<?php
													}
												?>
												<div class="entry-header">
													<h3 class="entry-title">
														<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
															<?php echo wp_trim_words( get_the_title(), 10, '…'); ?>
														</a>
													</h3>
												</div>
												<div class="post-date"><a href="<?php the_permalink(); ?>"><p><?php echo get_the_date('j'); ?></p> <span><?php echo get_the_date('M'); ?></span></a></div>
											</div>
											<div class="entry-meta">
												<div class="byline">
													<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>">
														<i class="fa fa-user"></i><?php the_author(); ?>
													</a>
												</div>
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
												<?php
													if( function_exists('healthkare_get_simple_likes_button') )	 {
														?>
														<div class="post-like">
															<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
														</div>
														<?php
													}
												?>
											</div>
										</article>
									</div>
									<?php
									endwhile;
									
								// Reset Post Data
								wp_reset_postdata();
							?>
						</div><!-- Row /- -->
						<?php
					}
				?>
			</div><!-- Container /- -->
		</div><!-- Latest News /- -->
		
		<?php
	}
	elseif( $layout == 'two' ){
		?>	
		<!-- Latest News2 -->
		<div class="blog-section latest-news latest-news2 container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header2">
							<h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header -->
						<?php
					}
					if( $qry->have_posts() ) {
						?>
						<!-- Row -->
						<div class="row">
							<?php
								while ( $qry->have_posts() ) : $qry->the_post();
									$css = "";
									if( ! has_post_thumbnail() ) {
										$css = " no-post-thumbnail";
									}
									?>
									<div class="col-md-4 col-sm-6 col-xs-6">
										<article <?php post_class($css . "" ); ?>>
											<div class="entry-cover">
												<?php
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
																		<?php echo wp_get_attachment_image( $attachment_id, 'healthkare_370_250' ); ?>
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
															<?php the_post_thumbnail('healthkare_370_250'); ?>
														</a>
														<?php
													}
												?>
												<div class="entry-header">
													<h3 class="entry-title">
														<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
															<?php echo wp_trim_words( get_the_title(), 10, '…'); ?>
														</a>
													</h3>
												</div>
												<div class="post-date"><a href="<?php the_permalink(); ?>"><p><?php echo get_the_date('j'); ?></p> <span><?php echo get_the_date('M'); ?></span></a></div>
											</div>
											<div class="entry-content">
												<p><?php healthkare_excerpt(25); ?></p>
											</div>
											<div class="entry-meta">
												<div class="byline">
													<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><i class="fa fa-user"></i><?php the_author(); ?></a>
												</div>
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
												<?php
													if( function_exists('healthkare_get_simple_likes_button') )	 {
														?>
														<div class="post-like">
															<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
														</div>
														<?php
													}
												?>
											</div>
										</article>
									</div>
									<?php
								endwhile;
									
								// Reset Post Data
								wp_reset_postdata();
							?>
						</div><!-- Row /- -->
						<?php
					}
				?>
			</div><!-- Container /- -->
		</div><!-- Latest News2 -->
		
		<?php
	}
	elseif( $layout == 'three' ) {
		?>	
		<!-- Latest News3 -->
		<div class="blog-section latest-news latest-news3 container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header3">
							<h3><?php echo esc_attr($sc_title_a); ?> <strong> <?php echo esc_attr($sc_title_b); ?></strong></h3>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
				?>
				<!-- Row -->
				<div class="row">
					<?php
						while ( $qry->have_posts() ) : $qry->the_post();
							$css = "";
							if( ! has_post_thumbnail() ) {
								$css = " no-post-thumbnail";
							}
							?>
							<div class="col-md-4 col-sm-6 col-xs-6">
								<article <?php post_class($css . "" ); ?>>
									<div class="entry-cover">
										<?php
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
																<?php echo wp_get_attachment_image( $attachment_id, 'healthkare_370_290' ); ?>
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
													<?php the_post_thumbnail('healthkare_370_290'); ?>
												</a>
												<?php
											}
										?>
										<div class="entry-header">
											<h3 class="entry-title">
												<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
													<?php echo wp_trim_words( get_the_title(), 10, '…'); ?>
												</a>
											</h3>
										</div>
									</div>
									<div class="entry-content">
										<p><?php healthkare_excerpt(25); ?></p>
									</div>
									<div class="entry-meta">
										<div class="post-date">
											<a href="<?php the_permalink(); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></a>
										</div>
										<div class="byline">
											<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php the_author(); ?>"><i class="fa fa-user"></i><?php the_author(); ?></a>
										</div>
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
									</div>
								</article>
							</div>
							<?php
						endwhile;
							
						// Reset Post Data
						wp_reset_postdata();
					?>
				</div><!-- Row /- -->
			</div><!-- Container /- -->
		</div><!-- Latest News3 -->
		<?php
	}
	return ob_get_clean();
}

add_shortcode('healthkare_blog', 'healthkare_blog');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_blog',
		'name' => esc_html__( 'Blog', "healthkare-toolkit" ),
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
					esc_html__( 'Layout 3', "healthkare-toolkit" ) => 'three',
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three' ) ),
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three' ) ),
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Post Per Page Display", "healthkare-toolkit"),
				"param_name" => "posts_display",
				"holder" => "div",
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three' ) ),
			),		
		),
	) );
}
?>