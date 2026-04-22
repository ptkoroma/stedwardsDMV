<?php 
	namespace MimTheme\Plugin\Admin;


	/**
	 * The menu handler class
	 */
	class Menu {


		
		function __construct()
		{
			add_action('admin_menu' , [$this, 'admin_menu']);
			add_filter('admin_footer_text',  [$this, 'Admin_Footer_Text']);
			add_filter('update_footer',  [$this, 'Admin_Update_Footer'], 11);
			add_filter( 'pre_set_site_transient_update_themes', [$this, 'Transient_Update_Themes']);
			add_action('admin_enqueue_scripts', [$this, 'Plugin_Admin_Scripts'] );
		}




		public function admin_menu()
		{
			/* wp doc: add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); */
		    add_menu_page( 
		        esc_html__('MIM', 'mim-plugin'),
		        esc_html__('Mim Theme', 'mim-plugin'), 
		        "manage_options", 
		        "mim-welcome", 
		        [ $this , 'WelCome' ], 
		        'dashicons-book', 
		        2
		    );
		    /* wp doc: add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function); */
		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('Welcome', 'mim-plugin'), 
		        esc_html__('Welcome', 'mim-plugin'), 
		        'manage_options', 
		        'mim-welcome', 
		        [ $this , 'WelCome' ]
		    ); 
		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('Item Registration', 'mim-plugin'), 
		        esc_html__('Item Registration', 'mim-plugin'), 
		        'manage_options', 
		        'mim-item-registration', 
		        [ $this , 'Item_Registation' ]
		    ); 

		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('Auto Setup', 'mim-plugin'), 
		        esc_html__('Auto Setup', 'mim-plugin'), 
		        'manage_options', 'mim-auto-setup', 
		        [ $this , 'Auto_Setup' ]
		    );

		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('System Status', 'mim-plugin'), 
		        esc_html__('System Status', 'mim-plugin'), 
		        'manage_options', 'mim-system-status', 
		        [ $this , 'System_Status' ]
		    );

		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('Changelog', 'mim-plugin'), 
		        esc_html__('Changelog', 'mim-plugin'), 
		        'manage_options', 'mim-change-log', 
		        [ $this , 'Changelog' ]
		    );

		    add_submenu_page( 
		        "mim-welcome", 
		        esc_html__('Theme Customizer', 'mim-plugin'), 
		        esc_html__('Theme Customizer', 'mim-plugin'), 
		        'manage_options', 
		        'customize.php', 
		        null
		    );
		}




		public function Admin_Footer_Text() 
		{ 
		    echo '<span id="footer-thankyou">Thank you for choosing MIM. We are honored and are fully dedicated to making your experience perfect. To see more awesome item please visit <a href="https://www.themearray.com">ThemeArray</a>.</span>';
		} 


		public function Admin_Update_Footer($default) 
		{ 
		    echo 'Thank you for creating with <a href="https://wordpress.org/">WordPress</a>. ' . $default;
		} 



		/**
		 * Allow HTML tag from escaping HTML 
		 * 
		 * @return void
		 * @since v1.0
		 */
		public static function html_allow() {
		    return array(
		        'a' => array(
		            'href' => array(),
		            'title' => array()
		        ),
		        'br' => array(),
		        'del' => array(),
		        'span' => array(),
		        'em' => array(),
		        'strong' => array(),
		        'h1' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'h2' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'h3' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'h4' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'h5' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'h6' => array(
		            'class' => array(),
		            'id' => array(),
		        ),            
		        'div' => array(
		            'class' => array(),
		            'id' => array(),
		        ),
		        'p' => array(
		            'class' => array(),
		            'id' => array(),
		        ),
		    );
		}



		/**
		 *  Welcome Header
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function Welcome_Header() { 
		    global $registration_complete, $tf_token, $tf_purchase_code;
		    $mim_options = get_option( 'mim_verification_key' );
		    $registration_complete = false;
		    $tf_token = isset( $mim_options[ 'tf_token' ] ) ? $mim_options[ 'tf_token' ] : ''; 
		    $tf_purchase_code = isset( $mim_options[ 'tf_purchase_code' ] ) ? $mim_options[ 'tf_purchase_code' ] : '';
		    if ( $tf_token !== ""  && $tf_purchase_code !== "" ) {
		        $registration_complete = true;
		    } 

			?>
				<div class="mim_info_header text-center">
					
				    <h1><?php esc_html_e( "Welcome to MIM!", 'mim-plugin' ); ?></h1>
				    <div class="about-text"><?php esc_html_e( 'MIM is now installed and ready to use! Get ready to build something beautiful. Please register your purchase to get support, auto setup and automatic theme updates. Read below for additional information. We hope you enjoy it!', 'mim-plugin' ); ?></div>
				    <h2 class="nav-tab-wrapper">
				        <?php
					        $active_tab = (isset( $_GET['page'] )) ? $_GET['page'] : 'mim-welcome';  
					        $welcome_tab = ($active_tab == 'mim-welcome') ? 'nav-tab-active' : '';
					        $registration_tab = ($active_tab == 'mim-item-registration') ? 'nav-tab-active' : ''; 
					        $auto_setup_tab = ($active_tab == 'mim-auto-setup') ? 'nav-tab-active' : '';
					        $system_status_tab = ($active_tab == 'mim-system-status') ? 'nav-tab-active' : '';
					        $changelog_tab = ($active_tab == 'mim-change-log') ? 'nav-tab-active' : '';

					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'admin.php?page=mim-welcome'), $welcome_tab,  esc_html__( "Welcome", 'mim-plugin' ) );
					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'admin.php?page=mim-item-registration'), $registration_tab,  esc_html__( "Item Registration", 'mim-plugin' ) ); 
					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'admin.php?page=mim-auto-setup'), $auto_setup_tab,  esc_html__( "Auto Setup", 'mim-plugin' ) );
					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'admin.php?page=mim-system-status'), $system_status_tab,  esc_html__( "System Status", 'mim-plugin' ) );
					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'admin.php?page=mim-change-log'), $changelog_tab,  esc_html__( "Changelog", 'mim-plugin' ) );
					        printf( '<a href="%s" class="nav-tab %s">%s</a>', admin_url( 'customize.php'), '',  esc_html__( "Theme Customizer", 'mim-plugin' ) );
				        ?>
			    	</h2>
				</div>
		<?php }



		/**
		 *  Welcome Function
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function WelCome() { 
		    global $registration_complete; ?>
		    <div class="wrap about-wrap ta-wrap">
		        <?php self::Welcome_Header(); ?>
		        <div class="mim-support-section"> 

		            <div class="mim-important-notice">
		                <p class="about-description">
		                    <?php if ( !$registration_complete ) { 
		                    esc_html_e( 'To access our support forum and resources, you first must register your purchase. ', 'mim-plugin' ); 
		                    printf( wp_kses( __( 'See the <a href="%s">Item Registration</a> tab for instructions on how to complete registration.', 'mim-plugin' ), self::html_allow() ), admin_url('admin.php?page=mim-item-registration') );
		                        
		                    } else {
		                        esc_html_e( 'Thanks a lot for register you item, Now you will get all support for free.', 'mim-plugin' ); 
		                    } ?>
		                </p>
		            </div><!--  /.mim-important-notice -->

		            <div class="feature-section col three-col">
		                <style>
		                    .margin-top-0 {
		                        margin-top: 0 !important;
		                    }
		                </style>
		                <div class="col margin-top-0">
		                    <h3><span class="dashicons dashicons-sos"></span><?php esc_html_e( "Submit A Ticket", 'mim-plugin' ); ?></h3>
		                    <p><?php esc_html_e( "We offer excellent support through our advanced ticket system. Make sure to register your purchase first to access our support services and other resources.", 'mim-plugin' ); ?></p>
		                    <a href="<?php echo esc_url('http://www.regaltheme.com/support') ?>" class="button button-large button-primary mim-large-button" target="_blank"><?php esc_html_e( 'Submit a ticket', 'mim-plugin' ); ?></a>
		                </div>
		                <div class="col margin-top-0">
		                    <h3><span class="dashicons dashicons-book"></span><?php esc_html_e( "Documentation", 'mim-plugin' ); ?></h3>
		                    <p><?php esc_html_e( "This is the place to go to reference different aspects of the theme. Our online documentaiton is an incredible resource for learning the ins and outs of using MIM.", 'mim-plugin' ); ?></p>
		                    <a href="https://wp.regaltheme.com/mim/doc/" class="button button-large button-primary mim-large-button" target="_blank"><?php esc_html_e( 'Documentation', 'mim-plugin' ); ?></a>
		                </div>
		               <!--  <div class="col margin-top-0 last-feature">
		                    <h3><span class="dashicons dashicons-portfolio"></span><?php //esc_html_e( "Knowledgebase", 'mim-plugin' ); ?></h3>
		                    <p><?php //esc_html_e( "Our knowledgebase contains additional content that is not inside of our documentation. This information is more specific and unique to various versions or aspects of MIM.", 'mim-plugin' ); ?></p>
		                    <a href="https://wp.reglatheme.com/mim-knowledgebase" class="button button-large button-primary mim-large-button" target="_blank"><?php //esc_html_e( 'Knowledgebase', 'mim-plugin' ); ?></a>
		                </div> -->
		            </div> 
		        </div>
		    </div><!-- /. wrap about-wrap ta-wrap -->
		<?php }

		/**
		 *  Item Registration
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function Item_Registation() { 
		    global $registration_complete, $tf_token, $tf_purchase_code; 
		    ?>

		    <div  class="wrap about-wrap ta-wrap">
		        <?php self::Welcome_Header(); ?>
		        <p class="registration-notice"><?php esc_html_e( "Your purchase must be registered to receive theme support, auto setup & auto updates. Please follow the step.", 'mim-plugin' ); ?></p>
		        <div class="mim-registration-steps">
		            <div class="feature-section col three-col">
		                <div class="col">
		                    <h3><?php esc_html_e( "Step 1 - Generate a ThemeForest token", 'mim-plugin' ); ?></h3>
		                    <p><a href="https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t" target="_blank"><?php esc_html_e( "Click here", 'mim-plugin' ); ?></a> <?php esc_html_e( "To get token from ThemeForest. View a tutorial", 'mim-plugin' ); ?> <a href="https://www.youtube.com/watch?v=vjP0glIIjiA" target="_blank"><?php esc_html_e( "here", 'mim-plugin' ); ?></a><?php esc_html_e( ". This gives you access to get theme auto updates", 'mim-plugin' ); ?></p>
		                </div>

		                <div class="col">
		                    <h3><?php esc_html_e( "Step 2 - Get ThemeForest purchase code", 'mim-plugin' ); ?></h3> 
		                    <p><?php esc_html_e( "After gatting token you need to get purchase code. ", 'mim-plugin' ); ?><a href="https://themeforest.net/downloads" target="_blank"><?php esc_html_e( "Click here", 'mim-plugin' ); ?></a> <?php esc_html_e( "to get purchase code from ThemeForest. View a tutorial", 'mim-plugin' ); ?> <a href="https://www.youtube.com/watch?v=JxA5j9PuBRc" target="_blank"><?php esc_html_e( "here", 'mim-plugin' ); ?></a><?php esc_html_e( ". This will verify your purchase item", 'mim-plugin' ); ?></p>
		                </div>
		                <div class="col last-feature">
		                    <h3><?php esc_html_e( "Step 3 - Verify purchase", 'mim-plugin' ); ?></h3>
		                    <p><?php esc_html_e( "Enter your ThemeForest token and purchase code into the fields below. This will give you access to automatic theme updates.", 'mim-plugin' ); ?></p>
		                </div>
		            </div> 
		        </div>
		        <div class="feature-section">
		            <div class="mim-important-notice registration-form-container">
		                <?php 
		                if ( $registration_complete ) {
		                    echo '<p class="about-description"><span class="dashicons dashicons-yes mim-icon-key"></span>' . esc_html__("Registration Complete! You can now receive Theme Support, Auto Setup, Auto Updates and future goodies.", 'mim-plugin') . '</p>';
		                    ?>
		                    <p class="about-description-success"><span class="dashicons dashicons-yes"></span><?php esc_html_e('You have sucessfully remove you registration', 'mim-plugin'); ?></p>
		                    <div class="mim-registration-form">
		                        <form id="mim_product_registration">
		                            <input type="hidden" name="action" value="mim_item_registration" />
		                            <input type="hidden" name="reg-type" value="remove" />
		                            <?php wp_nonce_field( 'mim_item_registration_tkn', 'tf-registration' ); ?>
		                            <input type="text" required="required" name="tf_token" value="<?php echo esc_attr($tf_token); ?>" placeholder="<?php esc_attr_e( "Themeforest Token", 'mim-plugin' ); ?>" />
		                            <input type="text" required="required" name="tf_purchase_code" value="<?php echo esc_attr($tf_purchase_code); ?>" placeholder="<?php esc_html_e( "Enter Themeforest Purchase Code", 'mim-plugin' ); ?>" />
		                            <button type="submit" class="button button-large button-primary mim-large-button submit-item-registration"><?php esc_html_e( "Remove Registration", 'mim-plugin' ); ?></button>
		                            <span class="mim-loader"><i class="dashicons dashicons-update loader-icon"></i><span></span></span>
		                        </form>
		                    </div> 
		                    <?php
		                } else { ?>
		                    <p class="about-description-faild-msg"><?php esc_html_e( "Sorry, Your given information not match. Please try agian", 'mim-plugin' ); ?></p> 
		                    <p class="about-description-success-before"><?php esc_html_e( "After Steps 1-2 are complete, enter your credentials below to complete product registration.", 'mim-plugin' ); ?></p> 
		                    <p class="about-description-success"><span class="dashicons dashicons-yes"></span><?php esc_html_e('Registration Complete! Thank you for registering your purchase, you can now receive automatic updates, theme support and future goodies.', 'mim-plugin'); ?></p>
		                    <div class="mim-registration-form">
		                        <form id="mim_product_registration">
		                            <input type="hidden" name="action" value="mim_item_registration" />
		                            <?php wp_nonce_field( 'mim_item_registration_tkn', 'tf-registration' ); ?>
		                            <input type="text" required="required" name="tf_token" value="<?php echo esc_attr($tf_token); ?>" placeholder="<?php esc_html_e( "Themeforest Token", 'mim-plugin' ); ?>" />
		                            <input type="text" required="required" name="tf_purchase_code" value="<?php echo esc_attr($tf_purchase_code); ?>" placeholder="<?php esc_attr_e( "Enter Themeforest Purchase Code", 'mim-plugin' ); ?>" />
		                            <button type="submit" class="button button-large button-primary mim-large-button submit-item-registration"><?php esc_html_e( "Submit", 'mim-plugin' ); ?></button>
		                            <span class="mim-loader"><i class="dashicons dashicons-update loader-icon"></i><span></span></span>
		                        </form>
		                    </div> 
		                <?php 
		            	} ?> 
		            </div>
		        </div>
		    </div><!-- /. wrap about-wrap ta-wrap -->
		<?php }

		/**
		 *  Auto Demo Setup
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function Auto_Setup() {
		    global $registration_complete; 

		    ?>

		    <div  class="wrap about-wrap ta-wrap">
		        <?php self::Welcome_Header(); ?> 
		        <p> 
		            <?php 
		                if ( !$registration_complete ) { 
		                    esc_html_e( 'To access our One Click Demo Installer, you first must register your purchase. ', 'mim-plugin' ); 
		                    printf( wp_kses( __( 'See the <a href="%s">Item Registration</a> tab for instructions on how to complete registration.', 'mim-plugin' ), self::html_allow() ), admin_url('admin.php?page=mim-item-registration') ); 
		                } else {
		                    printf( wp_kses( __( 'To import demo data, just go to <a href="%s">Click here to go Demo Importer Page</a>', 'mim-plugin' ), self::html_allow() ), admin_url( "tools.php?page=fw-backups-demo-content" ) );  
		                }  
		            ?>
		        </p>
		        <br />
		        <br />
		        <br />
		        <br />
		        <br />
		    </div>
		<?php }

		/**
		 *  Syetem Status
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function System_Status() {

			?>
			    <div  class="wrap about-wrap ta-wrap">
			        <?php $this::Welcome_Header(); ?>
			        <br />
			        <br />
			        <?php 
			        new Mim_system_status();
			        $get_activate_date = get_option('mim_plugin_installed');
			        if ($get_activate_date) {
			        	$date_format = get_option( 'date_format' );
			        	$time_format = get_option( 'time_format' );
			        	$active_time = date("$date_format $time_format", get_option('mim_plugin_installed'));
			        } else {
			        	$active_time = NULL;
			        }

			        

			        /*  ----------------------------------------------------------------------------
			            Theme config
			         */
			        $theme_info = wp_get_theme();
			        $theme_info = ( $theme_info->parent() ) ? $theme_info->parent() : $theme_info; 
			        $theme_name = $theme_info->get('Name'); 
			        $author_name = $theme_info->get('Author'); 
			        $theme_version = $theme_info->get('Version'); 

			        // Theme name
			        Mim_system_status::add('Theme config', array(
			            'check_name' => 'Theme name',
			            'tooltip' => 'Theme name',
			            'value' =>  $theme_name,
			            'status' => 'info'
			        ));

			        // Theme version
			        Mim_system_status::add('Theme config', array(
			            'check_name' => 'Theme version',
			            'tooltip' => 'Theme current version',
			            'value' =>  $theme_version,
			            'status' => 'info'
			        )); 

			        if($active_time):
				        // Theme Since
				        Mim_system_status::add('Theme config', array(
				            'check_name' => 'Using MIM from',
				            'tooltip' => 'Activated Time',
				            'value' =>  $active_time,
				            'status' => 'info'
				        )); 
				    endif;

			        // Theme author name
			        Mim_system_status::add('Theme config', array(
			            'check_name' => 'Theme author name',
			            'tooltip' => 'Theme author name',
			            'value' =>  $author_name,
			            'status' => 'info'
			        )); 

			        // Theme remote http channel used by the theme
			        $td_remote_http = '';

			        if (empty($td_remote_http['test_status'])) {

			        } elseif ($td_remote_http['test_status'] == 'all_fail') {
			            // all the http tests failed to run!
			            Mim_system_status::add('Theme config', array(
			                'check_name' => 'HTTP channel test',
			                'tooltip' => 'The theme cannot connect to other data sources. We are unable to get the number of likes, video information, tweets etc. This is usually due to a
			                misconfigured server or firewall',
			                'value' =>  $td_remote_http['test_status'],
			                'status' => 'red'
			            ));
			        } else {
			            // we have a http channel test that works
			            Mim_system_status::add('Theme config', array(
			                'check_name' => 'HTTP channel test',
			                'tooltip' => 'The theme has multiple ways to get information (like count, tweet count etc) from other sites and this is the channel that was detected to work with your host.',
			                'value' =>  $td_remote_http['test_status'],
			                'status' => 'green'
			            ));
			        }

			        // server info
			        Mim_system_status::add('php.ini configuration', array(
			            'check_name' => 'Server software',
			            'tooltip' => 'Server software version',
			            'value' =>  esc_html( $_SERVER['SERVER_SOFTWARE'] ),
			            'status' => 'info'
			        ));

			        // php version
			        Mim_system_status::add('php.ini configuration', array(
			            'check_name' => 'PHP version',
			            'tooltip' => 'You should have PHP version 5.2.4 or greater (recommended: PHP 5.4 or greater)',
			            'value' => phpversion(),
			            'status' => 'info'
			        ));

			        // mysql_version
			        global $wpdb;
			        Mim_system_status::add('php.ini configuration', array(
			            'check_name' => 'MySQL version',
			            'tooltip' => 'The version of MySQL installed on your hosting server',
			            'value' =>  $wpdb->db_version(),
			            'status' => 'info'
			        ));

			        // post_max_size
			        Mim_system_status::add('php.ini configuration', array(
			            'check_name' => 'post_max_size',
			            'tooltip' => 'Sets max size of post data allowed. This setting also affects file upload. To upload large files you have to increase this value and in some cases you also have to increase the upload_max_filesize value.',
			            'value' =>  ini_get('post_max_size') . '<span class="ta-status-small-text"> - You cannot upload images, themes and plugins that have a size bigger than this value. To see how you can change this please check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			            'status' => 'info'
			        ));

			        // php time limit
			        $max_execution_time = ini_get('max_execution_time');
			        if ($max_execution_time == 0 or $max_execution_time >= 60) {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'max_execution_time',
			                'tooltip' => 'This parameter is properly set',
			                'value' =>  $max_execution_time,
			                'status' => 'green'
			            ));
			        } else {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'max_execution_time',
			                'tooltip' => 'This sets the maximum time in seconds a script is allowed to run before it is terminated by the parser. The theme demos download images from our servers and depending on the connection speed this process may require a longer time to execute. We recommend that you should increase it 60 or more.',
			                'value' =>  $max_execution_time . '<span class="ta-status-small-text"> - the execution time should be bigger than 60 if you plan to use the demos. To see how you can change this please check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			                'status' => 'yellow'
			            ));
			        }

			        // php max input vars
			        $max_input_vars = ini_get('max_input_vars');
			        if ($max_input_vars == 0 or $max_input_vars >= 2000) {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'max_input_vars',
			                'tooltip' => 'This parameter is properly set',
			                'value' =>  $max_input_vars,
			                'status' => 'green'
			            ));
			        } else {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'max_input_vars',
			                'tooltip' => 'This sets how many input variables may be accepted (limit is applied to $_GET, $_POST and $_COOKIE superglobal separately). By default this parameter is set to 1000 and this may cause issues when saving the menu, we recommend that you increase it to 2000 or more. ',
			                'value' =>  $max_input_vars . '<span class="ta-status-small-text"> - the max_input_vars should be bigger than 2000, otherwise it can cause incomplete saves in the menu panel in WordPress. To see how you can change this please check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			                'status' => 'yellow'
			            ));
			        }

			        // suhosin
			        if (extension_loaded('suhosin') !== true) {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'SUHOSIN installed',
			                'tooltip' => 'Suhosin is not installed on your server.',
			                'value' => 'false',
			                'status' => 'green'
			            ));
			        } else {
			            Mim_system_status::add('php.ini configuration', array(
			                'check_name' => 'SUHOSIN Installed',
			                'tooltip' => 'Suhosin is an advanced protection system for PHP installations. It was designed to protect servers and users from known and unknown flaws in PHP applications and the PHP core. If it\'s installed on your host you have to increase the suhosin.post.max_vars and suhosin.request.max_vars parameters to 2000 or more.',
			                'value' =>  'SUHOSIN is installed - <span class="ta-status-small-text">it may cause problems with saving the theme panel if it\'s not properly configured. You have to increase the suhosin.post.max_vars and suhosin.request.max_vars parameters to 2000 or more. To see how you can change this please check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			                'status' => 'yellow'
			            ));

			            // suhosin.post.max_vars
			            if (ini_get( "suhosin.post.max_vars" ) >= 2000){
			                Mim_system_status::add('php.ini configuration', array(
			                    'check_name' => 'suhosin.post.max_vars',
			                    'tooltip' => 'This parameter is properly set',
			                    'value' => ini_get("suhosin.post.max_vars"),
			                    'status' => 'green'
			                ));
			            } else {
			                Mim_system_status::add('php.ini configuration', array(
			                    'check_name' => 'suhosin.post.max_vars',
			                    'tooltip' => 'You may encounter issues when saving the menu, to avoid this increase suhosin.post.max_vars parameter to 2000 or more.',
			                    'value' => ini_get("suhosin.post.max_vars"),
			                    'status' => 'yellow'
			                ));
			            }

			            // suhosin.request.max_vars
			            if (ini_get( "suhosin.request.max_vars" ) >= 2000){
			                Mim_system_status::add('php.ini configuration', array(
			                    'check_name' => 'suhosin.request.max_vars',
			                    'tooltip' => 'This parameter is properly set',
			                    'value' => ini_get("suhosin.request.max_vars"),
			                    'status' => 'green'
			                ));
			            } else {
			                Mim_system_status::add('php.ini configuration', array(
			                    'check_name' => 'suhosin.request.max_vars',
			                    'tooltip' => 'You may encounter issues when saving the menu, to avoid this increase suhosin.request.max_vars parameter to 2000 or more.',
			                    'value' => ini_get("suhosin.request.max_vars"),
			                    'status' => 'yellow'
			                ));
			            }
			        }

			        /*  ----------------------------------------------------------------------------
			            WordPress
			        */
			        // home url
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'WP Home URL',
			            'tooltip' => 'WordPress Address (URL) - the address where your WordPress core files reside',
			            'value' => home_url(),
			            'status' => 'info'
			        ));

			        // site url
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'WP Site URL',
			            'tooltip' => 'Site Address (URL) - the address you want people to type in their browser to reach your WordPress blog',
			            'value' => site_url(),
			            'status' => 'info'
			        ));

			        // home_url == site_url
			        if (home_url() != site_url()) {
			            Mim_system_status::add('WordPress and plugins', array(
			                'check_name' => 'Home URL - Site URL',
			                'tooltip' => 'Home URL not equal to Site URL, this may indicate a problem with your WordPress configuration.',
			                'value' => 'Home URL != Site URL <span class="ta-status-small-text">Home URL not equal to Site URL, this may indicate a problem with your WordPress configuration.</span>',
			                'status' => 'yellow'
			            ));
			        }

			        // version
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'WP version',
			            'tooltip' => 'WordPress version',
			            'value' => get_bloginfo('version'),
			            'status' => 'info'
			        ));


			        // is_multisite
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'WP multisite enabled',
			            'tooltip' => 'WP multisite',
			            'value' => is_multisite() ? 'Yes' : 'No',
			            'status' => 'info'
			        ));


			        // language
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'WP Language',
			            'tooltip' => 'WP Language - can be changed from Settings -> General',
			            'value' => get_locale(),
			            'status' => 'info'
			        ));

			        // memory limit
			        $memory_limit = Mim_system_status::wp_memory_notation_to_number(WP_MEMORY_LIMIT);
			        if ( $memory_limit < 67108864 ) {
			            Mim_system_status::add('WordPress and plugins', array(
			                'check_name' => 'WP Memory Limit',
			                'tooltip' => 'By default in wordpress the PHP memory limit is set to 40MB. With some plugins this limit may be reached and this affects your website functionality. To avoid this increase the memory limit to at least 64MB.',
			                'value' => size_format( $memory_limit ) . '/request <span class="ta-status-small-text">- We recommend setting memory to at least 64MB. The theme is well tested with a 40MB/request limit, but if you are using multiple plugins that may not be enough. See: <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">Increasing memory allocated to PHP</a>. You can also check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			                'status' => 'yellow'
			            ));
			        } else {
			            Mim_system_status::add('WordPress and plugins', array(
			                'check_name' => 'WP Memory Limit',
			                'tooltip' => 'This parameter is properly set.',
			                'value' => size_format( $memory_limit ) . '/request',
			                'status' => 'green'
			            ));
			        }

			        // wp debug
			        if (defined('WP_DEBUG') and WP_DEBUG === true) {
			            Mim_system_status::add('WordPress and plugins', array(
			                'check_name' => 'WP_DEBUG',
			                'tooltip' => 'The debug mode is intended for development and it may display unwanted messages. You should disable it on your side.',
			                'value' => 'WP_DEBUG is enabled. <span class="ta-status-small-text">It may display unwanted messages. To see how you can change this please check our guide <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">here</a>.</span>',
			                'status' => 'yellow'
			            ));
			        } else {
			            Mim_system_status::add('WordPress and plugins', array(
			                'check_name' => 'WP_DEBUG',
			                'tooltip' => 'The debug mode is disabled.',
			                'value' => 'False',
			                'status' => 'green'
			            ));
			        }

			        // caching
			        $caching_plugin_list = array(
			            'wp-super-cache/wp-cache.php' => array(
			                'name' => 'WP super cache - <span class="ta-status-small-text">for best performance please check the plugin configuration guide <a target="_blank" href="http://forum.tagdiv.com/cache-plugin-install-and-configure/">here</a>.</span>',
			                'status' => 'green',
			            ),
			            'w3-total-cache/w3-total-cache.php' => array(
			                'name' => 'W3 total cache - <span class="ta-status-small-text">we recommend <a target="_blank" href="https://ro.wordpress.org/plugins/wp-super-cache/">WP super cache</a></span>',
			                'status' => 'yellow',
			            ),
			            'wp-fastest-cache/wpFastestCache.php' => array(
			                'name' => 'WP Fastest Cache - <span class="ta-status-small-text">we recommend <a target="_blank" href="https://ro.wordpress.org/plugins/wp-super-cache/">WP super cache</a></span>',
			                'status' => 'yellow',
			            ),
			        );
			        $active_plugins = get_option('active_plugins');
			        $caching_plugin = 'No caching plugin detected - <span class="ta-status-small-text">for best performance we recommend using <a target="_blank" href="https://wordpress.org/plugins/wp-super-cache/">WP Super Cache</a></span>';
			        $caching_plugin_status = 'yellow';
			        foreach ($active_plugins as $active_plugin) {
			            if (isset($caching_plugin_list[$active_plugin])) {
			                $caching_plugin = $caching_plugin_list[$active_plugin]['name'];
			                $caching_plugin_status = $caching_plugin_list[$active_plugin]['status'];
			                break;
			            }
			        }
			        Mim_system_status::add('WordPress and plugins', array(
			            'check_name' => 'Caching plugin',
			            'tooltip' => 'A cache plugin generates static pages and improves the site pagespeed. The cached pages are stored in the memory and when a user makes a request the pages are delivered from the cache. By this the php execution and the database requests are skipped.',
			            'value' =>  $caching_plugin,
			            'status' => $caching_plugin_status
			        ));
			        Mim_system_status::render_tables(); ?>

			        <h3 class="screen-reader-text"><?php esc_html_e( 'Active Plugins', 'mim-plugin' ); ?></h3>
			        <table class="widefat ta-system-status-table" cellspacing="0">
			            <thead>
			                <tr>
			                    <th colspan="4" data-export-label="Active Plugins (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)"><?php esc_html_e( 'Active Plugins', 'mim-plugin' ); ?> (<?php echo count( (array) get_option( 'active_plugins' ) ); ?>)</th>
			                </tr>
			            </thead>
			            
			            <tbody>
			                <?php
			                $active_plugins = (array) get_option( 'active_plugins', array() );

			                if ( is_multisite() ) {
			                    $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
			                }

			                foreach ( $active_plugins as $plugin ) {
			                    
			                    $plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			                    $dirname        = dirname( $plugin );
			                    $version_string = '';
			                    $network_string = '';

			                    if ( ! empty( $plugin_data['Name'] ) ) {

			                        // link the plugin name to the plugin url if available
			                        $plugin_name = esc_html( $plugin_data['Name'] );

			                        if ( ! empty( $plugin_data['PluginURI'] ) ) {
			                            $plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . __( 'Visit plugin homepage' , 'mim-plugin' ) . '">' . $plugin_name . '</a>';
			                        }
			                        ?>
			                        <tr>
			                            <td class="ta-system-status-name"><?php echo($plugin_name); ?></td>
			                            <td class="ta-system-status-help"></td>
			                            <td class="ta-system-status-status">
			                                <div class="ta-system-status-led ta-system-status-green ta-tooltip" data-position="right" title="This plugin is now active."></div> 
			                            </td>
			                            <td><?php printf( _x( 'by %s', 'by author', 'mim-plugin' ), $plugin_data['Author'] ) . ' &ndash; ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string; ?></td>
			                        </tr>
			                        <?php
			                    }
			                }
			            ?>
			            </tbody>
			        </table> 
			    </div>
			<?php 
		}


		public function Transient_Update_Themes( $updates ) {
		    if ( ! current_user_can( 'update_themes' ) ) {
		        return;
		    }
		    if ( isset( $updates->checked ) ) { 
		        $theme_info = wp_get_theme();
		        $theme_info = ( $theme_info->parent() ) ? $theme_info->parent() : $theme_info; 
		        $theme_name = $theme_info->get('Name'); 
		        $author_name = $theme_info->get('Author'); 
		        $theme_version = $theme_info->get('Version'); 

		        $mim_options = get_option( 'mim_verification_key' );
		        $registration_complete = false;
		        $tf_token = isset( $mim_options[ 'tf_token' ] ) ? $mim_options[ 'tf_token' ] : ''; 
		        $tf_purchase_code = isset( $mim_options[ 'tf_purchase_code' ] ) ? $mim_options[ 'tf_purchase_code' ] : '';
		        if ( $tf_token != ""  && $tf_purchase_code != "" ) {
		            $registration_complete = true;
		        }
		        
		        if( $registration_complete ) {
		            $url_download = 'https://api.envato.com/v3/market/buyer/download?purchase_code='.$tf_purchase_code; 
		            $url_for_meta = 'https://api.envato.com/v3/market/buyer/purchase?code='.$tf_purchase_code; 
		            $defaults = array(
		                'headers' => array(
		                    'Authorization' => 'Bearer '.$tf_token,
		                    'User-Agent' => 'RegalTheme Mim Theme',
		                ),
		                'timeout' => 300,
		            ); 

		            $raw_response_url = wp_remote_get( $url_download, $defaults );
		            $raw_response_meta = wp_remote_get( $url_for_meta, $defaults );
		            $response_meta = json_decode( $raw_response_meta['body'], true );
		            $response_url = json_decode( $raw_response_url['body'], true );
		            $download_url = (isset($response_url['wordpress_theme'])) ? $response_url['wordpress_theme'] : '';

		            if(isset($response_meta['item']['wordpress_theme_metadata'])) {
		                $tf_theme_name = (isset($response_meta['item']['wordpress_theme_metadata']['theme_name'])) ? $response_meta['item']['wordpress_theme_metadata']['theme_name'] : '';
		                $tf_author_name = (isset($response_meta['item']['wordpress_theme_metadata']['author_name'])) ? $response_meta['item']['wordpress_theme_metadata']['author_name'] : '';
		                $tf_theme_version = (isset($response_meta['item']['wordpress_theme_metadata']['version'])) ? $response_meta['item']['wordpress_theme_metadata']['version'] : ''; 
		                $tf_theme_url = (isset($response_meta['item']['url'])) ? $response_meta['item']['url'] : '';  
		            }  else {
		            	$tf_theme_name = '';
		            }

		            if($theme_name == $tf_theme_name && $author_name == $tf_author_name) {
		                if( version_compare($tf_theme_version, $theme_version) === 1) {
		                    //remove all persistent-notices 
		                    $update  = array(
		                        "url"         => $tf_theme_url,
		                        "new_version" => $tf_theme_version,
		                        "package"     => $download_url
		                    );
		                    $updates->response[ $theme_info->get_stylesheet() ] = $update;
		                }
		            } 
		        }
		    }
		    return $updates;
		}


		public function Plugin_Admin_Scripts(){
			wp_enqueue_style('mim-plugin-admin-style', MIM_THEME_PLUGIN_ASSETS . 'admin/css/admin-style.css', array(), MIM_THEME_PLUGIN_VERSION);


			$protocol = is_ssl() ? 'https' : 'http';
			$check_rtl = false;
			if (is_rtl()) {
				$check_rtl = true;
			}

			wp_enqueue_script('mim-plugin-admin-script', MIM_THEME_PLUGIN_ASSETS . 'admin/js/admin-scripts.js', array('jquery'), MIM_THEME_PLUGIN_VERSION);
			wp_localize_script(
				"mim-plugin-admin-script",
				"mim",
				array(
					"ajaxurl" => admin_url("admin-ajax.php"),
					"check_rtl" => $check_rtl,
				)
			);
		}

		/**
		 *  Auto Demo Setup
		 *
		 * @package MIM
		 * @since 1.0
		 */
		public function Changelog() {
		    global $registration_complete; 
			?>
			    <div  class="wrap about-wrap ta-wrap">
			        <?php self::Welcome_Header(); ?> 

			            <code>
				            <pre>

			        		<h3 style="margin-left: 19%;">CHANGELOG <br>====================</h3>

			        		<strong>10 March 2025</strong>
			        		-----------------------
			        		* Elementor widget code updated.
			        		* Demo importer issue solved.
			        		* Solved js conflict issue. 
			        		* PHP 8.2 version support. 
			        		* Optimize site speed. 
			        		* WordPress 6+ version support.

				            <strong>3.1 - 16 September 2022</strong>
				            -----------------------
				            * Added Elementor support.
				            * Optimize CSS And JS codes. 
				            * Solved js conflict issue.   
				            * Theme and theme-plugin codes upgraded to OOP.  
				            * Optimize site speed.
				            * WordPress 6+ version support.
		 					<br>
				            <strong>08 March 2019 - v3.0</strong>
				            -----------------------
				            * RTL Support Added.
				            * 10 Built-in Preloader. 
				            * Dropdown menu support for hamberger and mobile.  
				            * Every size device Responsive.  
				            * Optimize code. 
		 					<br>
				            <strong>22 Dec 2017-  v2.2</strong>
				            ------------------------
				            * Menu Problem solve (Now menu works on every page) - Bug fix.
				            * Translation file update (POT) - Updated.
				            * Optimized code to speed up - Optimization .
				            * PHP Fatal error solved ( Cannot redeclare _action_hide_extensions_from_the_list() ) - Bug Fix.
		 					<br>
				            <strong>13/10/2017 - v2.0</strong>
				            ------------------------
				            * Portfolio single (details) page added (New Feature).
				            * Builder description section HTML code support (Updated).
				            * Optimized code to speed up (Optimization).
				            * Portfolio shortcode style switcher added.
							<br>
				            <strong>06/08/2017 - v1.2</strong>
				            ------------------------
				            * Menu and portfolio filter text strike through controller added (New Feature).
				            * Builder section color change option added (New Feature).
				            * Optimized code to speed up (Optimization).
				            * Added Two new section shortcode (New Feature).
				                *** Timeline.
				                *** Pricing Table.
				            * IE-10 JS error problem fix (Bug fix).
				             <br>
				            <strong>29/07/2017 - v1.1</strong>
				            ---------------------
				            * Fix menu style issue (Bug fix).
				            * Builder section targeting ID added (New Feature).
				            * Optimized code to speed up (Optimization).
				            * Added custom widget (New Feature).
				                *** Facebook.
				                *** Google+.
				                *** Twitter Feed.
				                *** MailChimp News Letter.
				                *** Follow me widget.
				            <br>

				            <strong>25/07/2017  - v1.0</strong>
				            ------------------------
				            * Initial Release. 
		 					
				            </pre>
				        </code>
			        <br />
			        <br />
			        <br />
			        <br />
			        <br />
			    </div>
			<?php 
		}




	}


	class Mim_system_status 
	{
        static $system_status = array();
        static function add($section, $status_array) {
            self::$system_status[$section] []= $status_array;
        }

        static function render_tables() {
            foreach (self::$system_status as $section_name => $section_statuses) {
                ?>
                <table class="widefat ta-system-status-table" cellspacing="0">
                    <thead>
                        <tr>
                           <th colspan="4"><?php echo esc_html($section_name); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                foreach ($section_statuses as $status_params) {
                    ?>
                    <tr>
                        <td class="ta-system-status-name"><?php echo esc_html($status_params['check_name']); ?></td>
                        <td class="ta-system-status-help"><!--<a href="#" class="help_tip">[?]</a>--></td>
                        <td class="ta-system-status-status">
                            <?php
                                switch ($status_params['status']) {
                                    case 'green':
                                        echo '<div class="ta-system-status-led ta-system-status-green ta-tooltip" data-position="right" title="' . $status_params['tooltip'] . '"></div>';
                                        break;
                                    case 'yellow':
                                        echo '<div class="ta-system-status-led ta-system-status-yellow ta-tooltip" data-position="right" title="' . $status_params['tooltip'] . '"></div>';
                                        break;
                                    case 'red' :
                                        echo '<div class="ta-system-status-led ta-system-status-red ta-tooltip" data-position="right" title="' . $status_params['tooltip'] . '"></div>';
                                        break;
                                    case 'info':
                                        echo '<div class="ta-system-status-led ta-system-status-info ta-tooltip" data-position="right" title="' . $status_params['tooltip'] . '">i</div>';
                                        break;

                                }


                            ?>
                        </td>
                        <td class="ta-system-status-value"><?php echo($status_params['value']); ?></td>
                    </tr>
                    <?php
                }
                ?>
                    </tbody>
                </table>
                <?php
            }
        } 

        static function wp_memory_notation_to_number( $size ) {
            $l   = substr( $size, -1 );
            $ret = substr( $size, 0, -1 );
            switch ( strtoupper( $l ) ) {
                case 'P':
                    $ret *= 1024;
                case 'T':
                    $ret *= 1024;
                case 'G':
                    $ret *= 1024;
                case 'M':
                    $ret *= 1024;
                case 'K':
                    $ret *= 1024;
            }
            return $ret;
        }
    }