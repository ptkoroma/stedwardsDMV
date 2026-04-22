<?php 
	namespace MimTheme\Plugin\Admin\CustomWidgets;


	class Facebook extends \WP_Widget {
		
		function __construct() {
		    $params = array (
		        'description' => esc_html__('Mim : Facebook Like Box', 'mim-plugin'),
		        'name' => esc_html__('Mim : Facebook Likebox', 'mim-plugin')
		    );
		    parent::__construct('Facebook', esc_html__('Mim : Facebook Likebox', 'mim-plugin'),$params);

		    self::register_widget();
		}

		function widget( $args, $instance ) {
			extract( $args );
			/* User-selected settings. */
			$title = apply_filters('widget_title', $instance['title'] );
			$width = $instance['width'];
			$height = $instance['height'];
			$color = $instance['color'];
			$faces = $instance['faces'];
			$stream = $instance['stream'];
			$header = $instance['header'];
			$borderc = $instance['borderc'];
			$page = $instance['page'];

			/* Before widget (defined by themes). */
			echo wp_kses_post( $before_widget );

			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo wp_kses_post( $before_title ) . $title . $after_title;
			?>
				<div class="mim-theme-facebook-likebox" style="<?php if($borderc != '') {echo 'border:1px solid '.$borderc.';';} ?>">

					<<?php echo 'iframe'; ?> src="//www.facebook.com/plugins/likebox.php?href=<?php echo wp_kses_post( $page ); ?>&amp;width=<?php echo wp_kses_post( $width ); ?>&amp;height=<?php echo wp_kses_post( $height ); ?>&amp;colorscheme=<?php echo wp_kses_post( $color ); ?>&amp;show_faces=<?php if($faces != 'on') {echo 'false';}else{echo 'true';} ?>&amp;show_border=false&amp;stream=<?php if($stream != 'on') {echo 'false';}else{echo 'true';} ?>&amp;header=<?php if($header != 'on') {echo 'false';}else{echo 'true';} ?>" style="margin-bottom: -9px;border:none; overflow:hidden; width:<?php echo wp_kses_post( $width ); ?>px; height:<?php echo wp_kses_post( $height ); ?>px;"></<?php echo 'iframe'; ?>>

				</div><!-- like_box_footer-->

			<?php 
			/* After widget (defined by themes). */
			echo wp_kses_post( $after_widget );
		}


		 /** @see WP_Widget::update */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['width'] = $new_instance['width'];
			$instance['height'] = $new_instance['height'];
			$instance['color'] = $new_instance['color'];
			$instance['faces'] = $new_instance['faces'];
			$instance['stream'] = $new_instance['stream'];
			$instance['header'] = $new_instance['header'];
			$instance['borderc'] = $new_instance['borderc'];
			$instance['page'] = $new_instance['page'];

			return $instance;
		}


		 /** @see WP_Widget::form */
		function form( $instance ) {

			/* Set up some default widget settings. */
			$defaults = array(
				'title' => esc_html__('Facebook','mim-plugin'),
				'page' => 'http://www.facebook.com/envato',
				'width' => 360,
				'height' => 217,
				'faces' => 'on',
				'stream' => '',
				'header' => '',
				'borderc' => '#767676',
				'color' => 'light'
				
	 			);
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'mim-plugin') ?></label>
				<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'title' ) ); ?>" value="<?php if(isset($instance['title'])) echo esc_attr($instance['title']); ?>" />
			</p>

	    	<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'page' ) ); ?>"><?php esc_html_e('Facebook Page URL:', 'mim-plugin') ?></label>
				<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'page' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'page' ) ); ?>" value="<?php if(isset($instance['page'])) echo esc_attr($instance['page']); ?>"  class="widefat" />
			</p>
	        

	    	<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'width' ) ); ?>"><?php esc_html_e('Width:', 'mim-plugin') ?></label>
				<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'width' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'width' ) ); ?>" value="<?php if(isset( $instance['width'] )) echo esc_attr($instance['width']); ?>"  class="widefat" />
			</p>

	    	<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'height' ) ); ?>"><?php esc_html_e('Height:', 'mim-plugin') ?></label>
				<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'height' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'height' ) ); ?>" value="<?php if(isset($instance['height'])) echo esc_attr($instance['height']); ?>"  class="widefat" />
			</p>

			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'color' ) ); ?>"><?php esc_html_e('Color Scheme', 'mim-plugin') ?></label>
				<select id="<?php echo wp_kses_post( $this->get_field_id( 'color' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'color' ) ); ?>" class="widefat">
				<option value="light" <?php if ( 'light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Light', 'mim-plugin'); ?></option>
				<option value="dark" <?php if ( 'dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php esc_html_e('Dark', 'mim-plugin'); ?></option>
				</select>
			</p>
	    	<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'borderc' ) ); ?>"><?php esc_html_e('Box border Color:', 'mim-plugin') ?></label>
				<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'borderc' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'borderc' ) ); ?>" value="<?php if(isset($instance['borderc'])) echo esc_attr($instance['borderc']); ?>"  class="widefat" />
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $instance['faces'], 'on' ); ?> id="<?php echo wp_kses_post( $this->get_field_id( 'faces' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'faces' ) ); ?>" />
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'faces' ) ); ?>"><?php esc_html_e('Show faces', 'mim-plugin'); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $instance['stream'], 'on' ); ?> id="<?php echo wp_kses_post( $this->get_field_id( 'stream' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'stream' ) ); ?>" />
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'stream' ) ); ?>"><?php esc_html_e('Show stream', 'mim-plugin'); ?></label>
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $instance['header'], 'on' ); ?> id="<?php echo wp_kses_post( $this->get_field_id( 'header' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'header' ) ); ?>" />
				<label for="<?php echo wp_kses_post( $this->get_field_id( 'header' ) ); ?>"><?php esc_html_e('Show header', 'mim-plugin'); ?></label>
			</p>
		   <?php 
		}

		public function register_widget(){
		    register_widget( $this );
		}
}