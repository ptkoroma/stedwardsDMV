<?php 

namespace MimTheme\Plugin\Admin;

/**
 * Widgets Class
 */
class Widgets
{
	
	function __construct()
	{

		add_action( 'widgets_init', [ $this , 'AllWidgets'] );

	}


	public function AllWidgets() {
		new \MimTheme\Plugin\Admin\CustomWidgets\FollowMe();
		new \MimTheme\Plugin\Admin\CustomWidgets\GooglePlus();
		new \MimTheme\Plugin\Admin\CustomWidgets\Facebook();
		new \MimTheme\Plugin\Admin\CustomWidgets\Twitter();
		new \MimTheme\Plugin\Admin\CustomWidgets\NewsLetter();
	}
}