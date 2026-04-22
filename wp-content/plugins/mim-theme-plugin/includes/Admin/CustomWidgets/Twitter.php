<?php 
	namespace MimTheme\Plugin\Admin\CustomWidgets;


	

	
	class Twitter extends \WP_Widget {

		function __construct() {
		    $params = array (
		        'description' => esc_html__('Mim : Twitter Feed Plugin', 'mim-plugin'),
		        'name' => esc_html__('Mim : Twitter Feed', 'mim-plugin')
		    );
		    parent::__construct('Twitter', esc_html__('Mim : Twitter Feed', 'mim-plugin'),$params);


		    add_action( 'admin_enqueue_scripts', [ $this , 'widgets_scripts'] );
		    
		    self::register_widget();
		}	

		
		 /** @see WP_Widget::form */
		function form( $instance ) {

				/* Set up some default widget settings. */
				$defaults = array(
					'title' => esc_html__('Twitter Feed', 'mim-plugin'),
					'tw_theme' => "light",
					'tw_lang' => "en",
					'tw_data_chrome_noscrollbar' => "",
					'tw_data_chrome_transparent' => "",
					'tw_data_chrome_noheader' => "",
					'tw_data_chrome_nofooter' => "",
					'tw_width' => "370",
					'tw_height' => "400",
					'tw_border_color' => "",
					'link_color' => "",
					'post_count' => 3,
					'profile_url' => "https://twitter.com/themeforest",
					
		 			);
				$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			
				<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'mim-plugin') ?></label>
					<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id( 'title' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'title' ) ); ?>" value="<?php if( isset($instance['title']) ) echo esc_attr($instance['title']); ?>" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_theme' ) ); ?>"><?php esc_html_e('Theme:', 'mim-plugin') ?></label>
					<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_theme' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_theme' ) ); ?>" class="widefat" >
					<?php
						$tw_theme_name = array(
							'light' => 'Light', 
							'dark' => 'Dark', 
						);

						foreach ($tw_theme_name as $key => $value) {
							( $instance['tw_theme'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
							echo "<option $selected value='$key'>$value</option>";
						}
					?>
					</select>
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_lang' ) ); ?>"><?php esc_html_e('Language:', 'mim-plugin') ?></label>
					<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_lang' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_lang' ) ); ?>" class="widefat" >
					<?php
						$lang_name = array(
							'en' => 'English', 
							'bn' => 'Bangla', 
							'nl' => 'Dutch', 
							'fil' => 'Filipino', 
							'fr' => 'French', 
							'de' => 'German', 
							'hi' => 'Hindi', 
							'id' => 'Indonesian', 
							'it' => 'Italian', 
							'ko' => 'Korean', 
							'msa' => 'Malay', 
							'pt' => 'Portuguese', 
							'ru' => 'Russian', 
							'zh-cn' => 'Simplified Chinese', 
							'es' => 'Spanish', 
							'zh-tw' => 'Traditional Chinese', 
							'tr' => 'Turkish', 
						);

						foreach ($lang_name as $key => $value) {
							( $instance['tw_lang'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
							echo "<option $selected value='$key'>$value</option>";
						}
					?>
					</select>
				</p>

		    	<script type="text/javascript">
		            jQuery(document).ready(function($){
		                $('.twitter-color-field').wpColorPicker();
		            });
	            </script>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'link_color' ) ); ?>"><?php esc_html_e('Color for link:', 'mim-plugin') ?></label> <br>
					<input class="twitter-color-field" type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'link_color' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'link_color' ) ); ?>" value="<?php if( isset($instance['link_color']) ) echo esc_attr($instance['link_color']); ?>"  class=" color-mimer widefat" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_border_color' ) ); ?>"><?php esc_html_e('Color for Border:', 'mim-plugin') ?></label> <br>
					<input class="twitter-color-field" type="text" id="<?php echo wp_kses_post( $this->get_field_id( 'tw_border_color' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_border_color' ) ); ?>" value="<?php if( isset($instance['tw_border_color']) ) echo esc_attr($instance['tw_border_color']); ?>"  class=" color-mimer widefat" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_width' ) ); ?>"><?php esc_html_e('Widget width:', 'mim-plugin') ?></label>
					<input type="number" id="<?php echo wp_kses_post( $this->get_field_id( 'tw_width' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_width' ) ); ?>" value="<?php if( isset($instance['tw_width']) ) echo esc_attr($instance['tw_width']); ?>"  class="widefat" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_height' ) ); ?>"><?php esc_html_e('Widget height:', 'mim-plugin') ?></label>
					<input type="number" id="<?php echo wp_kses_post( $this->get_field_id( 'tw_height' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_height' ) ); ?>" value="<?php if( isset($instance['tw_height']) ) echo esc_attr($instance['tw_height']); ?>"  class="widefat" />
				</p>
			 
	 	    	<p>
	 				<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_noscrollbar' ) ); ?>"><?php esc_html_e('Scrollbar:', 'mim-plugin') ?></label>
	 				<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_noscrollbar' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_data_chrome_noscrollbar' ) ); ?>" class="widefat" >
	 				<?php
	 					$tw_data_chrome_noscrollbar_name = array(
	 						'' => 'Show', 
	 						'noscrollbar' => 'Hide', 
	 					);
	 					foreach ($tw_data_chrome_noscrollbar_name as $key => $value) {
	 						( $instance['tw_data_chrome_noscrollbar'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
	 						echo "<option $selected value='$key'>$value</option>";
	 					}
	 				?>
	 				</select>
	 			</p>

	 			<p>
	 				<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_transparent' ) ); ?>"><?php esc_html_e('Transparent Background:', 'mim-plugin') ?></label>
	 				<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_transparent' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_data_chrome_transparent' ) ); ?>" class="widefat" >
	 				<?php
	 					$tw_data_chrome_transparent_name = array(
	 						'transparent' => 'Yes', 
	 						'' => 'No', 
	 					);
	 					foreach ($tw_data_chrome_transparent_name as $key => $value) {
	 						( $instance['tw_data_chrome_transparent'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
	 						echo "<option $selected value='$key'>$value</option>";
	 					}
	 				?>
	 				</select>
	 			</p>

	 			<p>
	 				<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_noheader' ) ); ?>"><?php esc_html_e('Show Header:', 'mim-plugin') ?></label>
	 				<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_noheader' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_data_chrome_noheader' ) ); ?>" class="widefat" >
	 				<?php
	 					$tw_data_chrome_noheader_name = array(
	 						'' => 'Yes', 
	 						'noheader' => 'No', 
	 					);
	 					foreach ($tw_data_chrome_noheader_name as $key => $value) {
	 						( $instance['tw_data_chrome_noheader'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
	 						echo "<option $selected value='$key'>$value</option>";
	 					}
	 				?>
	 				</select>
	 			</p>

	 			<p>
	 				<label for="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_nofooter' ) ); ?>"><?php esc_html_e('Show Footer:', 'mim-plugin') ?></label>
	 				<select id="<?php echo wp_kses_post( $this->get_field_id( 'tw_data_chrome_nofooter' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'tw_data_chrome_nofooter' ) ); ?>" class="widefat" >
	 				<?php
	 					$tw_data_chrome_nofooter_name = array(
	 						'' => 'Yes', 
	 						'nofooter' => 'No', 
	 					);
	 					foreach ($tw_data_chrome_nofooter_name as $key => $value) {
	 						( $instance['tw_data_chrome_nofooter'] == $key ) ?  $selected = "selected='selected'"  : $selected = "" ;
	 						echo "<option $selected value='$key'>$value</option>";
	 					}
	 				?>
	 				</select>
	 			</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'post_count' ) ); ?>"><?php esc_html_e('Post want to show:', 'mim-plugin') ?></label>
					<input type="number" id="<?php echo wp_kses_post( $this->get_field_id( 'post_count' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'post_count' ) ); ?>" value="<?php if( isset($instance['post_count']) ) echo esc_attr($instance['post_count']); ?>"  class="widefat" />
				</p>

		    	<p>
					<label for="<?php echo wp_kses_post( $this->get_field_id( 'profile_url' )); ?>"><?php esc_html_e('Twitter Profile URL:', 'mim-plugin') ?></label>
					<input type="url" id="<?php echo wp_kses_post( $this->get_field_id( 'profile_url' ) ); ?>" name="<?php echo wp_kses_post( $this->get_field_name( 'profile_url' )); ?>" value="<?php if( isset($instance['profile_url']) ) echo esc_url($instance['profile_url']); ?>"  class="widefat" />
				</p>
			
		   <?php 
		} // from end function

		/*===============================================
		=============== Update Funcion ==================
		===============================================*/	
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;
			//Strip tags from title and name to remove HTML
			foreach ($new_instance as $key => $value) {
			    if ( $key == "profile_url" ) {
			        $instance[$key] = esc_url( $new_instance[$key] );
			    } else {                
			        $instance[$key] = strip_tags( $new_instance[$key] );
			    }
			} // end for each
			return $instance;
		} // End Update Function

		/*===============================================
		=============== Widget Funcion ==================
		===============================================*/
		function widget( $args, $instance ) {
			extract( $args );
			/* User-selected settings. */
			$title = apply_filters('widget_title', $instance['title'] );
			$profile_url = $instance['profile_url'];
			$tw_data_chrome_noscrollbar = (!empty( $instance['tw_data_chrome_noscrollbar'])) ? $instance['tw_data_chrome_noscrollbar'] : '';
			$tw_data_chrome_transparent = (!empty( $instance['tw_data_chrome_transparent'])) ? $instance['tw_data_chrome_transparent'] : '';
			$tw_data_chrome_noheader = (!empty( $instance['tw_data_chrome_noheader'])) ? $instance['tw_data_chrome_noheader'] : '';
			$tw_data_chrome_nofooter = (!empty( $instance['tw_data_chrome_nofooter'])) ? $instance['tw_data_chrome_nofooter'] : '';
			$post_count = $instance['post_count'];
			$link_color = $instance['link_color'];
			$tw_theme = $instance['tw_theme'];
			$tw_width = $instance['tw_width'];
			$tw_height = $instance['tw_height'];
			$tw_border_color = $instance['tw_border_color'];
			$tw_lang = $instance['tw_lang'];

			/* Before widget (defined by themes). */
			echo wp_kses_post( $before_widget );

			/* Title of widget (before and after defined by themes). */
			if ( $title ) {
				echo wp_kses_post( $before_title ) . $title . $after_title;
			}

		?>

				<div class="about-contact-area twitter_profile"> <a class="twitter-timeline" 
				href="<?php echo wp_kses_post( $profile_url ); ?>" 
				data-tweet-limit="<?php echo wp_kses_post( $post_count ); ?>" 
				data-link-color="<?php echo wp_kses_post( $link_color ); ?>" 
				data-theme="<?php echo wp_kses_post( $tw_theme ); ?>" 
				data-width="<?php echo wp_kses_post( $tw_width ); ?>" 
				data-height="<?php echo wp_kses_post( $tw_height ); ?>" 
				data-chrome="<?php if (isset($tw_data_chrome_noscrollbar)) { echo wp_kses_post( $tw_data_chrome_noscrollbar )." "; } if (isset($tw_data_chrome_transparent)) { echo wp_kses_post( $tw_data_chrome_transparent )." ";  } if (isset($tw_data_chrome_noheader)) { echo wp_kses_post( $tw_data_chrome_noheader )." "; } if (isset($tw_data_chrome_nofooter)) { echo wp_kses_post( $tw_data_chrome_nofooter )." "; }?>"  
				data-border-color="<?php echo wp_kses_post( $tw_border_color ); ?>"
				data-lang="<?php echo wp_kses_post( $tw_lang ); ?>" 
				lang="<?php echo wp_kses_post( $tw_lang ); ?>" > Tweet</a> </div>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<?php 
			/* After widget (defined by themes). */
			echo wp_kses_post( $after_widget );
		} // End widget function




		function widgets_scripts( $hook ) {
		    if ( 'widgets.php' != $hook ) {
		        return;
		    }
		    wp_enqueue_style( 'wp-color-picker' );        
		    wp_enqueue_script( 'wp-color-picker' ); 
		}


		public function register_widget(){
		    register_widget( $this );
		}
}