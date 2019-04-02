<?php
function healthkare_gallery( $atts ) {
	
	extract( shortcode_atts( array( 'layout' => 'one', 'sc_bg'=> '', 'sc_title_a' => '', 'sc_title_b' => '', 'sc_desc' => '', 'posts_display' => '' ), $atts ) );
	
	
	if($sc_bg != ""){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else {
		$style = "";
	}
	
	$ow_post_type = 'hk_treatments';
	$ow_post_tax = 'healthkare_treatments_tax';
	
	$tax_args = array(
		'hide_empty' => false
	);

	if( '' === $posts_display ) :
		$posts_display = 12;	
		
	endif;
	
	$qry = new WP_Query( array(
		'post_type' => $ow_post_type,
		'posts_per_page' => $posts_display,
	) );
	
	$unexpected_str = array(" ","&","amp;",",",".","/");
	$terms = get_terms( $ow_post_tax, $tax_args );
	
	ob_start();
	
	if( $layout == 'one' ){
		?>			
		<!-- Gallery Section -->
		<div class="gallery-section container-fluid no-left-padding no-right-padding">
			<div class="gallery-header container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $style ); ?>>
				<!-- Container -->
				<div class="container">
					<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "") {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
					?>
					
					<ul id="filters" class="portfolio-categories no-left-padding">
						<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
						<?php
							if ( count( $terms > 0 ) && is_array( $terms ) ) {
								foreach ( $terms as $term ) {
									$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
									?>
									<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
									<?php
								}
							}
						?>
					</ul>
				</div><!-- Container /- -->
			</div>
			<!-- Container -->
			<div class="container">
				<div class="row">
					<ul class="portfolio-list no-left-padding">
						<?php
							while ( $qry->have_posts() ) : $qry->the_post();
								$taxonomies = "";
								$terms = get_the_terms( get_the_ID(), $ow_post_tax );
								$termsname = array();
								$terms_dashed = array();
								if ( count( $terms > 0 ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$termsname[] = strtolower( $term->name );
										$unexpected_str = array(" ","&","amp;",",",".","/");
										$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
									}
									$taxonomies = implode(" ", $terms_dashed );
									$taxonomies_plus = implode(" + ", $termsname );
								}
								?>
								<li class="col-md-3 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
									<div class="content-image-block">
										<?php
											$url = "";
											$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
											
											if($url != "" ) {
												echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
											}
											else {
												the_post_thumbnail("healthkare_270_240");
											}
										?>
										<div class="content-block-hover">
											<?php
												if( function_exists('healthkare_get_simple_likes_button') )	 {
													?>
													<div class="post-like">
														<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
													</div>
													<?php
												}
												if($url != "" ) {
													?>
													<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
												else {
													?>
													<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
											?>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										</div>
									</div>
								</li>
								<?php
						endwhile;
					/* Reset Post Data */
					wp_reset_postdata();
					
					?>
					</ul>
				</div>
			</div><!-- Container /- -->
		</div><!-- Gallery Section /- -->		
		<?php
	}
	elseif( $layout == 'two' ){
		?>	
		<!-- Gallery Section -->
		<div class="gallery-section gallery-section2 container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
				if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
					?>
					<!-- Section Header -->
					<div class="section-header2">
						<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
						<?php echo wpautop($sc_desc); ?>
					</div><!-- Section Header /- -->
					<?php
				}
				?>
				
				<ul id="filters" class="portfolio-categories no-left-padding">
					<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
					<?php
						if ( count( $terms > 0 ) && is_array( $terms ) ) {
							foreach ( $terms as $term ) {
								$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
								?>
								<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
								<?php
							}
						}
					?>
				</ul>
			</div><!-- Container /- -->
			<ul class="portfolio-list no-left-padding">
				<?php
					while ( $qry->have_posts() ) : $qry->the_post();
						$taxonomies = "";
						$terms = get_the_terms( get_the_ID(), $ow_post_tax );
						$termsname = array();
						$terms_dashed = array();
						if ( count( $terms > 0 ) && is_array( $terms ) ) {
							foreach ( $terms as $term ) {
								$termsname[] = strtolower( $term->name );
								$unexpected_str = array(" ","&","amp;",",",".","/");
								$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
							}
							$taxonomies = implode(" ", $terms_dashed );
							$taxonomies_plus = implode(" + ", $termsname );
						}
						?>
						<li class="col-md-3 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
							<div class="content-image-block">
								<?php
									$url = "";
									$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
									
									if($url != "" ) {
										echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
									}
									else {
										the_post_thumbnail("healthkare_373_373");
									}
								?>
								<div class="content-block-hover">
									<?php
										if( function_exists('healthkare_get_simple_likes_button') )	 {
											?>
											<div class="post-like">
											
												<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
											</div>
											<?php
										}
										if($url != "" ) {
											?>
											<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
												<i class="fa fa-arrows-alt"></i>
											</a>
											<?php
										}
										else {
											?>
											<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
												<i class="fa fa-arrows-alt"></i>
											</a>
											<?php
										}
									?>
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								</div>
							</div>
						</li>
						<?php
					endwhile;
					/* Reset Post Data */
					wp_reset_postdata();
					
				?>
			</ul>
		</div><!-- Gallery Section /- -->
		<?php
	}
	elseif( $layout == 'three' ) {
		?>	
		<!-- Gallery Section3 -->
		<div class="gallery-section gallery-section3 skyblue-gallery container-fluid no-left-padding no-right-padding">
			<div class="gallery-header container-fluid no-left-padding no-right-padding"<?php echo html_entity_decode( $style ); ?>>
				<!-- Container -->
				<div class="container">
					<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
					?>
					<ul id="filters" class="portfolio-categories no-left-padding">
						<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
						<?php
							if ( count( $terms > 0 ) && is_array( $terms ) ) {
								foreach ( $terms as $term ) {
									$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
									?>
									<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
									<?php
								}
							}
						?>
					</ul>
				</div><!-- Container /- -->
			</div>
			<!-- Container -->
			<div class="container">
				<div class="row">
					<ul class="portfolio-list no-left-padding">
						<?php
							while ( $qry->have_posts() ) : $qry->the_post();
							$taxonomies = "";
							$terms = get_the_terms( get_the_ID(), $ow_post_tax );
							$termsname = array();
							$terms_dashed = array();
							if ( count( $terms > 0 ) && is_array( $terms ) ) {
								foreach ( $terms as $term ) {
									$termsname[] = strtolower( $term->name );
									$unexpected_str = array(" ","&","amp;",",",".","/");
									$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
								}
								$taxonomies = implode(" ", $terms_dashed );
								$taxonomies_plus = implode(" + ", $termsname );
							}
							?>
							<li class="col-md-4 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
								<div class="content-image-block">
									<?php
										$url = "";
										$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
										
										if($url != "" ) {
											echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
										}
										else {
											the_post_thumbnail("healthkare_370_240");
										}
									?>
									<div class="content-block-hover">
										<?php
											if( function_exists('healthkare_get_simple_likes_button') )	 {
												?>
												<div class="post-like">
												
													<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
												</div>
												<?php
											}
											if($url != "" ) {
												?>
												<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
													<i class="fa fa-arrows-alt"></i>
												</a>
												<?php
											}
											else {
												?>
												<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
													<i class="fa fa-arrows-alt"></i>
												</a>
												<?php
											}
										?>
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									</div>
								</div>
							</li>
							<?php
						endwhile;
						/* Reset Post Data */
						wp_reset_postdata();
					?>
					</ul>
				</div>
			</div><!-- Container /- -->
		</div><!-- Gallery Section3 -->
		
		<?php
	}
	elseif( $layout == 'four' ) {
		?>	
		<!-- Treatments 3 Column -->
		<div class="gallery-section treatments-4-column gallery-section3 container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
				?>
				<ul id="filters" class="portfolio-categories no-left-padding">
					<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
					<?php
						if ( count( $terms > 0 ) && is_array( $terms ) ) {
							foreach ( $terms as $term ) {
								$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
								?>
								<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
								<?php
							}
						}
					?>
				</ul>
				<div class="row">
					<ul class="portfolio-list no-left-padding">
						<?php
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							
							$qry_args = array( 'post_type' => $ow_post_type );
							
							healthkare_wp_query( $qry_args );
							
							while ( have_posts() ) : the_post();
								$taxonomies = "";
								$terms = get_the_terms( get_the_ID(), $ow_post_tax );
								if ( count( $terms > 0 ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$termsname[] = strtolower( $term->name );								
										$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
									}
									$taxonomies = implode(" ", $terms_dashed );
									$taxonomies_plus = implode(" + ", $termsname );
								}
								?>
								<li class="col-md-4 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
									<div class="content-image-block">
										<?php
											$url = "";
											$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
											
											if($url != "" ) {
												echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
											}
											else {
												the_post_thumbnail("healthkare_370_240");
											}
										?>
										<div class="content-block-hover">
											<?php
												if( function_exists('healthkare_get_simple_likes_button') )	 {
													?>
													<div class="post-like">
													
														<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
													</div>
													<?php
												}
												if($url != "" ) {
													?>
													<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
												else {
													?>
													<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
											?>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										</div>
									</div>
								</li>
								<?php
							endwhile;
								
							?><li><?php
							// Previous/next page navigation.				
							the_posts_pagination( array(
								'prev_text'          => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Prev', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'next_text'          => wp_kses( __( 'Next <i class="fa fa-angle-double-right"></i>', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "healthkare-toolkit" ) . ' </span>',
							) );?></li><?php
						
							// Restore original Post Data
							wp_reset_query();
						?>
					</ul>
				</div>
			</div><!-- Container /- -->
		</div><!-- Treatments 3 Column -->
		
		<?php
	}
	elseif( $layout == 'five' ) {
		?>		
		<!-- Treatments 4 Column -->
		<div class="gallery-section treatments-4-column container-fluid no-left-padding no-right-padding">
			<!-- Container -->
			<div class="container">
				<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
				?>
				<ul id="filters" class="portfolio-categories no-left-padding">
					<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
					<?php
						if ( count( $terms > 0 ) && is_array( $terms ) ) {
							foreach ( $terms as $term ) {
								$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
								?>
								<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
								<?php
							}
						}
					?>
				</ul>
				<div class="row">
					<ul class="portfolio-list no-left-padding">
						<?php
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							
							$qry_args = array( 'post_type' => $ow_post_type );
							
							healthkare_wp_query( $qry_args );
							
							while ( have_posts() ) : the_post();
								$taxonomies = "";
								$terms = get_the_terms( get_the_ID(), $ow_post_tax );
								if ( count( $terms > 0 ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$termsname[] = strtolower( $term->name );								
										$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
									}
									$taxonomies = implode(" ", $terms_dashed );
									$taxonomies_plus = implode(" + ", $termsname );
								}
								?>
								<li class="col-md-3 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
									<div class="content-image-block">
										<?php
											$url = "";
											$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
											
											if($url != "" ) {
												echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
											}
											else {
												the_post_thumbnail("healthkare_270_240");
											}
										?>
										<div class="content-block-hover">
											<?php
												if( function_exists('healthkare_get_simple_likes_button') )	 {
													?>
													<div class="post-like">
													
														<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
													</div>
													<?php
												}
												if($url != "" ) {
													?>
													<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
												else {
													?>
													<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
											?>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										</div>
									</div>
								</li>
								<?php
							endwhile;
								
							?><li><?php
							// Previous/next page navigation.				
							the_posts_pagination( array(
								'prev_text'          => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Prev', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'next_text'          => wp_kses( __( 'Next <i class="fa fa-angle-double-right"></i>', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "healthkare-toolkit" ) . ' </span>',
							) );?></li><?php
						
							// Restore original Post Data
							wp_reset_query();
						?>
					</ul>
				</div>
			</div><!-- Container /- -->
		</div><!-- Treatments 4 Column /- -->
		<?php
	}
	elseif( $layout == 'six' ){
		?>	
		<!-- Gallery Section -->
		<div class="gallery-section gallery-section2 gallary-full container-fluid no-left-padding no-right-padding">
			<div class="gallary-5-cols">
				<!-- Container -->
				<div class="container">
					<?php
					if($sc_title_a != "" || $sc_title_b != "" || $sc_desc != "" ) {
						?>
						<!-- Section Header -->
						<div class="section-header">
							<?php if($sc_title_a != "" || $sc_title_b != "") { ?><h3><?php echo esc_attr($sc_title_a); ?> <strong><?php echo esc_attr($sc_title_b); ?></strong></h3><?php } ?>
							<?php echo wpautop($sc_desc); ?>
						</div><!-- Section Header /- -->
						<?php
					}
					?>
					
					<ul id="filters" class="portfolio-categories no-left-padding">
						<li><a data-filter="*" class="active" href="#"><?php esc_html_e('All Categories',"healthkare-toolkit"); ?></a></li>
						<?php
							if ( count( $terms > 0 ) && is_array( $terms ) ) {
								foreach ( $terms as $term ) {
									$termname = str_replace( $unexpected_str, '-', strtolower($term->name) );
									?>
									<li><a data-filter=".<?php echo esc_attr( $termname ); ?>" href="#" title="<?php echo esc_attr ( $term->name ); ?>"><?php echo esc_attr ( $term->name ); ?></a></li>
									<?php
								}
							}
						?>
					</ul>
				</div><!-- Container /- -->
				<div class="full-items">
					<ul class="portfolio-list no-left-padding">
						<?php
							$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
							
							$qry_args = array( 'post_type' => $ow_post_type );
							
							healthkare_wp_query( $qry_args );
							
							while ( have_posts() ) : the_post();
								$taxonomies = "";
								$terms = get_the_terms( get_the_ID(), $ow_post_tax );
								if ( count( $terms > 0 ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$termsname[] = strtolower( $term->name );								
										$terms_dashed[] = str_replace( $unexpected_str, '-', strtolower( $term->name ) );
									}
									$taxonomies = implode(" ", $terms_dashed );
									$taxonomies_plus = implode(" + ", $termsname );
								}
								?>
								<li class="col-md-3 col-sm-4 col-xs-4 <?php echo esc_attr($taxonomies); ?>">
									<div class="content-image-block">
										<?php
											$url = "";
											$url = get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true );
											
											if($url != "" ) {
												echo wp_oembed_get( esc_url ( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ) );
											}
											else {
												the_post_thumbnail("healthkare_373_373");
											}
										?>
										<div class="content-block-hover">
											<?php
												if( function_exists('healthkare_get_simple_likes_button') )	 {
													?>
													<div class="post-like">
													
														<?php echo healthkare_get_simple_likes_button( get_the_ID() ); ?>
													</div>
													<?php
												}
												if($url != "" ) {
													?>
													<a class="popup-video" href="<?php echo esc_url( get_post_meta( get_the_ID(), 'healthkare_cf_video_embed', true ) ); ?>" title="<?php the_title(); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
												else {
													?>
													<a class="zoom-in" href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>">
														<i class="fa fa-arrows-alt"></i>
													</a>
													<?php
												}
											?>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										</div>
									</div>
								</li>
								<?php
							endwhile;
								
							?><li><?php
							// Previous/next page navigation.				
							the_posts_pagination( array(
								'prev_text'          => wp_kses( __( '<i class="fa fa-angle-double-left"></i> Prev', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'next_text'          => wp_kses( __( 'Next <i class="fa fa-angle-double-right"></i>', "healthkare-toolkit" ), array( 'i' => array( 'class' => array() ) ) ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', "healthkare-toolkit" ) . ' </span>',
							) );?></li><?php
						
							// Restore original Post Data
							wp_reset_query();
						?>
					</ul>
				</div>
			</div>
		</div><!-- Gallery Section /- -->
		<?php
	}
	return ob_get_clean();
}

add_shortcode('healthkare_gallery', 'healthkare_gallery');

if( function_exists('vc_map') ) {

	vc_map( array(
		'base' => 'healthkare_gallery',
		'name' => esc_html__( 'Gallery', "healthkare-toolkit" ),
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
					esc_html__( 'Layout 4', "healthkare-toolkit" ) => 'four',
					esc_html__( 'Layout 5', "healthkare-toolkit" ) => 'five',
					esc_html__( 'Layout 6', "healthkare-toolkit" ) => 'six',
				),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','three') ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title First Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_a',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three','four','five','six' ) ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Last Text', "healthkare-toolkit" ),
				'param_name' => 'sc_title_b',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three','four','five','six' ) ),
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Short Description', "healthkare-toolkit" ),
				'param_name' => 'sc_desc',
				"dependency" => Array('element' => "layout", 'value' => array( 'one','two','three','four','five','six' ) ),
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