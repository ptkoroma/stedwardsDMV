<?php 

	namespace MimTheme\Plugin\Admin;

	/**
	 * 
	 */
	class Mim_Functions
	{
		
		function __construct()
		{

		}



    	/**
    	 *  Taxonomy List
    	 * @return array
    	 */
       	public function Display_Taxonomy_List($taxonomy = 'category')
       	{
           $terms = get_terms(array(
               'taxonomy' => $taxonomy,
               'hide_empty' => true,
           ));
           $options = array();
           if (!empty($terms) && !is_wp_error($terms)) {
               foreach ($terms as $term) {
                   //  $options[ $term->slug ] = $term->name;
                   $options[$term->term_id] = $term->name;
               }
               return $options;
           }
       	}


       	/**
       	 * Get Post List
       	 * return array
       	 */
       	public function Display_Posts_Name($post_type = 'post')
       	{
           	$options = array();
           	$options['0'] = __('Select', 'bstoolkit-for-elementor');
           	$all_post = array('posts_per_page' => -1, 'post_type' => $post_type);
           	$post_terms = get_posts($all_post);
           	if (!empty($post_terms) && !is_wp_error($post_terms)) {
               	foreach ($post_terms as $term) {
                   	$options[$term->ID] = $term->post_title;
               	}
               	return $options;
           	}
       	}


       	/**
       	 * Get Post List
       	 * return array
       	 */
       	public function Mim_Post_Name($post_type = 'post')
       	{
       	    $options = array();
       	    $options['0'] = esc_html__('Select', 'mim-plugin');
       	    // $perpage = wooaddons_get_option( 'loadproductlimit', 'wooaddons_others_tabs', '20' );
       	    $all_post = array('posts_per_page' => -1, 'post_type' => $post_type);
       	    $post_terms = get_posts($all_post);
       	    if (!empty($post_terms) && !is_wp_error($post_terms)) {
       	        foreach ($post_terms as $term) {
       	            $options[$term->ID] = $term->post_title;
       	        }
       	        return $options;
       	    }
       	}

      
      /*
      * contact form 7 function
      */
      public function mim_is_cf7_activated()
      {
          return class_exists('\WPCF7');
      }
      /**
       * Get a list of all CF7 forms
       *
       * @return array
       */
      public function mim_get_cf7_forms()
      {
          $forms = [];

          if (self::mim_is_cf7_activated()) {
              $_forms = get_posts([
                  'post_type'      => 'wpcf7_contact_form',
                  'post_status'    => 'publish',
                  'posts_per_page' => -1,
                  'orderby'        => 'title',
                  'order'          => 'ASC',
              ]);

              if (!empty($_forms)) {
                  $forms = wp_list_pluck($_forms, 'post_title', 'ID');
              }
          }

          return $forms;
      }

      /**
       * Sanitize magical do shotcode
       *
       * @param $class
       * @return string
       */
      function mim_do_shortcode($tag, array $atts = [], $content = null)
      {
          global $shortcode_tags;
          if (!isset($shortcode_tags[$tag])) {
              return false;
          }
          return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
      }
}