<?php
/**
 * ContactLink widget class Healthkare
 *
 * @since 2.8.0
 */
class Healthkare_Widget_ContactLink extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_contact', 'description' => esc_html( "", "healthkare-toolkit" ) );
		
		parent::__construct('widget-contact', esc_html('Healthkare :: Contact Link', "healthkare-toolkit"), $widget_ops);
		
		$this->alt_option_name = 'widget_contact';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( '', "healthkare-toolkit" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$cnt_bg = ( ! empty( $instance['cnt_bg'] ) ) ? esc_html( $instance['cnt_bg'] ) : "";
		$text_one = ( ! empty( $instance['text_one'] ) ) ? esc_attr( $instance['text_one'] ) : "";
		$text_last = ( ! empty( $instance['text_last'] ) ) ? esc_attr( $instance['text_last'] ) : "";
		$btn_txt = ( ! empty( $instance['btn_txt'] ) ) ? esc_attr( $instance['btn_txt'] ) : "";
		$btn_url = ( ! empty( $instance['btn_url'] ) ) ? esc_attr( $instance['btn_url'] ) : "";
		
		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}

		
		?>
		<div class="contact-link" style="background-image:url(<?php echo $cnt_bg ?>);">
			<?php if($text_one != "" || $text_last != "") { ?><h6><span><?php echo esc_attr($text_one); ?></span><?php echo esc_attr($text_last); ?></h6><?php } ?>
			<?php if($btn_txt != "") { ?><a href="<?php echo esc_url($btn_url); ?>"><?php echo esc_attr($btn_txt); ?></a><?php } ?>
		</div>
		<?php
		echo html_entity_decode( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['cnt_bg'] = strip_tags( $new_instance['cnt_bg'] );
		
		$instance['text_one'] = strip_tags( $new_instance['text_one'] );
		
		$instance['text_last'] = strip_tags( $new_instance['text_last'] );
		
		$instance['btn_txt'] = strip_tags( $new_instance['btn_txt'] );
		
		$instance['btn_url'] = strip_tags( $new_instance['btn_url'] );
		
		return $instance;
	}
	
	
	public function form( $instance ) {

		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		
		$cnt_bg	=	isset( $instance['cnt_bg'] ) ? esc_url( $instance['cnt_bg'] ) : "";
		
		$text_one	=	isset( $instance['text_one'] ) ? esc_attr( $instance['text_one'] ) : "";

		$text_last	=	isset( $instance['text_last'] ) ? esc_attr( $instance['text_last'] ) : "";
		
		$btn_txt	=	isset( $instance['btn_txt'] ) ? esc_attr( $instance['btn_txt'] ) : "";
		
		$btn_url	=	isset( $instance['btn_url'] ) ? esc_attr( $instance['btn_url'] ) : "";
	
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_url( $this->get_field_id('cnt_bg') ); ?>"><?php esc_html_e('Backgroun Image', "healthkare-toolkit"); ?></label>
			<input type="text" class="widefat custom_media_url" name="<?php echo esc_attr( $this->get_field_name('cnt_bg') ); ?>" id="<?php echo esc_attr( $this->get_field_name('cnt_bg') ); ?>" value="<?php echo esc_url( $instance['cnt_bg'] ); ?>">
			<input type="button" value="<?php esc_html_e( 'Upload Image', "healthkare-toolkit" ); ?>" class="button custom_media_upload" id="custom_image_uploader"/>
			<?php
            if ( $cnt_bg != '' ) {
				?>
				<div class="custom_media_image">
					<img class="custom_media_image" src="<?php echo esc_url($cnt_bg); ?>" alt="">
				</div>
				<?php
			}
			?>
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_one' ) ); ?>"><?php esc_html_e( 'Info Text First:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_one' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_one' ) ); ?>" type="text" value="<?php echo esc_attr( $text_one ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'text_last' ) ); ?>"><?php esc_html_e( 'Info Text Last:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text_last' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text_last' ) ); ?>" type="text" value="<?php echo esc_attr( $text_last ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn_txt' ) ); ?>"><?php esc_html_e( 'Button Text :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_txt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_txt' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_txt ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>"><?php esc_html_e( 'Button URL:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'btn_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'btn_url' ) ); ?>" type="text" value="<?php echo esc_attr( $btn_url ); ?>" />
		</p>
		
		<?php
	}

}