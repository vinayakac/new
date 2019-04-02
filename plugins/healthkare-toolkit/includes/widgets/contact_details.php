<?php
/**
 * Contact Details widget class Healthkare
 *
 * @since 2.8.0
 */
class Healthkare_Widget_ContactDetails extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_information', 'description' => esc_html( "", "healthkare-toolkit" ) );
		
		parent::__construct('widget-information', esc_html('Healthkare :: Contact Details', "healthkare-toolkit"), $widget_ops);
		
		$this->alt_option_name = 'widget_information';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( '', "healthkare-toolkit" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$address = ( ! empty( $instance['address'] ) ) ? esc_html( $instance['address'] ) : "";
		$phone_one = ( ! empty( $instance['phone_one'] ) ) ? esc_attr( $instance['phone_one'] ) : "";
		$phone_two = ( ! empty( $instance['phone_two'] ) ) ? esc_attr( $instance['phone_two'] ) : "";
		$email_one = ( ! empty( $instance['email_one'] ) ) ? esc_attr( $instance['email_one'] ) : "";
		$email_two = ( ! empty( $instance['email_two'] ) ) ? esc_attr( $instance['email_two'] ) : "";
		
		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		if( $address != "" ) {
			?>
			<div class="information-block">
				<i class="icon icon-Pointer"></i>
				<?php echo wpautop($address); ?>			
			</div>
			<?php
		}
		
		if( $phone_one != "" || $phone_two != "" ) {
			?>
			<div class="information-block">
				<i class="icon icon-Phone2"></i>
				<?php
					if( $phone_one != "" ) {
						?>
						<p>
							<a href="tel:<?php echo esc_html(str_replace(" ", "", $phone_one ) ); ?>" title="<?php echo esc_attr($phone_one); ?>"><?php echo esc_attr($phone_one); ?></a>
						</p>
						<?php
					}
					if( $phone_two != "" ) {
						?>
						<p>
							<a href="tel:<?php echo esc_html(str_replace(" ", "", $phone_two ) ); ?>" title="<?php echo esc_attr($phone_two); ?>"><?php echo esc_attr($phone_two); ?></a>
						</p>
						<?php
					}
				?>
			</div>
			<?php
		}
		if( $email_one != "" || $email_two != "" ) {
			?>
			<div class="information-block">
				<i class="icon icon-Mail"></i>
				<?php
				if( $email_one != "" ) {
					?>
					<p><a href="mailto:<?php echo esc_html(str_replace(" ", "", $email_one ) ); ?>" title="<?php echo esc_attr($email_one); ?>"><?php echo esc_attr($email_one); ?></a></p>
					<?php
				}
				if( $email_two != "" ) {
					?>
					<p><a href="mailto:<?php echo esc_html(str_replace(" ", "", $email_two ) ); ?>" title="<?php echo esc_attr($email_two); ?>"><?php echo esc_attr($email_two); ?></a></p>
					<?php
				}
				?>
			</div>
			<?php
		}
		
		echo html_entity_decode( $args['after_widget'] );
	}

	public function form( $instance ) {

		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		
		$address	=	isset( $instance['address'] ) ? esc_html( $instance['address'] ) : "";

		$phone_one	=	isset( $instance['phone_one'] ) ? esc_attr( $instance['phone_one'] ) : "";
		
		$phone_two	=	isset( $instance['phone_two'] ) ? esc_attr( $instance['phone_two'] ) : "";
		
		$email_one	=	isset( $instance['email_one'] ) ? esc_attr( $instance['email_one'] ) : "";
		
		$email_two	=	isset( $instance['email_two'] ) ? esc_attr( $instance['email_two'] ) : "";
	
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php esc_html_e( 'Address:', "healthkare-toolkit" ); ?></label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo esc_html($this->get_field_id('address') ); ?>" name="<?php echo esc_html($this->get_field_name('address') ); ?>"><?php echo esc_html($address); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_one' ) ); ?>"><?php esc_html_e( 'Phone Number 1:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_one' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_one' ) ); ?>" type="text" value="<?php echo esc_attr( $phone_one ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone_two' ) ); ?>"><?php esc_html_e( 'Phone Number 2:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone_two' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone_two' ) ); ?>" type="text" value="<?php echo esc_attr( $phone_two ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email_one' ) ); ?>"><?php esc_html_e( 'Email 1:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_one' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email_one' ) ); ?>" type="text" value="<?php echo esc_attr( $email_one ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email_two' ) ); ?>"><?php esc_html_e( 'Email 2:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email_two' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email_two' ) ); ?>" type="text" value="<?php echo esc_attr( $email_two ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['address'] = strip_tags( $new_instance['address'] );
		
		$instance['phone_one'] = strip_tags( $new_instance['phone_one'] );
		
		$instance['phone_two'] = strip_tags( $new_instance['phone_two'] );
		
		$instance['email_one'] = strip_tags( $new_instance['email_one'] );
		
		$instance['email_two'] = strip_tags( $new_instance['email_two'] );
		
		return $instance;
	}
}