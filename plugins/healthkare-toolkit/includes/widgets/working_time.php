<?php
/**
 * WorkingTime widget class Healthkare
 *
 * @since 2.8.0
 */
class Healthkare_Widget_WorkingTime extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'widget_workinghours', 'description' => esc_html( "", "healthkare-toolkit" ) );
		
		parent::__construct('widget-worktime', esc_html('Healthkare :: Working Time', "healthkare-toolkit"), $widget_ops);
		
		$this->alt_option_name = 'widget_workinghours';
	}

	public function widget( $args, $instance ) {
		
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Working Time', "healthkare-toolkit" );
		
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$mon_fri = ( ! empty( $instance['mon_fri'] ) ) ? esc_attr( $instance['mon_fri'] ) : "";
		$saturday = ( ! empty( $instance['saturday'] ) ) ? esc_attr( $instance['saturday'] ) : "";
		$sunday = ( ! empty( $instance['sunday'] ) ) ? esc_attr( $instance['sunday'] ) : "";
		$discharge = ( ! empty( $instance['discharge'] ) ) ? esc_attr( $instance['discharge'] ) : "";
		$emergency = ( ! empty( $instance['emergency'] ) ) ? esc_attr( $instance['emergency'] ) : "";
		
		echo html_entity_decode( $args['before_widget'] );

		if ( $title ) {
			echo html_entity_decode( $args['before_title'] . $title . $args['after_title'] );
		}
		
		if( $mon_fri != "" || $saturday != "" || $sunday != "" || $discharge != "" || $emergency != "" ) {
			?>
			<ul>
				<?php if( $mon_fri != "" ) { ?><li><span><?php esc_html_e('Monday - Friday',"healthkare-toolkit"); ?></span><b><?php echo esc_attr($mon_fri); ?></b></li><?php } ?>
				<?php if( $saturday != "" ) { ?><li><span><?php esc_html_e('Saturday',"healthkare-toolkit"); ?></span><b><?php echo esc_attr($saturday); ?></b></li><?php } ?>
				<?php if( $sunday != "" ) { ?><li><span><?php esc_html_e('Sunday',"healthkare-toolkit"); ?></span><b><?php echo esc_attr($sunday); ?></b></li><?php } ?>
				<?php if( $discharge != "" ) { ?><li><span><?php esc_html_e('Discharge',"healthkare-toolkit"); ?></span><b><?php echo esc_attr($discharge); ?></b></li><?php } ?>
				<?php if( $emergency != "" ) { ?><li><span class="emergency"><?php esc_html_e('Emergency Unit ',"healthkare-toolkit"); ?></span><b class="open"><?php echo esc_attr($emergency); ?></b></li><?php } ?>
			</ul>
			<?php
		}
		echo html_entity_decode( $args['after_widget'] );
	}

	public function form( $instance ) {

		$title	=	isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : "";
		
		$mon_fri	=	isset( $instance['mon_fri'] ) ? esc_attr( $instance['mon_fri'] ) : "";

		$saturday	=	isset( $instance['saturday'] ) ? esc_attr( $instance['saturday'] ) : "";
		
		$sunday	=	isset( $instance['sunday'] ) ? esc_attr( $instance['sunday'] ) : "";
		
		$discharge	=	isset( $instance['discharge'] ) ? esc_attr( $instance['discharge'] ) : "";
		
		$emergency	=	isset( $instance['emergency'] ) ? esc_attr( $instance['emergency'] ) : "";
	
		?>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'mon_fri' ) ); ?>"><?php esc_html_e( 'Monday To Friday :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'mon_fri' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'mon_fri' ) ); ?>" type="text" value="<?php echo esc_attr( $mon_fri ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'saturday' ) ); ?>"><?php esc_html_e( 'Saturday :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'saturday' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'saturday' ) ); ?>" type="text" value="<?php echo esc_attr( $saturday ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sunday' ) ); ?>"><?php esc_html_e( 'Sunday :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sunday' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sunday' ) ); ?>" type="text" value="<?php echo esc_attr( $sunday ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'discharge' ) ); ?>"><?php esc_html_e( 'Discharge :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'discharge' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'discharge' ) ); ?>" type="text" value="<?php echo esc_attr( $discharge ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'emergency' ) ); ?>"><?php esc_html_e( 'Emergency Unit :', "healthkare-toolkit" ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'emergency' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'emergency' ) ); ?>" type="text" value="<?php echo esc_attr( $emergency ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['mon_fri'] = strip_tags( $new_instance['mon_fri'] );
		
		$instance['saturday'] = strip_tags( $new_instance['saturday'] );
		
		$instance['sunday'] = strip_tags( $new_instance['sunday'] );
		
		$instance['discharge'] = strip_tags( $new_instance['discharge'] );
		
		$instance['emergency'] = strip_tags( $new_instance['emergency'] );
		
		return $instance;
	}
}