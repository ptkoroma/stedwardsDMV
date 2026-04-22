<?php 
namespace MimTheme\Plugin;

/**
 * 
 */
class Admin
{
	
	function __construct()
	{
		self::CoreFunctions();
		self::ElementorFunctions();
	}


	public function CoreFunctions() {
		//new Admin\After_Activated();
		new Admin\CustomPosts();
		new Admin\Widgets();
		new Admin\Menu();
		new Admin\Mim_Functions();
	}

	public function ElementorFunctions() {

		if (did_action('elementor/loaded')) {
			new Elementor\ElementorWidgetSettings();
		}
		
	}
}