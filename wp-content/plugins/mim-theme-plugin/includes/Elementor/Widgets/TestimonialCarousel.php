<?php

namespace MimTheme\Plugin\Elementor\Widgets;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}



use MimTheme\Frontend\ThemeFunctions;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Utils;

/**
 * Elementor testimonial widget.
 *
 * Elementor widget that displays customer testimonials that show social proof.
 *
 * @since 1.0.0
 */
class TestimonialCarousel extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'mimtesticarousel';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Mim Testimonial', 'mim-plugin');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Blank widget belongs to.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories()
	{
		return ['mimtheme'];
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['testimonial', 'blockquote', 'carousel', 'slider', 'mim-plugin'];
	}

	/**
	 * Retrieve the list of scripts the Content Reveal widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */

	public function get_script_depends()
	{
		return [
			'mim-theme-plugins-js',
			'owl-carousel-active-js',
		];
	}
	/**
	 * Register testimonial widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
		    'mim_testimonial_section',
		    [
		        'label' => esc_html__('Mim Testimonial', 'mim-plugin'),
		        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
		);

		$this->add_control(
		    'testimonial_section_id',
		    [
		        'label' => esc_html__('Section ID', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::TEXT,
		        'label_block' => true,
		        'placeholder' => esc_html__('testimonial', 'mim-plugin'),
		        'default'     => esc_html__('testimonial', 'mim-plugin'),
		    ]
		);

		$this->add_control(
		    'testimonial_section_title',
		    [
		        'label' => esc_html__('Testimonial Title', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::TEXT,
		        'label_block' => true,
		        'placeholder' => esc_html__('My Testimonial', 'mim-plugin'),
		        'default'     => esc_html__('My Testimonial', 'mim-plugin'),
		    ]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __('Testimonial items', 'mim-plugin'),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'testimonial_item_image',
			[
				'type' => Controls_Manager::MEDIA,
				'label' => esc_html__('Image', 'mim-plugin'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'testimonial_item_name',
			[
				'label' => esc_html__('Name', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'John Doe',
			]
		);

		$repeater->add_control(
			'testimonial_item_user_position',
			[
				'label' => esc_html__('Position', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Designer',
			]
		);

		$repeater->add_control(
			'testimonial_item_description',
			[
				'label' => esc_html__('Description', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows' => '10',
				'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mim-plugin'),
			]
		);

		
		$this->add_control(
			'testimonial_items',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{testimonial_item_name}}}',
				'default' => [
					[
						'testimonial_item_name' => esc_html__('John Doe', 'mim-plugin'),
						'testimonial_item_user_position' => esc_html__('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio', 'mim-plugin'),
						'testimonial_item_description' => esc_html__('Designer', 'mim-plugin'),
					],
					[
						'testimonial_item_name' => esc_html__('Cristie Jonson', 'mim-plugin'),
						'testimonial_item_user_position' => esc_html__('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio', 'mim-plugin'),
						'testimonial_item_description' => esc_html__('Designer', 'mim-plugin'),
					],
					[
						'testimonial_item_name' => esc_html__('Adam Lord', 'mim-plugin'),
						'testimonial_item_user_position' => esc_html__('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio', 'mim-plugin'),
						'testimonial_item_description' => esc_html__('Designer', 'mim-plugin'),
					],


				]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'mim_settings_section',
			[
				'label' => __('Carousel Settings', 'mim-plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'mgpg_content_align',
			[
				'label' => __('Alignment', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'mim-plugin'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'mim-plugin'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'mim-plugin'),
						'icon' => 'eicon-text-align-right',
					],

				],
				'default' => 'center',
				'classes' => 'flex-{{VALUE}}',
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .single-slide' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'mim_products_number',
			[
				'label' => __('Carousel Items', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'max' => 100,
				'default' => 1,
				'description' => __('Enter How many items show at a time in the carousel', 'mim-plugin'),
				'frontend_available' => true,
			]
		);


		$this->add_control(
			'mim_autoplay',
			[
				'label' => __('Autoplay?', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'mim-plugin'),
				'label_off' => __('No', 'mim-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'mim_autoplay_delay',
			[
				'label' => __('Autoplay Delay', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'step' => 1,
				'max' => 50000,
				'default' => 5000,
				'description' => __('Autoplay Delay in milliseconds', 'mim-plugin'),
				'frontend_available' => true,
				'condition' => [
					'mim_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'mim_autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'step' => 100,
				'max' => 10000,
				'default' => 1000,
				'description' => __('Autoplay speed in milliseconds', 'mim-plugin'),
				'condition' => [
					'mim_autoplay' => 'yes'
				],
				'frontend_available' => 'true',
			]
		);

		$this->add_control(
			'mim_loop',
			[
				'label' => __('Infinite Loop?', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'mim-plugin'),
				'label_off' => __('No', 'mim-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'mim_autoplay_hover_pause',
			[
				'label' => __('Autoplay Hover Pause?', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'mim-plugin'),
				'label_off' => __('No', 'mim-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'mim_navdots_section',
			[
				'label' => __('Nav & Dots', 'mim-plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'mim_dots',
			[
				'label' => __('Slider Dots?', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'mim-plugin'),
				'label_off' => __('No', 'mim-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mim_navigation',
			[
				'label' => __('Slider Navigation?', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'mim-plugin'),
				'label_off' => __('No', 'mim-plugin'),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		/*$this->add_control(
			'mim_nav_prev_icon',
			[
				'label' => __('Choose Prev Icon', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-left',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'arrow-alt-circle-left',
						'arrow-circle-left',
						'arrow-left',
						'long-arrow-alt-left',
						'angle-left',
						'chevron-circle-left',
						'fa-chevron-left',
						'angle-double-left',
					],
					'fa-regular' => [
						'hand-point-left',
						'arrow-alt-circle-left',
						'caret-square-left',
					],
				],
				'condition' => [
					'mim_navigation' => 'yes',
				],

			]
		);
		$this->add_control(
			'mim_nav_next_icon',
			[
				'label' => __('Choose Next Icon', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'arrow-alt-circle-right',
						'arrow-circle-right',
						'arrow-right',
						'long-arrow-alt-right',
						'angle-right',
						'chevron-circle-right',
						'fa-chevron-right',
						'angle-double-right',
					],
					'fa-regular' => [
						'hand-point-right',
						'arrow-alt-circle-right',
						'caret-square-right',
					],
				],
				'condition' => [
					'mim_navigation' => 'yes',
				],

			]
		);*/


		$this->end_controls_section();

		/*
		*
		*Style Section
		*
		*/

		$this->start_controls_section(
		    'mim_testimonial_section_background',
		    [
		        'label' => esc_html__('Section Styles', 'mim-plugin'),
		        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_background_before',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Section Background', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
		    'mim_hero_section_background_color',
		    [
		        'label' => esc_html__('Color', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .testimonial-area' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_spacing_before',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Section Spacing', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'mim_hero_section_setting_padding',
		    [
		        'label' => esc_html__('Section Padding', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_hero_section_title_before',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Section Title', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
		    'mim_hero_section_title_color',
		    [
		        'label' => esc_html__('Color', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'mim_hero_section_title_margin',
		    [
		        'label' => esc_html__('Margin', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		// Border Top Styles

		$this->start_controls_section(
		    'mim_testimonial_section_seprator_section',
		    [
		        'label' => esc_html__('Separator', 'mim-plugin'),
		        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_below_border',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Border Top', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_top_color',
		    [
		        'label' => esc_html__('Color', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_top_height',
		    [
		        'label' => esc_html__( 'Height', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 2,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_top_width',
		    [
		        'label' => esc_html__( 'Width', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 44,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_top_margin',
		    [
		        'label' => esc_html__( 'Margin Top', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 0,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'margin-top: {{SIZE}}px;',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_top_bottom_margin',
		    [
		        'label' => esc_html__( 'Margin Bottom', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 3,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'margin-bottom: {{SIZE}}px;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'mim_testimonial_section_title_border_top_border_radius',
		    [
		        'label' => esc_html__('Border Radius', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);


		$this->add_control(
		    'mim_testimonial_section_title_below_down_border',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Border Bottom', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_bottom_color',
		    [
		        'label' => esc_html__('Color', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_bottom_height',
		    [
		        'label' => esc_html__( 'Height', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 2,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_bottom_width',
		    [
		        'label' => esc_html__( 'Width', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 1000,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 77,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_bottom_margin',
		    [
		        'label' => esc_html__( 'Margin Top', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 0,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'margin-top: {{SIZE}}px;',
		        ],
		    ]
		);

		$this->add_control(
		    'mim_testimonial_section_title_border_bottom_bottom_margin',
		    [
		        'label' => esc_html__( 'Margin Bottom', 'mim-plugin' ),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 3,
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'margin-bottom: {{SIZE}}px;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'mim_testimonial_section_title_border_bottom_border_radius',
		    [
		        'label' => esc_html__('Border Radius', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .horizontal-line div.bottom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->end_controls_section();


		// Image.
		$this->start_controls_section(
			'section_style_testimonial_items',
			[
				'label' => __('Testimonial items', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label' => esc_html__('Background Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .single-slide' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'Box_border',
				'selector' => '{{WRAPPER}} .testimonial-area .single-slide',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __('Box Border Radius', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .single-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Image.
		$this->start_controls_section(
			'section_style_testimonial_image',
			[
				'label' => __('Image', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __('Image Size', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .slide-text img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .testimonial-area .slide-text img',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __('Border Radius', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .slide-text img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_testimonial_name',
			[
				'label' => esc_html__('Name', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'section_style_testimonial_margin',
		    [
		        'label' => esc_html__('Margin', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .slide-text .content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'section_style_testimonial_color',
			[
				'label' => esc_html__('Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-text .content h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_testimonial_typography',
				'selector' => '{{WRAPPER}} .slide-text .content h4',
			]
		);

		$this->end_controls_section();

		

		$this->start_controls_section(
			'section_style_testimonial_job_section',
			[
				'label' => esc_html__('Designation', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'section_style_testimonial_job_section_margin',
		    [
		        'label' => esc_html__('Margin', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .testimonial-area .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'section_style_testimonial_job_color',
			[
				'label' => esc_html__('Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .content p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_testimonial_job_typography',
				'selector' => '{{WRAPPER}} .testimonial-area .content p',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_description_section',
			[
				'label' => esc_html__('Description', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'section_style_testimonial_description_section_margin',
		    [
		        'label' => esc_html__('Margin', 'mim-plugin'),
		        'type' => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .slide-text .content h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'section_style_testimonial_description_color',
			[
				'label' => esc_html__('Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide-text .content h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_testimonial_description_typography',
				'selector' => '{{WRAPPER}} .slide-text .content h6',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_dot_styles',
			[
				'label' => esc_html__('Dot Style', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'section_style_testimonial_dot_styles_active_before',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Normal Color', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
			'section_style_testimonial_dot_styles_color',
			[
				'label' => esc_html__('Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .owl-theme .owl-dot span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		    'section_style_testimonial_dot_styles_normal_before',
		    [
		        'type' => \Elementor\Controls_Manager::HEADING,
		        'label' => esc_html__('Active Color', 'mim-plugin'),
		        'separator' => 'before'
		    ]
		);

		$this->add_control(
			'section_style_testimonial_dot_styles_active_color',
			[
				'label' => esc_html__('Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-area .owl-theme .owl-dot.active span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_testimonial_nav_styles',
			[
				'label' => esc_html__('Nav Style', 'mim-plugin'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'testimonial_nav_styles_normal',
			[
				'label' => esc_html__('Normal Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-prev' => 'color: {{VALUE}};',
					'{{WRAPPER}} .owl-next' => 'color: {{VALUE}};'
				],
			]
		);



		$this->add_control(
			'testimonial_nav_styles_hover',
			[
				'label' => esc_html__('Hover Color', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-prev:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .owl-next:hover' => 'color: {{VALUE}};'
				],
			]
		);


		$this->add_responsive_control(
			'testimonial_carousel_icon_size',
			[
				'label' => __('Icon Size', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 50,
		        ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area button.owl-prev i, {{WRAPPER}} .testimonial-area button.owl-next i' => 'font-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_carousel_icon_margin-top',
			[
				'label' => __('Top Space', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 300,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => '%',
		            'size' => 56,
		        ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area button.owl-prev, {{WRAPPER}} .testimonial-area button.owl-next' => 'top: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_carousel_icon_margin_both_side',
			[
				'label' => __('Position', 'mim-plugin'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px','%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
		                'step' => 1,
		            ],
					'px' => [
						'min' => 0,
						'max' => 500,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'px',
		            'size' => 0,
		        ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-area button.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-area button.owl-next' => 'right: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->end_controls_section();

		
		
	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$section_id = $this->get_settings('testimonial_section_id');
		$section_title = $this->get_settings('testimonial_section_title');

		$testimonial_items = $this->get_settings('testimonial_items');


		$mim_products_margin = $this->get_settings('mim_products_margin');
		$mim_slide_direction = 'horizontal';


		$widget_id = $this->get_id();

		$mim_products_margin = (isset($mim_products_margin['size'])) ? $mim_products_margin['size'] : '0';



		$themefunctions = new ThemeFunctions();


		if ($themefunctions->Version_Switcher() == 'dark') {
		    $class_version = 'dark-version dark-bg';
		    $class_two = 'white-color';
		} else {
		    $class_version = 'light-bg';
		    $class_two = '';
		}
		?>

		<!-- Testimonial Section Start -->
		<section class="testimonial-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($section_id); ?>" data-widgetid="<?php echo esc_attr($widget_id); ?>" data-loop="<?php echo esc_attr($settings['mim_loop']); ?>" data-number="<?php echo esc_attr($settings['mim_products_number']); ?>" data-margin="<?php echo esc_attr($mim_products_margin); ?>" data-direction="<?php echo esc_attr($mim_slide_direction); ?>" data-autoplay="<?php echo esc_attr($settings['mim_autoplay']); ?>" data-auto-delay="<?php echo esc_attr($settings['mim_autoplay_delay']); ?>" data-speed="<?php echo esc_attr($settings['mim_autoplay_speed']); ?>" data-autoplay_hover_pause="<?php echo esc_attr($settings['mim_autoplay_hover_pause']); ?>" data-nav="<?php echo esc_attr($settings['mim_navigation']); ?>" data-dots="<?php echo esc_attr($settings['mim_dots']); ?>">
		    <div class="container">
		        <?php if ($section_title) : ?>
		            <div class="row">
		                <div class="col-sm-12">
		                    <div class="section-title text-center mb-60">
		                        <h2 class="mb-20 <?php echo esc_attr($class_two); ?>"><?php echo wp_kses_post($section_title); ?></h2>
		                        <div class="horizontal-line">
		                            <div class="top"></div>
		                            <div class="bottom"></div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        <?php endif; ?>

		        <div class="row text-center animate move-fadeInUp">
		            <div class="col-sm-12 col-md-10 col-lg-8 col-text-center">
		                <?php if ($testimonial_items) : ?>
		                    <div class="one-item owl-carousel owl-theme" id="olw-active-<?php echo esc_attr($widget_id); ?>">
		                        <?php foreach ($testimonial_items as $item) { ?>
		                            <div class="item">
		                                <div class="single-slide">
		                                    <div class="slide-text pb-30 plr-10">
		                                        <div class="img mb-20">
		                                            <?php if ($item['testimonial_item_image'] ) : ?>
		                                                <?php 
		                                                	$attachment_id = $item['testimonial_item_image']['id']; 
		                                                	if ( isset($attachment_id) ) {
		                                                ?>
		                                                <img src="<?php echo esc_url($themefunctions->Settings_Image($attachment_id, 98, 98)); ?>" alt="<?php echo wp_kses_post($item['testimonial_item_name']); ?>" />
		                                            <?php } endif; ?>
		                                        </div>
		                                        <div class="content">
		                                            <?php if ($item['testimonial_item_name']) : ?>
		                                                <h4 class="montserrat weight-bold"><?php echo wp_kses_post($item['testimonial_item_name']); ?></h4>
		                                            <?php
		                                            endif;
		                                            if ($item['testimonial_item_user_position']) :
		                                            ?>
		                                                <h6 class="montserrat weight-bold mb-10"><?php echo wp_kses_post($item['testimonial_item_user_position']); ?></h6>
		                                            <?php
		                                            endif;
		                                            if ($item['testimonial_item_description']) :
		                                            ?>
		                                                <p class="line-height-28">
		                                                    <?php
		                                                    echo wp_kses_post($item['testimonial_item_description']);
		                                                    ?>
		                                                </p>
		                                            <?php endif; ?>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div><!-- /.item -->
		                        <?php } ?>

		                    </div>

		                    <?php if ($settings['mim_navigation']) : ?>
		                    	<div class="navigation-owl-<?php echo esc_attr($widget_id); ?>"></div>
		                    <?php endif; ?>

		                <?php
		            		endif; 
		            		/*if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) :

		            			$dots = ( $settings['mim_dots'] == 'yes' ) ? 'true' : 'false' ;
		            			$loops = ( $settings['mim_loop'] == 'yes' ) ? 'true' : 'false' ;
		            			$mim_autoplay = ( $settings['mim_autoplay'] == 'yes' ) ? 'true' : 'false' ;
		            			$navigation = ( $settings['mim_navigation'] == 'yes' ) ? 'true' : 'false' ;
		            			$autoplay_hover_pause = ( $settings['mim_autoplay_hover_pause'] == 'yes' ) ? 'true' : 'false' ;
		            			?>
		            				<script>
		            					jQuery('#olw-active-<?php echo esc_attr($widget_id); ?>').owlCarousel({
	            					        loop: <?php echo esc_attr($loops); ?>,
	            					        items: <?php echo esc_attr($settings['mim_products_number']); ?>,
	            					        dots: <?php echo esc_attr($dots); ?>,
	            					        autoplay: <?php echo esc_attr($mim_autoplay); ?>,
	            					        autoplayTimeout: <?php echo esc_attr($settings['mim_autoplay_delay']); ?>,
	            					        autoplaySpeed: <?php echo esc_attr($settings['mim_autoplay_speed']); ?>,
	            					        <?php if($settings['mim_products_margin']): ?>
	            					        margin: <?php echo esc_attr($settings['mim_products_margin']); ?>,
	            					    	<?php endif; ?>
	            					        autoplayHoverPause: <?php echo esc_attr($autoplay_hover_pause); ?>,
	            					        nav: <?php echo esc_attr($navigation); ?>,
	            					        <?php if ($settings['mim_navigation']) : ?>
	            					        navText: ['<?php \Elementor\Icons_Manager::render_icon($settings['mim_nav_prev_icon']); ?>', '<?php \Elementor\Icons_Manager::render_icon($settings['mim_nav_next_icon']); ?>'],
	            					        navContainer: '.navigation-owl-<?php echo esc_attr($widget_id); ?>',
		                    				<?php endif; ?>
	            					    });
		            				</script>
		            			<?php
                            endif;*/
		                ?>
		            </div>
		        </div>
		    </div>
		</section>
		<!-- Testimonial Section End -->
		<?php
	}
}