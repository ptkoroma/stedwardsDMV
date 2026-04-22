<?php 
	namespace MimTheme\Plugin\Admin;

	/**
	 * 
	 */
	class CustomPosts
	{
		
		function __construct()
		{
			add_action('init', [ $this , 'portfolio_posts'], 0);
		}



	    public function portfolio_posts()
	    {

	        $portfolio_label = array(
	            'name' => esc_html_x('Portfolio', 'Post Type General Name', 'mim-plugin'),
	            'singular_name' => esc_html_x('Portfolio', 'Post Type Singular Name', 'mim-plugin'),
	            'menu_name' => esc_html__('Portfolio', 'mim-plugin'),
	            'parent_item_colon' => esc_html__('Parent Portfolio:', 'mim-plugin'),
	            'all_items' => esc_html__('All Portfolio', 'mim-plugin'),
	            'view_item' => esc_html__('View Portfolio', 'mim-plugin'),
	            'add_new_item' => esc_html__('Add New Portfolio', 'mim-plugin'),
	            'add_new' => esc_html__('New Portfolio', 'mim-plugin'),
	            'edit_item' => esc_html__('Edit Portfolio', 'mim-plugin'),
	            'update_item' => esc_html__('Update Portfolio', 'mim-plugin'),
	            'search_items' => esc_html__('Search Portfolio', 'mim-plugin'),
	            'not_found' => esc_html__('No portfolio found', 'mim-plugin'),
	            'not_found_in_trash' => esc_html__('No portfolio found in Trash', 'mim-plugin'),
	        );
	        $portfolio_args = array(
	            'label' => esc_html__('Portfolio', 'mim-plugin'),
	            'description' => esc_html__('Portfolio', 'mim-plugin'),
	            'labels' => $portfolio_label,
	            'supports' => array('title', 'editor', 'thumbnail'),
	            'taxonomies' => array('portfolio-category'),
	            'hierarchical' => false,
	            'public' => true,
	            'show_ui' => true,
	            'show_in_menu' => true,
	            'show_in_nav_menus' => true,
	            'show_in_admin_bar' => true,
	            'menu_position' => 20,
	            'menu_icon' => 'dashicons-schedule',
	            'can_export' => true,
	            'has_archive' => true,
	            'exclude_from_search' => true,
	            'publicly_queryable' => true,
	            'capability_type' => 'page',
	        );
	        register_post_type('portfolio', $portfolio_args);

	        // Add new taxonomy, make it hierarchical (like categories) 

	        $portfolio_taxonomy_labels = array(
	            'name'              => esc_html__('Portfolio Categories', 'mim-plugin'),
	            'singular_name'     => esc_html__('Portfolio Categories', 'mim-plugin'),
	            'search_items'      => esc_html__('Search Portfolio Category', 'mim-plugin'),
	            'all_items'         => esc_html__('All Portfolio Category', 'mim-plugin'),
	            'parent_item'       => esc_html__('Parent Portfolio Category', 'mim-plugin'),
	            'parent_item_colon' => esc_html__('Parent Portfolio Category:', 'mim-plugin'),
	            'edit_item'         => esc_html__('Edit Portfolio Category', 'mim-plugin'),
	            'update_item'       => esc_html__('Update Portfolio Category', 'mim-plugin'),
	            'add_new_item'      => esc_html__('Add New Portfolio Category', 'mim-plugin'),
	            'new_item_name'     => esc_html__('New Portfolio Category Name', 'mim-plugin'),
	            'menu_name'         => esc_html__('Portfolio Category', 'mim-plugin'),
	        );

	        // Now register the portfolio taxonomy
	        register_taxonomy('portfolio', array('portfolio'), array(
	            'hierarchical' => true,
	            'labels' => $portfolio_taxonomy_labels,
	            'show_ui' => true,
	            'show_admin_column' => true,
	            'query_var' => true,
	            'rewrite' => array('slug' => 'portfolio'),
	        ));
	    }
}