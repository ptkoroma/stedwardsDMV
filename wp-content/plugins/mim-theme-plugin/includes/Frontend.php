<?php 
namespace MimTheme\Plugin;


/**
 * 
 */
class Frontend 
{
	
	function __construct()
	{
		self::CoreFunctions();
		self::ElementorFunctions();
	}


	public function CoreFunctions() {
		new Admin\CustomPosts();
		new Admin\Widgets();
		new Admin\Mim_Functions();
	}

	public function ElementorFunctions() {

		if (did_action('elementor/loaded')) {
			new Elementor\ElementorWidgetSettings();
		}
		
	}
}