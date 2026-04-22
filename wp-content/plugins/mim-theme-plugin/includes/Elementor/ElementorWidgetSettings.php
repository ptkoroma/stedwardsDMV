<?php 
	namespace MimTheme\Plugin\Elementor;

	/**
	 * The menu handler class
	 */
	class ElementorWidgetSettings {


		
		function __construct()
		{
			add_action('elementor/widgets/register', [$this, 'init_widgets']);
			add_action('elementor/elements/categories_registered', [$this, 'register_new_category']);
			add_action('elementor/frontend/after_enqueue_styles', [$this, 'frontend_widget_styles']);
			add_action("elementor/frontend/after_enqueue_scripts", [$this, 'frontend_assets_scripts']);
		}



		public function init_widgets()
		{
			// Posts Categories Filter
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\PortfolioFilter() );

			// Posts Categories Filter
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\TestimonialCarousel() );

			//Posts Grid
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\PostsGrid() );

			//Contact Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Contacts() );

			//About Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\About() );

			//Blog Post Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Blog() );

			//Experience Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Experience() );

			//Pricing Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Pricing() );

			//Hero Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Hero() );

			//Service Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Service() );

			//Timeline Section
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \MimTheme\Plugin\Elementor\Widgets\Timeline() );
		}

		public function register_new_category($elements_manager)
		{
			$elements_manager->add_category('mimtheme', [
				'title' => esc_html__('Mim Theme', 'mim-plugin'),
				'icon' => 'eicon-nerd',
			]);
		}


		/**
		 * Add style and scripts
		 *
		 * Add the plugin style and scripts for this
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		/*
		plugin css
		*/
		function frontend_widget_styles()
		{
			wp_enqueue_style("mim-toolkit", MIM_THEME_PLUGIN_ASSETS . 'css/mim-toolkit.css', array(), MIM_THEME_PLUGIN_VERSION, 'all');
		}


		/*
		plugin elementor js
		*/
		function frontend_assets_scripts()
		{

			wp_enqueue_script("filter-active-js", MIM_THEME_PLUGIN_ASSETS . 'js/filter-active.js', array('jquery', 'mim-theme-plugins-js'), MIM_THEME_PLUGIN_VERSION, true);
			wp_enqueue_script("owl-carousel-active-js", MIM_THEME_PLUGIN_ASSETS . 'js/testimonial-carousel-active.js', array('jquery', 'mim-theme-plugins-js'), MIM_THEME_PLUGIN_VERSION, true);
		}

}