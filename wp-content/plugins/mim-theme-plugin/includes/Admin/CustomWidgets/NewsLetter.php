<?php 
	namespace MimTheme\Plugin\Admin\CustomWidgets;


	

	class NewsLetter extends \WP_Widget {

		function __construct() {
		    $params = array (
		        'description' => esc_html__('Mim : Mailchimp Newsletter Form', 'mim-plugin'),
		        'name' => esc_html__('Mim : Mailchimp Newsletter', 'mim-plugin')
		    );
		    parent::__construct('NewsLetter', esc_html__('Mim : Mailchimp Newsletter', 'mim-plugin'),$params);
		    self::register_widget();
		}	

		function widget( $args, $instance ) {
			extract( $args );
			/* User-selected settings. */
			$title = apply_filters('widget_title', $instance['title'] );
			$description = $instance['description'];
			$action_url = $instance['action_url'];
			$first_last_name = $instance['first_last_name'];
			$button_text = $instance['button_text'];

			/* Before widget (defined by themes). */
			echo wp_kses_post( $before_widget );

			/* Title of widget (before and after defined by themes). */
			if ( $title ) {
				echo wp_kses_post( $before_title ) . $title . $after_title;
			}

			// if this widget active load this script
			if ( is_active_widget( false, false, $this->id_base, true ) ) {
				wp_enqueue_script('mim-theme-mailchimp-newslatter', 'http://s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js', array("jquery"), '2.8.3', true);
			}

			?>
			<div class="mim-theme-newsletter-box">
				<div class="newsletter-area">
				    <p><?php echo wp_kses_post( $description ); ?></p>
				    <form action="<?php echo wp_kses_post( $action_url ); ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
				        <div class="form-newsletter">
				            <div class="row">
				            <?php if ( $first_last_name == true ) : ?>
				                <div class="col-md-12">
				                	<p>
				                		<input type="text"  value="" placeholder="<?php esc_html_e( 'Your Name', 'mim-plugin' );?>" name="FNAME" class="form-controller" required="required">
				                	</p>
								</div><!-- / col-md-6 -->
							<?php endif; ?>

				                <div class="mc-field-group col-md-12">
					                <p>
					                    <input type="email"  value="" placeholder="<?php esc_html_e( 'Your Email', 'mim-plugin' );?>" name="EMAIL" class="form-controller email"  required="required">

					                </p>
								</div><!-- / col-md-12 -->

								<div class="col-md-12 text-center">
									 <button class="btn" type="submit" name="subscribe" id="mc-embedded-subscribe"><?php echo esc_html( $button_text ); ?></button>
								</div>  <!-- / col-md-12 -->

							</div>  <!-- / row -->
						</div>  <!-- / form-newsletter -->
				    </form>  <!-- / signup form -->
	    			<!--  Response -->
	                <div id="mce-responses" class="clear">
	                    <div class="response" id="mce-error-response" style="display:none"></div>
	                    <div class="response" id="mce-success-response" style="display:none"></div>
	                </div>
	                <!-- / Response -->
				</div> <!-- / newsletter aria -->
				<script type="text/javascript">
				(function($) {
				    "use strict";
				    
				    jQuery('#mc-embedded-subscribe-form').submit(function(e) {
				        e.preventDefault();
				        jQuery.ajax({
				            url: '<?php echo wp_kses_post( $action_url ); ?>',
				            type: 'GET',
				            data: $('#mc-embedded-subscribe-form').serialize(),
				            dataType: 'json',
				            contentType: "application/json; charset=utf-8",
				            success: function(data) {
				                if (data['result'] != "success") {
				                    console.log(data['msg']);
				                } else {
				                }
				            }
				        });
				    });
				  })(jQuery);
				</script>
			</div><!-- newsletter_box_footer-->
		<?php 
			/* After widget (defined by themes). */
			echo wp_kses_post( $after_widget );
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$description = $instance['description'];
			$action_url = $instance['action_url'];
			$first_last_name = $instance['first_last_name'];
			$button_text = $instance['button_text'];


			/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['description'] = $new_instance['description'];
			$instance['action_url'] = $new_instance['action_url'];
			$instance['first_last_name'] = $new_instance['first_last_name'];
			$instance['button_text'] = $new_instance['button_text'];
			return $instance;
		}
		
		 /** @see WP_Widget::form */
		function form( $instance ) {

				/* Set up some default widget settings. */
				$defaults = array(
					'title' => esc_html__('Mailchimp Newsletter','mim-plugin'),
					'action_url' => 'http://yourdomain.us11.list-manage.com/subscribe/post?u=559ff170eee6949a359c40740&amp;id=fbbd18e68b',
					'description' => "Signup for our news letter and get updates of our new post in your inbox",
					'first_last_name' => true,
					'button_text' => 'subscribe',
					
		 			);
				$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			
				<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'mim-plugin') ?></label>
					<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'title' ) ); ?>" value="<?php if( isset($instance['title']) ) echo esc_attr( $instance['title'] ); ?>" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'action_url' ) ); ?>"><?php esc_html_e('Form Action URL:', 'mim-plugin') ?></label>
					<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'action_url' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'action_url' ) ); ?>" value="<?php if( isset($instance['action_url']) ) echo esc_url( $instance['action_url'] ); ?>"  class="widefat" />
				</p>
		        

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e('Description:', 'mim-plugin') ?></label>
					<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'description' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'description' ) ); ?>" value="<?php if( isset($instance['description']) ) echo esc_attr($instance['description']); ?>"  class="widefat" />
				</p>


		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'button_text' ) ); ?>"><?php esc_html_e('Button Text:', 'mim-plugin') ?></label>
					<input type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'button_text' ) ); ?>" value="<?php if( isset($instance['button_text']) ) echo esc_attr($instance['button_text']); ?>"  class="widefat" />
				</p>

				<p>
					<input class="checkbox" type="checkbox" <?php checked( $instance['first_last_name'], true ); ?> id="<?php echo wp_kses_post( $this->get_field_id( 'first_last_name' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'first_last_name' ) ); ?>" value="1"/>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'first_last_name' ) ); ?>"><?php esc_html_e('Show First and Last name', 'mim-plugin'); ?></label>
				</p>
		   <?php 
		} // end form function


		public function register_widget(){
		    register_widget( $this );
		}
}