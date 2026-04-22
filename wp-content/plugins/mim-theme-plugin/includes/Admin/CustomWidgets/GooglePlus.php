<?php 
	namespace MimTheme\Plugin\Admin\CustomWidgets;


	class GooglePlus extends \WP_Widget {

		function __construct() {
		    $params = array (
		        'description' => esc_html__('Mim : Google Plus Widget', 'mim-plugin'),
		        'name' => esc_html__('Mim : Google Plus', 'mim-plugin')
		    );
		    parent::__construct('GooglePlus', esc_html__('Mim : Google Plus', 'mim-plugin'),$params);
		    self::register_widget();
		}


		var $langs = array(
			'af' => 'Afrikaans',
			'am' => 'Amharic',
			'ar' => 'Arabic',
			'eu' => 'Basque',
			'bn' => 'Bengali',
			'bg' => 'Bulgarian',
			'ca' => 'Catalan',
			'zh-HK' => 'Chinese (Hong Kong)',
			'zh-CN' => 'Chinese (Simplified)',
			'zh-TW' => 'Chinese (Traditional)',
			'hr' => 'Croatian',
			'cs' => 'Czech',
			'da' => 'Danish',
			'nl' => 'Dutch',
			'en-GB' => 'English (UK)',
			'en-US' => 'English (US)',
			'et' => 'Estonian',
			'fil' => 'Filipino',
			'fi' => 'Finnish',
			'fr' => 'French',
			'fr-CA' => 'French (Canadian)',
			'gl' => 'Galician',
			'de' => 'German',
			'el' => 'Greek',
			'gu' => 'Gujarati',
			'iw' => 'Hebrew',
			'hi' => 'Hindi',
			'hu' => 'Hungarian',
			'is' => 'Icelandic',
			'id' => 'Indonesian',
			'it' => 'Italian',
			'ja' => 'Japanese',
			'kn' => 'Kannada',
			'ko' => 'Korean',
			'lv' => 'Latvian',
			'lt' => 'Lithuanian',
			'ms' => 'Malay',
			'ml' => 'Malayalam',
			'mr' => 'Marathi',
			'no' => 'Norwegian',
			'fa' => 'Persian',
			'pl' => 'Polish',
			'pt-BR' => 'Portuguese (Brazil)',
			'pt-PT' => 'Portuguese (Portugal)',
			'ro' => 'Romanian',
			'ru' => 'Russian',
			'sr' => 'Serbian',
			'sk' => 'Slovak',
			'sl' => 'Slovenian',
			'es' => 'Spanish',
			'es-419' => 'Spanish (Latin America)',
			'sw' => 'Swahili',
			'sv' => 'Swedish',
			'ta' => 'Tamil',
			'te' => 'Telugu',
			'th' => 'Thai',
			'tr' => 'Turkish',
			'uk' => 'Ukrainian',
			'ur' => 'Urdu',
			'vi' => 'Vietnamese',
			'zu' => 'Zulu',
		);


		function widget($args, $instance)
		{
			extract($args);

			$title = apply_filters('widget_title', $instance['title']);		
			$page_type = $instance['page_type'];
			$page_url = $instance['page_url'];
			$width = $instance['width'];
			$color_scheme = $instance['color_scheme'];
			$gp_layout = $instance['gp_layout'];
			$cover_photo = isset($instance['cover_photo']) ? 'true' : 'false';
			$tagline = isset($instance['tagline']) ? 'true' : 'false';
			$lang = $instance['lang'];
			echo wp_kses_post( $before_widget );

			if($title) {
				echo wp_kses_post( $before_title ).$title.$after_title;
			}
			?>
				<div class="mim-theme-googleplus-widget">
					<div class="mgw-inner">
						<?php
						if($page_url): ?>	
							<?php 
								if ( $page_type == 'profile' ) {
									$badge_class = 'g-person';
								} elseif ( $page_type == 'page' ) {
									$badge_class = 'g-page' ;
								} else {
									$badge_class = 'g-community' ;
								}
							?>
							<div class="<?php echo esc_attr( $badge_class ); ?>" data-width="<?php echo wp_kses_post( $width ); ?>" data-href="<?php echo wp_kses_post( $page_url ); ?>" data-layout="<?php echo wp_kses_post( $gp_layout ); ?>" data-theme="<?php echo wp_kses_post( $color_scheme ); ?>" data-rel="publisher" data-showtagline="<?php echo wp_kses_post( $tagline ); ?>" data-showcoverphoto="<?php echo wp_kses_post( $cover_photo ); ?>"></div>
							<!-- Place this tag after the last badgev2 tag. -->
							<script type="text/javascript">
								var lang = '<?php echo wp_kses_post( $lang ); ?>';
								if (lang !== '') {
									 window.___gcfg = {lang: lang};
								}
							  (function() {
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/platform.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
						<?php endif;
						?>
					</div>		
					<div class="mgw-cover"></div>
				</div>

			<?php
			echo wp_kses_post( $after_widget );
		}
		
		function update($new_instance, $old_instance){
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['page_type'] = $new_instance['page_type'];
			$instance['page_url'] = $new_instance['page_url'];
			$instance['width'] = $new_instance['width'];
			$instance['gp_layout'] = $new_instance['gp_layout'];
			$instance['color_scheme'] = $new_instance['color_scheme'];
			$instance['cover_photo'] = $new_instance['cover_photo'];
			$instance['tagline'] = $new_instance['tagline'];
			$instance['lang'] = $new_instance['lang'];
			
			return $instance;
		}


		 /** @see WP_Widget::form */
		function form($instance)
		{
			$defaults = array(
					'title' => esc_html__('Google+','mim-plugin'), 
					'page_url' => '//plus.google.com/+envato', 
					'width' => '352', 
					'color_scheme' => 'light', 
					'gp_layout' => 'portrait', 
					'page_type' => 'page', 
					'cover_photo' => 'on', 
					'tagline' => 'on', 
					'lang' => ''
				);
			$instance = wp_parse_args((array) $instance, $defaults); ?>
			

			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title','mim-plugin'); ?>:</label>
				<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id('title') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('title') ); ?>" value="<?php if( isset($instance['title']) ) echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('page_type') ); ?>"><?php esc_html_e('Page type','mim-plugin'); ?>:</label> 
				<select id="<?php echo wp_kses_post( $this->get_field_id('page_type') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('page_type') ); ?>" class="widefat">
					<option <?php if ('profile' == $instance['page_type']) echo 'selected="selected"'; ?>><?php esc_html_e('profile','mim-plugin'); ?></option>
					<option <?php if ('page' == $instance['page_type']) echo 'selected="selected"'; ?>><?php esc_html_e('page','mim-plugin'); ?></option>
					<option <?php if ('community' == $instance['page_type']) echo 'selected="selected"'; ?>><?php esc_html_e('community','mim-plugin'); ?></option>
				</select>
			</p>		
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('page_url') ); ?>"><?php esc_html_e('Google+ Page URL','mim-plugin'); ?>:</label>
				<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id('page_url') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('page_url') ); ?>" value="<?php if( isset($instance['page_url']) ) echo esc_url($instance['page_url']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('width') ); ?>"><?php esc_html_e('Width','mim-plugin'); ?>:</label>
				<input type="text" class="widefat" id="<?php echo wp_kses_post( $this->get_field_id('width') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('width') ); ?>" value="<?php if( isset($instance['width']) ) echo esc_attr($instance['width']); ?>" />
			</p>
			
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('color_scheme') ); ?>"><?php esc_html_e('Color Scheme','mim-plugin'); ?>:</label> 
				<select id="<?php echo wp_kses_post( $this->get_field_id('color_scheme') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('color_scheme') ); ?>" class="widefat">
					<option value="light" <?php selected($instance['color_scheme'], 'light'); ?>><?php esc_html_e('Light', 'mim-plugin'); ?></option>
					<option value="dark" <?php selected($instance['color_scheme'], 'dark'); ?>><?php esc_html_e('Dark', 'mim-plugin'); ?></option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('gp_layout') ); ?>"><?php esc_html_e('Layout','mim-plugin'); ?>:</label> 
				<select id="<?php echo wp_kses_post( $this->get_field_id('gp_layout') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('gp_layout') ); ?>" class="widefat">
					<option value="portrait" <?php selected($instance['gp_layout'], 'portrait'); ?>><?php esc_html_e('Portrait', 'mim-plugin'); ?></option>
					<option value="landscape" <?php selected($instance['gp_layout'], 'landscape'); ?>><?php esc_html_e('Landscape', 'mim-plugin'); ?></option>
				</select>
			</p>
			
			<p>
				<b><?php esc_html_e('Portrait Layout Settings','mim-plugin'); ?></b>
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['cover_photo'], 'on'); ?> id="<?php echo wp_kses_post( $this->get_field_id('cover_photo') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('cover_photo') ); ?>" /> 
				<label for="<?php echo wp_kses_post( $this->get_field_id('cover_photo') ); ?>"><?php esc_html_e('Cover Photo','mim-plugin'); ?></label>
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked($instance['tagline'], 'on'); ?> id="<?php echo wp_kses_post( $this->get_field_id('tagline') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('tagline') ); ?>" /> 
				<label for="<?php echo wp_kses_post( $this->get_field_id('tagline') ); ?>"><?php esc_html_e('Tagline','mim-plugin'); ?></label>
			</p>

			<p>
				<label for="<?php echo wp_kses_post( $this->get_field_id('lang') ); ?>"><?php esc_html_e('Language','mim-plugin'); ?>:</label> 
				<select id="<?php echo wp_kses_post( $this->get_field_id('lang') ); ?>" name="<?php echo wp_kses_post( $this->get_field_name('lang') ); ?>" style="width:100%;">
				<option value=""><?php esc_html_e('Select Language ...', 'mim-plugin'); ?></option>
				<?php foreach ($this->langs as $code => $name) { ?>
					<option value="<?php echo wp_kses_post( $code ); ?>" <?php selected($instance['lang'], $code); ?>><?php echo wp_kses_post( $name ); ?></option>
				<?php } ?>
				</select>
			</p>
			
		<?php
		}


		public function register_widget(){
		    register_widget( $this );
		}
}