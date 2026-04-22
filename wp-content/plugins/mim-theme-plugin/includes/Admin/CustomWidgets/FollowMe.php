<?php 
	namespace MimTheme\Plugin\Admin\CustomWidgets;


	

	class FollowMe extends \WP_Widget {

	    function __construct() {
	        $params = array (
	            'description' => esc_html__('Mim : Follow Me Info', 'mim-plugin'),
	            'name' => esc_html__('Mim : Follow Me', 'mim-plugin')
	        );
	        parent::__construct('FollowMe', esc_html__('Mim : Follow Me', 'mim-plugin'),$params);

	        self::register_widget();
	    }

	    public function form( $instance) {
	        $defaults = array(
	                'title' => esc_html__('Follow Us','mim-plugin'), 
	                'total_link' => 12,
	                'icon_1' => "fa-facebook",
	                'icon1_url' => "#",
	                'icon_2' => "fa-twitter",
	                'icon2_url' => "#",
	                'icon_3' => "fa-google-plus",
	                'icon3_url' => "#",
	                'icon_4' => "fa-bitbucket",
	                'icon4_url' => "#",
	                'icon_5' => "fa-github",
	                'icon5_url' => "#",
	                'icon_6' => "fa-behance",
	                'icon6_url' => "#",
	                'icon_7' => "fa-linkedin",
	                'icon7_url' => "#",
	                'icon_8' => "fa-dribbble",
	                'icon8_url' => "#",
	                'icon_9' => "fa-youtube",
	                'icon9_url' => "#",
	                'icon_10' => "fa-instagram",
	                'icon10_url' => "#",
	                'icon_11' => "fa-dropbox",
	                'icon11_url' => "#",
	                'icon_12' => "fa-wordpress",
	                'icon12_url' => "#",
	            );
	        $instance = wp_parse_args((array) $instance, $defaults);

	        extract($instance);
	       
	        $font_awesome_link = "http://fortawesome.github.io/Font-Awesome/cheatsheet/";
	        ?>   
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e('Title:','mim-plugin'); ?></label>
	            <input
	                class="widefat"
	                type="text"
	                id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
	                name="<?php echo esc_attr( $this->get_field_name('title') ); ?>"
	                value="<?php if( isset($title) ) echo esc_attr($title); ?>" />
	        </p> 
	        <p>
	            <?php esc_html_e('Font Awesome Icon Class, example: fa-facebook. Get the full list','mim-plugin'); ?> <a href="<?php echo esc_url( $font_awesome_link ); ?>"><?php esc_html_e('Here','mim-plugin'); ?></a>
	        </p>
	          
	        <?php
	            for ($i=1; $i <= $total_link; $i++) { 
	                $icon='icon_'.$i;
	                $url='icon'.$i.'_url';
	                ?>
	                <p>
	                    <label for="<?php echo esc_attr( $this->get_field_id($icon) ); ?>"><?php echo esc_html__("Social Link","mim")." ".$i.":"; ?></label>
	                    <input
	                        class="widefat margin-bottom"
	                        type="text"
	                        placeholder="<?php echo esc_html__("Font Awesome Icon","mim"); ?>"
	                        id="<?php echo esc_attr( $this->get_field_id($icon)); ?>"
	                        name="<?php echo esc_attr( $this->get_field_name($icon)); ?>"
	                        value="<?php if( isset($$icon) ) echo esc_attr($$icon); ?>" />
	                    <input
	                        class="widefat"
	                        type="text"
	                        placeholder="<?php echo esc_html__("Social URL","mim"); ?>"
	                        id="<?php echo esc_attr( $this->get_field_id($url)); ?>"
	                        name="<?php echo esc_attr( $this->get_field_name($url)); ?>"
	                        value="<?php if( isset($$url) ) echo esc_attr($$url); ?>" />
	                </p>
	                <?php
	            }
	        ?>
	        <p>
	            <label for="<?php echo esc_attr( $this->get_field_id('total_link')); ?>"><?php esc_html_e('Number of link you want to post:','mim-plugin'); ?></label>
	            <input 
	                id="<?php echo esc_attr( $this->get_field_id('total_link')); ?>" 
	                type="text" 
	                name="<?php echo esc_attr( $this->get_field_name('total_link')); ?>"
	                value="<?php if( isset($total_link) ) echo esc_attr($total_link); ?>"
	                size="3" />
	        </p>  
	        <p>
	            <?php
	                if( !isset($social_title) ) {
	                    $social_title = ""; 
	                }
	            ?>
	            <label for="<?php echo esc_attr( $this->get_field_id('social_title')); ?>"><?php esc_html_e('Social Icon Title','mim-plugin'); ?>:</label> 
	            <select id="<?php echo esc_attr( $this->get_field_id('social_title')); ?>" name="<?php echo esc_attr( $this->get_field_name('social_title')); ?>" class="widefat">
	                <option value="show" <?php if ('show' == $social_title) echo 'selected="selected"'; ?>><?php esc_html_e('Show', 'mim-plugin'); ?></option>
	                <option value="hide" <?php if ('hide' == $social_title) echo 'selected="selected"'; ?>><?php esc_html_e('Hide', 'mim-plugin'); ?></option>
	            </select>
	        </p>      
	        <?php
	    } // end form function

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;
	        //Strip tags from title and name to remove HTML
	        foreach ($new_instance as $key => $value) {
	            if ( $key == "total_link" ) {
	                $instance[$key] = intval( $new_instance[$key] );
	            } else {                
	                $instance[$key] = strip_tags( $new_instance[$key] );
	            }
	        } // end for each
	        return $instance;
	    }

	    public function widget($args, $instance) {
	        extract($args);
	        extract($instance);
	        $title = apply_filters( 'widget_title', $title );       
	   
	        echo ''.$before_widget;
	            if ( !empty( $title ) ) {
	                echo ''.$before_title . esc_html( $title ) . $after_title;
	            }
	            ?>
	            <div class="follow-us-area">                    
	                <?php
	                    $print_url = "";
	                    $i = 0;
	                    foreach ($instance as $keys => $value) {
	                        if ( $i == $total_link ) break;
	                        $key=explode("_", $keys);
	                        if($key[0] == 'icon') {
	                            if ( !empty($value) ) {
	                              $print_url=true;
	                              $icon = apply_filters( $value, $value );
	                            }
	                        } elseif ( isset( $key[1] ) && $key[1] == 'url' && $print_url) {
	                            $url = apply_filters( $value, $value ); 
	                            str_replace("fa-","", $icon);  
	                            $icon_arr = array("fa-" => "", "-" => " ");
	                            $icon_title = strtr($icon, $icon_arr);
	                            $show_icon_title = ($social_title == "show") ? $icon_title : "" ;
	                            echo "<a href='$url' class='follow-link'><i class='fa $icon'></i><span>$show_icon_title</span></a>";
	                            $print_url=false;
	                            $i++;
	                        }
	                        
	                    } // end foreach
	                ?>                
	            </div> <!-- /.follow-us-area -->                
	            <?php
	        echo ''.$after_widget;
	    }


	    public function register_widget(){
	            register_widget( $this );
	    }
}