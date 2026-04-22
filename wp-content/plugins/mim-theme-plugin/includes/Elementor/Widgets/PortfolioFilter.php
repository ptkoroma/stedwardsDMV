<?php


namespace MimTheme\Plugin\Elementor\Widgets;
use \Elementor;
use MimTheme\Plugin\Admin\Mim_Functions;
use MimTheme\Frontend\ThemeFunctions;

class PortfolioFilter extends \Elementor\Widget_Base
{


    /**
     * Get widget name.
     *
     * Retrieve Blank widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'mimportfoliofilter';
    }

    /**
     * Get widget title.
     *
     * Retrieve Blank widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Mim Portfolio Filter', 'mim-plugin');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Blank widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-filter';
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

    public function get_keywords()
    {
        return ['works', 'portfolio', 'display', 'info'];
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
            'filter-active-js',
        ];
    }


    /**
     * Register Blank widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->register_content_controls();
        $this->register_style_controls();
    }


    /**
     * Register Blank widget content ontrols.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    function register_content_controls()
    {

        $Mim_Functions = new Mim_Functions();

        if ( post_type_exists( 'portfolio' ) ) {
           $all_categories = get_terms( 'portfolio', array('hide_empty' => true));
           $cat_array = array();
           foreach ( $all_categories as $cat) {
               $cat_array[$cat->term_id] = $cat->name;
           }
        } else {
            $cat_array = array();
        }


        $this->start_controls_section(
            'mim_portfolio_section',
            [
                'label' => esc_html__('Mim Portfolio', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'portfolio_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('portfolio', 'mim-plugin'),
                'default'     => esc_html__('portfolio', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'portfolio_section_title',
            [
                'label' => esc_html__('Portfolio Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('My Portfolio', 'mim-plugin'),
                'default'     => esc_html__('My Portfolio', 'mim-plugin'),
            ]
        );
        
        $this->end_controls_section();



        $this->start_controls_section(
            'cats_section',
            [
                'label' => esc_html__('Portfolio Category', 'mim-plugin'),
            ]
        );
        $this->add_control(
            'selected_portfolios',
            [
                'label' => esc_html__( 'Select Portfolio Category', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $cat_array,
                'default' => [ 'title', 'description' ],
            ]
        );


        

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_options_section',
            [
                'label' => esc_html__('Filter Menu Style', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mim_first_menutext',
            [
                'label'       => __('First Menu Text', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => __('All', 'mim-plugin'),
                'default'     => __('All', 'mim-plugin'),
            ]
        );

        $this->add_responsive_control(
            'mim_nav_align',
            [
                'label' => esc_html__('Nav Alignment', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'mim-plugin'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'mim-plugin'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'mim-plugin'),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'default' => 'center',

                'selectors' => [
                    '{{WRAPPER}} .all-portfolio' => 'justify-content: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'mim_nav_strike_through',
            [
                'label'       => __('Text Strike Through Effect', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'default'     => 'yes'
            ]
        );

        $this->end_controls_section();

        // posts Content
        $this->start_controls_section(
            'mim_img_video',
            [
                'label' => esc_html__('Content Settings', 'mim-plugin'),
            ]
        );
        $this->add_control(
            'mim_show_title',
            [
                'label'     => __('Show Portfolio Title', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mim_type_show',
            [
                'label'     => __('Show Portfolio Type', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes'

            ]
        );
        $this->end_controls_section();
    }

    /**
     * Register Blank widget style ontrols.
     *
     * Adds different input fields in the style tab to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_style_controls()
    {

        $this->start_controls_section(
            'mim_portfolio_section_background',
            [
                'label' => esc_html__('Section Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_portfolio_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );


        $this->add_control(
            'mim_portfolio_section_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_portfolio_section_spacing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Spacing', 'mim-plugin'), 
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_portfolio_section_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'), 
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_portfolio_section_title_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'mim_portfolio_section_title_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_portfolio_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );


        $this->end_controls_section();

        // Border Top Styles

        $this->start_controls_section(
            'mim_portfolio_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_border_top_height',
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
            'mim_portfolio_section_title_border_top_width',
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
            'mim_portfolio_section_title_border_top_margin',
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
            'mim_portfolio_section_title_border_top_bottom_margin',
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
            'mim_portfolio_section_title_border_top_border_radius',
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
            'mim_portfolio_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_portfolio_section_title_border_bottom_height',
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
            'mim_portfolio_section_title_border_bottom_width',
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
            'mim_portfolio_section_title_border_bottom_margin',
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
            'mim_portfolio_section_title_border_bottom_bottom_margin',
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
            'mim_portfolio_section_title_border_bottom_border_radius',
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

        $this->start_controls_section(
            'mim_navwrapper_section',
            [
                'label' => esc_html__('Nav Wrapper', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mim_nav_wrapper_bg',
                'label' => esc_html__('Background', 'mim-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .portfolio-menu ul',
            ]
        );
        $this->add_responsive_control(
            'mim_nav_wrapper_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mim_nav_wrapper_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_nav_wrapper_border',
                'selector' => '{{WRAPPER}} .portfolio-menu ul',
            ]
        );

        $this->add_responsive_control(
            'mim_navwrapper_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_navwrapper_box_shadow',
                'label' => esc_html__('Box Shadow', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .portfolio-menu ul',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'mim_navitems_style',
            [
                'label'     => esc_html__('Nav Items', 'mim-plugin'),
                'tab'     => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'         => 'mim_tabitems_typography',
                'selector'     => '{{WRAPPER}} .portfolio-menu ul.clearfix li',
            ]
        );
        $this->add_responsive_control(
            'mim_tabitems_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mim_tabitems_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'mim_navitems_style_tabs'
        );
        $this->start_controls_tab(
            'mim_nav_items_normal_tab',
            [
                'label' => esc_html__('Normal', 'mim-plugin'),
            ]
        );
        $this->add_control(
            'mim_nav_items_normal_textcolor',
            [
                'label'         => esc_html__('Text Color', 'mim-plugin'),
                'type'         => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mim_nav_items_normal_bg',
                'label' => esc_html__('Background', 'mim-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .portfolio-menu ul.clearfix li',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_nav_items_normal_border',
                'label' => esc_html__('Border', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .portfolio-menu ul.clearfix li',
            ]
        );

        $this->add_control(
            'mim_nav_items_normal_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_nav_items_normal_bshadow',
                'label' => esc_html__('Box Shadow', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .portfolio-menu ul.clearfix li',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_navitems_style_active_tab',
            [
                'label' => esc_html__('Active', 'mim-plugin'),
            ]
        );
        $this->add_control(
            'mim_nav_items_active_textcolor',
            [
                'label'         => esc_html__('Text Color', 'mim-plugin'),
                'type'         => \Elementor\Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li.active,{{WRAPPER}} .portfolio-menu ul.clearfix li:hover' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mim_nav_items_active_bg',
                'label' => esc_html__('Background', 'mim-plugin'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .portfolio-menu ul.clearfix li.active,{{WRAPPER}} .portfolio-menu ul.clearfix li:hover',
            ]
        );
        /*
        $this->add_control(
            'mim_nav_items_active_arrowcolor', [
                'label'		 =>esc_html__( 'Extra Arrow Color', 'mim-plugin' ),
                'type'		 => \Elementor\Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .mpdtabs-style2 .nav-tabs li a.active, {{WRAPPER}} .mpdtabs-style2 .nav-tabs li a.active:hover' => 'border-top-color: {{VALUE}};',
                    '{{WRAPPER}}  .mpdtabs-style1 .nav-tabs li a:after' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}}  .mpdtabs-style3 .nav-tabs li a.active:after' => 'border-top-color: {{VALUE}};',
                ],
                
                
            ]
        );
        */
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_nav_items_active_border',
                'label' => esc_html__('Border', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .portfolio-menu ul.clearfix li.active,{{WRAPPER}} .portfolio-menu ul.clearfix li:hover',
            ]
        );

        $this->add_control(
            'mim_nav_items_active_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-menu ul.clearfix li.active,{{WRAPPER}} .portfolio-menu ul.clearfix li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_nav_items_active_bshadow',
                'label' => esc_html__('Box Shadow', 'mim-plugin'),
                'selector' => '{{WRAPPER}} {{WRAPPER}} .portfolio-menu ul.clearfix li.active,{{WRAPPER}} .portfolio-menu ul.clearfix li:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        //Tab body style
       

        $this->start_controls_section(
            'mim_layout_style',
            [
                'label' => __('Portfolio Item Style', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

       

        $this->add_control(
            'mim_border_radius',
            [
                'label' => __('Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-grid .grid-item .single-portfolio-shortcode' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_content_border',
                'selector' => '{{WRAPPER}} .portfolio-grid .grid-item .single-portfolio-shortcode',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_content_shadow',
                'selector' => '{{WRAPPER}} .portfolio-grid .grid-item .single-portfolio-shortcode',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_title_style',
            [
                'label' => __('posts Title', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_title_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title h4,{{WRAPPER}} .project-title h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mim_title_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title h4,{{WRAPPER}} .project-title h4 a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mim_title_color',
            [
                'label' => __('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-title h4 a,{{WRAPPER}} .project-title h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mim_title_bgcolor',
            [
                'label' => __('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-title h4,{{WRAPPER}} .project-title h4 a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mim_descb_radius',
            [
                'label' => __('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title h4,{{WRAPPER}} .project-title h4 a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_title_typography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .project-title h4,{{WRAPPER}} .project-title h4 a',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_description_style',
            [
                'label' => __('Type / Category', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_description_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mim_description_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mim_description_color',
            [
                'label' => __('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-title p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mim_description_bgcolor',
            [
                'label' => __('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-title p' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mim_description_radius',
            [
                'label' => __('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-title p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_description_typography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .project-title p',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'mim_icon_style',
            [
                'label' => __('Icon style', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'mim_icon_color',
            [
                'label' => __('Icon Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-portfolio-shortcode .zoom-icon i' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'mim_icon_typography',
            [
                'label' => __('Icon Size', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .single-portfolio-shortcode .zoom-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'mim_icon_background_color',
            [
                'label' => __('Icon background color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-portfolio-shortcode .zoom-icon i' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mim_icon_background_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-portfolio-shortcode .zoom-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Blank widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $themefunctions = new ThemeFunctions();
        $settings = $this->get_settings_for_display();
        $mim_pitems = $this->get_settings('mim_pitems');
        $portfolio_section_id = $this->get_settings('portfolio_section_id');
        $portfolio_section_title = $this->get_settings('portfolio_section_title');
        $selected_portfolios = $this->get_settings('selected_portfolios');
        $first_menutext = $this->get_settings('mim_first_menutext');
        $nav_strike_through = $this->get_settings('mim_nav_strike_through');
        $nav_strike_through_class = ($nav_strike_through == 'yes') ? '' : 'no-strike-through' ;
        $show_title = $this->get_settings('mim_show_title');
        $type_show = $this->get_settings('mim_type_show');
        $rand_num = rand('12548729', '985674879');
        $widget_id = $this->get_id();
        if ($themefunctions->Version_Switcher() == 'dark') {
            $class_version = 'dark-version bg-color-3';
            $class_two = 'white-color';
        } else {
            $class_version = 'light-bg';
            $class_two = '';
        }

        ?>

        <script>
            //jQuery(window).on('load', function() {

                /*var ProjGrid = jQuery('.portfolio-grid');
                ProjGrid.isotope({
                    itemSelector: '.grid-item',
                    masonryHorizontal: {
                        rowHeight: 500
                    }
                });*/
            //});
        </script>

        <section class="portfolio-area portfolio-one <?php echo esc_attr($class_version); ?> section-padding clearfix" id="<?php echo esc_attr($portfolio_section_id); ?>">
            <div class="container">
                <?php if ($portfolio_section_title) : ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title text-center mb-30">
                                <h2 class="mb-20 <?php echo esc_attr($class_two); ?>"><?php echo wp_kses_post($portfolio_section_title); ?></h2>
                                <div class="horizontal-line">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php if (post_type_exists('portfolio')) : ?>
                    <div class="col-sm-12">
                        <div class="all-portfolio">
                            <div class="portfolio-menu text-center">
                                <ul class="clearfix mb-50 <?php echo esc_attr($nav_strike_through_class); ?>">
                                    <li class="filter-item active" data-filter="*"><?php echo esc_html($first_menutext); ?></li>
                                    <?php
                                    if (!empty($selected_portfolios)):
                                        foreach ($selected_portfolios as $value) {
                                            $term_d = get_term_by('id', $value, 'portfolio');
                                            if ($term_d) {
                                                ?>
                                                    <li class="filter-item" data-filter=".<?php echo esc_attr($term_d->slug); ?>"><?php echo wp_kses_post($term_d->name); ?></li>
                                                <?php
                                            } 
                                        } 
                                     endif;
                                 ?>
                                </ul>
                            </div>
                        </div>



                        <div class="portfolio-grid portfolio-active-<?php echo esc_attr($widget_id); ?>">
                            <?php
                            $query_args = array(
                                'post_type' => 'portfolio',
                                'posts_per_page' => 500,
                                'ignore_sticky_posts' => false,
                                'order' => 'DESC',
                                'post_status' => 'publish',
                                'tax_query' => array(
                                    'relation' => 'AND',
                                    array(
                                        'taxonomy' => 'portfolio',
                                        'field' => 'id',
                                        'terms' => $selected_portfolios,
                                        'operator' => 'IN'
                                    ),
                                ),
                            );

                            $loop = new \WP_Query($query_args);
                            $i = 1;
                            while ($loop->have_posts()) : $loop->the_post();
                                $terms = get_the_terms(get_the_ID(), 'portfolio');

                                $portfolio_thumb = get_post_meta(get_the_ID(), 'portfolio_thumb');
                                $custom_size_height = get_post_meta(get_the_ID(), 'custom_size_height');
                                $custom_size_width = get_post_meta(get_the_ID(), 'custom_size_width');

                                $portfolio_type_main_sec = get_post_meta(get_the_ID(), 'portfolio_type_main_sec');
                                $type = ($portfolio_type_main_sec) ? $portfolio_type_main_sec[0]['portfolio_type_main'] : 'image';
                                $image_view = get_post_meta(get_the_ID(),'portfolio_image_view', true);

                                $link_type = ($image_view) ? $image_view : 'light-box' ;

                                ?>
                                <div class="grid-item <?php foreach ($terms as $term) { echo esc_attr($term->slug) . ' '; } ?>percent-33">
                                    <?php
                                        if ($type == 'link') {
                                            $link_url = ($portfolio_type_main_sec) ? $portfolio_type_main_sec[0]['link']['portfolio_link_url'] : '';
                                            ?>
                                                <div class="single-portfolio-shortcode overlay light-1 text-center">
                                                    <?php
                                                    if (has_post_thumbnail()) :
                                                        if ($portfolio_thumb) {
                                                            if ($portfolio_thumb == 'small') {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            }
                                                        } elseif ($portfolio_thumb == 'big') {
                                                            if ($i == 2 || $i == 5) {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            }
                                                        } else {
                                                            $width = ($custom_size_width) ? $custom_size_width : 478;
                                                            $height = ($custom_size_height) ? $custom_size_height : 368;

                                                            echo mim_theme_get_featured_img($height, $width, false, "true");
                                                        }
                                                    endif;

                                                    if (has_post_thumbnail()) {
                                                        $meta_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
                                                        $meta_image_url = $meta_image_url[0];
                                                    ?>
                                                        <div class="zoom-icon">
                                                            <?php if ($link_type == 'light-box') { ?>
                                                                <a class="various" target="_blank" title="<?php the_title(); ?>" href="<?php echo esc_url($link_url); ?>">
                                                                    <i class="fa fa-link"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <i class="fa fa-link"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="project-title text-left">
                                                        <?php if ($link_type == 'light-box' && $show_title == 'yes') { ?>
                                                            <h4 class="font-20 montserrat weight-regular capitalize no-margin">
                                                                <?php the_title(); ?>
                                                            </h4>
                                                        <?php } else { ?>
                                                            <?php if($show_title == 'yes'){ ?>
                                                            <h4 class="font-20 montserrat weight-regular capitalize no-margin">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h4>
                                                        <?php } } ?>

                                                        <?php
                                                        $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type');
                                                        $portfolio_type = $portfolio_type[0];
                                                        if ($portfolio_type && $type_show == 'yes') :
                                                        ?>
                                                            <p class="montserratlight"><?php echo wp_kses_post($portfolio_type); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            
                                            <?php
                                        } elseif ($type == 'video') {
                                            $video_url = ($portfolio_type_main_sec) ? $portfolio_type_main_sec[0]['video']['portfolio_video_url'] : '';
                                            ?>
                                                <div class="single-portfolio-shortcode overlay light-1 text-center">
                                                    <?php
                                                    if (has_post_thumbnail()) :
                                                        if ($portfolio_thumb) {
                                                            if ($portfolio_thumb == 'small') {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            }
                                                        } elseif ($portfolio_thumb == 'big') {
                                                            if ($i == 2 || $i == 5) {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            }
                                                        } else {
                                                            $width = ($custom_size_width) ? $custom_size_width : 478;
                                                            $height = ($custom_size_height) ? $custom_size_height : 368;

                                                            echo mim_theme_get_featured_img($height, $width, false, "true");
                                                        }
                                                    endif;

                                                    if (has_post_thumbnail()) {
                                                        $meta_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
                                                        $meta_image_url = $meta_image_url[0];
                                                    ?>
                                                        <div class="zoom-icon">
                                                            <?php if ($link_type == 'light-box') { ?>
                                                                <a class="various fancybox" data-fancybox-type="iframe" title="<?php the_title(); ?>" href="<?php echo esc_url($video_url); ?>?&autoplay=1">
                                                                    <i class="zmdi zmdi-play"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <i class="zmdi zmdi-play"></i>
                                                                    </a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="project-title text-left">

                                                        <?php if ($link_type == 'light-box' && $show_title == 'yes') { ?>
                                                            <h4 class="font-20 montserrat weight-regular capitalize no-margin">
                                                                <?php the_title(); ?>
                                                            </h4>
                                                        <?php } else { ?>
                                                            <?php if($show_title == 'yes'){ ?>
                                                                <h4 class="font-20 montserrat weight-regular capitalize no-margin">
                                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                                </h4>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php
                                                        $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type');
                                                        $portfolio_type = $portfolio_type[0];
                                                        if ($portfolio_type && $type_show == 'yes') :
                                                        ?>
                                                            <p class="montserratlight"><?php echo wp_kses_post($portfolio_type); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            
                                            <?php
                                        } else {
                                            ?>
                                                <div class="single-portfolio-shortcode overlay light-1 text-center">
                                                    <?php
                                                    if (has_post_thumbnail()) :
                                                        if ($portfolio_thumb) {
                                                            if ($portfolio_thumb == 'small') {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            }
                                                        } elseif ($portfolio_thumb == 'big') {
                                                            if ($i == 2 || $i == 5) {
                                                                echo mim_theme_get_featured_img(368, 478, false, "true");
                                                            } else {
                                                                echo mim_theme_get_featured_img(368, 229, false, "true");
                                                            }
                                                        } else {
                                                            $width = ($custom_size_width) ? $custom_size_width : 478;
                                                            $height = ($custom_size_height) ? $custom_size_height : 368;

                                                            echo mim_theme_get_featured_img($height, $width, false, "true");
                                                        }
                                                    endif;

                                                    if (has_post_thumbnail()) {
                                                        $meta_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
                                                        $meta_image_url = $meta_image_url[0];
                                                    ?>
                                                        <div class="zoom-icon">
                                                            <?php if ($link_type == 'light-box') { ?>
                                                                <a rel="light-box" href="<?php echo esc_url($meta_image_url); ?>" class="fancybox">
                                                                    <i class="zmdi zmdi-filter-center-focus"></i>
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <i class="fa fa-link"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="project-title text-left">

                                                        <?php if ($link_type == 'light-box' && $show_title == 'yes') { ?>
                                                            <h4 class="font-20 montserrat weight-regular capitalize no-margin">
                                                                <?php the_title(); ?>
                                                            </h4>
                                                        <?php } else { ?>
                                                            <?php if($show_title == 'yes'){ ?>
                                                                <h4 class="font-20 montserrat weight-regular capitalize no-margin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php
                                                        $portfolio_type = get_post_meta(get_the_ID(), 'portfolio_type');
                                                        $portfolio_type = $portfolio_type[0];
                                                        if ($portfolio_type && $type_show == 'yes') :
                                                        ?>
                                                            <p class="montserratlight"><?php echo wp_kses_post($portfolio_type); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>
                                <?php
                                $i++;
                            endwhile;
                            wp_reset_postdata();?>
                        </div>
                    </div>
                    <?php 
                        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) :
                            ?>
                            <script>
                                var ProjMli = jQuery('.portfolio-menu li');
                                var ProjGrid = jQuery('.portfolio-grid');
                                ProjMli.on('click', function() {
                                    ProjMli.removeClass("active");
                                    jQuery(this).addClass("active");
                                    var selector = jQuery(this).attr('data-filter');
                                    ProjGrid.isotope({
                                        filter: selector,
                                        animationOptions: {
                                            duration: 750,
                                            easing: 'linear',
                                            queue: false,
                                        }
                                    });
                                });


                                jQuery(window).on('load', function() {

                                    var ProjGrid = jQuery('.portfolio-grid');
                                    ProjGrid.isotope({
                                        itemSelector: '.grid-item',
                                        masonryHorizontal: {
                                            rowHeight: 100
                                        }
                                    });
                                });

                                
                            </script>

                            <?php
                        endif;
                    ?>
                <?php else : // selected categoery check 
                ?>
                    <div class="mpd-no-cat text-center mb-5 mt-5">
                        <h2 class="text-danger"><?php esc_html_e('Please select minimum one item for display filter gallery', 'mim-plugin') ?> </h2>
                        <?php edit_post_link(); ?>
                    </div>
                <?php endif; // selected categoery check 
                ?>
            </div>
            </div>
        </section>
        <?php
    }
}