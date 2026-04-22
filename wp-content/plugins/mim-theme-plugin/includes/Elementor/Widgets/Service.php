<?php
namespace MimTheme\Plugin\Elementor\Widgets;
use MimTheme\Frontend\ThemeFunctions;

class Service extends \Elementor\Widget_Base
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
        return 'mimservice';
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
        return esc_html__('Mim Service', 'mim-plugin');
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
        return 'eicon-checkbox';
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
        return ['service', 'list', 'skills', 'details', 'mim-plugin'];
    }

    public function is_reload_preview_required()
    {
        return true;
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
        $this->start_controls_section(
            'mim_service_section',
            [
                'label' => esc_html__('Mim Service', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'service_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('service', 'mim-plugin'),
                'default'     => esc_html__('service', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'service_section_title',
            [
                'label' => esc_html__('Service Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('My Services', 'mim-plugin'),
                'default'     => esc_html__('My Services', 'mim-plugin'),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_service_section_list',
            [
                'label' => esc_html__('Service Lists', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'service_icon',
            [
                'label' => esc_html__( 'Service Icon', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'service_title', [
                'label' => esc_html__( 'Service Title', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Behance' , 'mim-plugin' ),
                'label_block' => true,
            ]
        );      


        $repeater->add_control(
            'service_description', [
                'label' => esc_html__( 'Service Description', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.' , 'mim-plugin' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'service_details_list',
            [
                'label' => esc_html__( 'My Services', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_icon' => [
                            'value' => 'fas fa-laptop',
                            'library' => 'fa-solid',
                        ],
                        'service_title' => esc_html__( 'UI/UX DESIGN', 'mim-plugin' ),
                        'service_description' => esc_html__( 'There are many variatio ns of pssages of Lorm available, bu in some form', 'mim-plugin' ),
                    ],
                    [
                        'service_icon' => [
                            'value' => 'far fa-heart',
                            'library' => 'fa-solid',
                        ],
                        'service_title' => esc_html__( 'WEB DESIGN', 'mim-plugin' ),
                        'service_description' => esc_html__( 'There are many variatio ns of pssages of Lorm available, bu in some form', 'mim-plugin' ),
                    ],
                    [
                        'service_icon' => [
                            'value' => 'fas fa-vector-square',
                            'library' => 'fa-solid',
                        ],
                        'service_title' => esc_html__( 'MINIMAL DESIGN', 'mim-plugin' ),
                        'service_description' => esc_html__( 'There are many variatio ns of pssages of Lorm available, bu in some form', 'mim-plugin' ),
                    ],
                    [
                        'service_icon' => [
                            'value' => 'fab fa-html5',
                            'library' => 'fa-solid',
                        ],
                        'service_title' => esc_html__( 'DEVELOPMENT', 'mim-plugin' ),
                        'service_description' => esc_html__( 'There are many variatio ns of pssages of Lorm available, bu in some form', 'mim-plugin' ),
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );  
        $this->end_controls_section();
       
    }

    /**
     * Register Accordion widget style ontrols.
     *
     * Adds different input fields in the style tab to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_style_controls()
    {


        $this->start_controls_section(
            'mim_services_section_style',
            [
                'label' => esc_html__('Section Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_service_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_service_section_background_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_service_section_spacing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Spacing', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_service_section_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .service-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'mim_services_section_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_services_section_title_margin',
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
            'mim_services_section_title_color',
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
                'name' => 'mim_services_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );
        
        $this->end_controls_section();


        // Border Top Styles

        $this->start_controls_section(
            'mim_service_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_service_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_service_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_service_section_title_border_top_height',
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
            'mim_service_section_title_border_top_width',
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
            'mim_service_section_title_border_top_margin',
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
            'mim_service_section_title_border_top_bottom_margin',
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
            'mim_service_section_title_border_top_border_radius',
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
            'mim_service_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_service_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_service_section_title_border_bottom_height',
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
            'mim_service_section_title_border_bottom_width',
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
            'mim_service_section_title_border_bottom_margin',
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
            'mim_service_section_title_border_bottom_bottom_margin',
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
            'mim_service_section_title_border_bottom_border_radius',
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
            'mim_services_section_item_general_style',
            [
                'label' => esc_html__('Item Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_services_section_item_general_style_bofore',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Single Item', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_services_section_item_general_item_background',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service' => 'background-color: {{VALUE}}; border: 1px solid {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mim_services_section_item_general_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .single-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_services_section_icon_style',
            [
                'label' => esc_html__('Icon Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );   
        
        $this->add_control(
            'mim_services_section_icon_size_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon Size', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_services_section_icon_font_size',
            [
                'label' => esc_html__( 'Size', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .single-service i' => 'font-size: {{VALUE}}px;',
                ],
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 20,
            ]
        );   
        
        $this->add_control(
            'mim_services_section_icon_height_width_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon Padding', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_services_section_icon_height_width_size',
            [
                'label' => esc_html__( 'Size', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .single-service i' => 'width: {{VALUE}}px;height: {{VALUE}}px;line-height: {{VALUE}}px;',
                ],
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 36,
            ]
        );    
        
        $this->add_control(
            'mim_services_section_icon_line_height_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon Line Height', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_services_section_icon_line_height_size',
            [
                'label' => esc_html__( 'Size', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .single-service i' => 'line-height: {{VALUE}}px;',
                ],
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 36,
            ]
        );  
        
        $this->add_control(
            'mim_services_section_icon_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon Colors', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs('mim_services_section_icon_tabs');

        $this->start_controls_tab(
            'mim_services_section_icon_tab_normal',
            [
                'label' => esc_html__('Normal', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_services_section_icon_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-service i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_services_section_icon_border',
                'label' => esc_html__( 'Border', 'mim-plugin' ),
                'selector' => '{{WRAPPER}} .single-service i',
            ]
        );

        $this->add_control(
            'mim_services_section_icon_background_color',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service i' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_services_section_icon_hover_styles',
            [
                'label' => esc_html__('Hover', 'mim-plugin'),
            ]
        );


        $this->add_control(
            'mim_services_section_icon_hover_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_services_section_icon_hover_border',
                'label' => esc_html__( 'Border', 'mim-plugin' ),
                'selector' => '{{WRAPPER}} .single-service i:hover',
            ]
        );

        $this->add_control(
            'mim_services_section_icon_hover_background',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-service i:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();   

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_services_section_item_style',
            [
                'label' => esc_html__('Content Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_services_section_item_organization_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Organization Name', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_services_section_item_organization_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-service>h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_services_section_item_organization_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-service>h5' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_services_section_item_organization_typography',
                'selector' => '{{WRAPPER}} .single-service>h5',
            ]
        );

        $this->add_control(
            'mim_services_section_item_border_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_services_section_item_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-service hr' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_services_section_item_border_weight',
            [
                'label' => esc_html__( 'Weight', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .single-service hr' => 'border-width: {{VALUE}}px;',
                ],
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 2,
            ]
        ); 

        $this->add_control(
            'mim_services_section_item_border_width',
            [
                'label' => esc_html__( 'Width', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .single-service hr' => 'width: {{VALUE}}px;',
                ],
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 90,
            ]
        );     

        $this->add_control(
            'mim_services_section_item_year_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Year', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_services_section_item_year_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-service p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_services_section_item_year_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-service p' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_services_section_item_year_typography',
                'selector' => '{{WRAPPER}} .single-service p',
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
        $section_id =       $this->get_settings('service_section_id');
        $service_section_title =       $this->get_settings('service_section_title');
        $service_details_list =       $this->get_settings('service_details_list');
        $background_type =       $this->get_settings('background_type');

        if ($themefunctions->Version_Switcher() == 'dark') {
            $class_version = ($background_type == 'exp-light') ? 'dark-version bg-color-3' : 'dark-version dark-bg';
            $class_two = 'white-color';
        } else {
            $class_version = ($background_type == 'exp-light') ? 'light-bg' : 'bg-color-1';
            $class_two = '';
        }

?>
        
        <!-- Service Section Start -->

       <section class="service-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($section_id); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="section-title text-center mb-60">
                                <h2 class="mb-20"><?php echo esc_attr($service_section_title); ?></h2>
                                <div class="horizontal-line">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <?php foreach($service_details_list as $service_list): ?>
                        <div class="mobile-mb-30 col-xs-12 col-sm-6 col-md-3">
                            <div class="single-service pt-50 pb-60 plr-20">
                                <?php \Elementor\Icons_Manager::render_icon( $service_list['service_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                <h5 class="montserrat weight-medium no-margin"><?php echo wp_kses_post($service_list['service_title']); ?></h5>
                                <hr class="mtb-15">
                                <p><?php echo wp_kses_post($service_list['service_description']); ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </section>
        <!-- Service Section End -->
        <?php
    }
}