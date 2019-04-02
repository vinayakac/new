<?php
/**
 * About Us widget class Healthkare
 *
 * @since 2.8.0
 */
class Healthkare_Widget_AboutUs extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_about', 'description' => esc_html( "", "healthkare-toolkit" ) );
		
		parent::__construct('widget-social', esc_html('Healthkare :: About Us', "healthkare-toolkit"), $widget_ops);
		
		$this->alt_option_name = 'widget_about';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About Us', "healthkare-toolkit" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$about_txt = ( ! empty( $instance['about_txt'] ) ) ? esc_html( $instance['about_txt'] ) : "";
		$fb_url = ( ! empty( $instance['fb_url'] ) ) ? esc_attr( $instance['fb_url'] ) : "";
		$lin_url = ( ! empty( $instance['lin_url'] ) ) ? esc_attr( $instance['lin_url'] ) : "";
		$gp_url = ( ! empty( $instance['gp_url'] ) ) ? esc_attr( $instance['gp_url'] ) : "";
		$tw_url = ( ! empty( $instance['tw_url'] ) ) ? esc_attr( $instance['tw_url'] ) : "";
		
		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		echo wpautop($about_txt);
		
		if( $fb_url != "" || $lin_url != "" || $gp_url != "" || $tw_url != "" ) {
			?>
			<ul class="footer-social">
				<?php if( $fb_url != "" ) { ?><li><a href="<?php echo esc_url($fb_url); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
				<?php if( $lin_url != "" ) { ?><li><a href="<?php echo esc_url($lin_url); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
				<?php if( $gp_url != "" ) { ?><li><a href="<?php echo esc_url($gp_url); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
				<?php if( $tw_url != "" ) { ?><li><a href="<?php echo esc_url($tw_url); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
			</ul>
			<?php
		}
		echo html_entity_decode( $args['after_widget'] );
	}

	public function form( $instance ) {

		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		
		$about_txt	=	isset( $instance['about_txt'] ) ? esc_attr( $instance['about_txt'] ) : "";
		
		$fb_url	=	isset( $instance['fb_url'] ) ? esc_attr( $instance['fb_url'] ) : "";

		$lin_url	=	isset( $instance['lin_url'] ) ? esc_attr( $instance['lin_url'] ) : "";
		
		$gp_url	=	isset( $instance['gp_url'] ) ? esc_attr( $instance['gp_url'] ) : "";
		
		$tw_url	=	isset( $instance['tw_url'] ) ? esc_attr( $instance['tw_url'] ) : "";
	
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'about_txt' ); ?>"><?php esc_html_e( 'Description Text:', "healthkare-toolkit" ); ?></label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_html($this->get_field_id('about_txt') ); ?>" name="<?php echo esc_html($this->get_field_name('about_txt') ); ?>"><?php echo esc_html($about_txt); ?></textarea>
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>"><?php esc_html_e( 'Facebook URL:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_url' ) ); ?>" type="text" value="<?php echo esc_attr( $fb_url ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lin_url' ) ); ?>"><?php esc_html_e( 'Linkedin URL:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lin_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lin_url' ) ); ?>" type="text" value="<?php echo esc_attr( $lin_url ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gp_url' ) ); ?>"><?php esc_html_e( 'Google Plus URL:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gp_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gp_url' ) ); ?>" type="text" value="<?php echo esc_attr( $gp_url ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tw_url' ) ); ?>"><?php esc_html_e( 'Twitter URL:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tw_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tw_url' ) ); ?>" type="text" value="<?php echo esc_attr( $tw_url ); ?>" />
		</p>
		
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['about_txt'] = strip_tags( $new_instance['about_txt'] );
		
		$instance['fb_url'] = strip_tags( $new_instance['fb_url'] );
		
		$instance['lin_url'] = strip_tags( $new_instance['lin_url'] );
		
		$instance['gp_url'] = strip_tags( $new_instance['gp_url'] );
		
		$instance['tw_url'] = strip_tags( $new_instance['tw_url'] );
		
		return $instance;
	}
}