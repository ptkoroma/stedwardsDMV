<?php
namespace MimTheme\Plugin\Elementor\Widgets;
use MimTheme\Frontend\ThemeFunctions;

class About extends \Elementor\Widget_Base
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
        return 'mim_about';
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
        return esc_html__('Mim About', 'mim-plugin');
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
        return 'eicon-person';
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
        return ['about', 'us', 'info', 'details', 'mim-plugin'];
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
            'mim_about_section',
            [
                'label' => esc_html__('Contact Details', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'mim_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('about', 'mim-plugin'),
                'default'     => esc_html__('about', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_section_title',
            [
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('About Me', 'mim-plugin'),
                'default'     => esc_html__('About Me', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_hello_text',
            [
                'label' => esc_html__('Hello Text', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('Howdy!', 'mim-plugin'),
                'default'     => esc_html__('Howdy!', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_about_description',
            [
                'label' => esc_html__('Description', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder'     => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'mim-plugin'),
                'default'     => esc_html__('Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'cv_btn_label',
            [
                'label' => esc_html__('CV Download Button', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('Download My CV', 'mim-plugin'),
                'default'     => esc_html__('Download My CV', 'mim-plugin'),
            ]
        );

        $this->add_control(
                    'cv_btn_url',
                    [
                        'label' => esc_html__( 'CV Button URL', 'mim-plugin' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://your-link.com', 'mim-plugin' ),
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => 'https://your-link.com',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
                        'label_block' => true,
                    ]
                );

        $repeater = new \Elementor\Repeater();        

        $repeater->add_control(
            'skill_name',
            [
                'label' => esc_html__('Skill Name', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'skill_percent',
            [
                'label' => esc_html__( 'Skill Percent', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 100,
                'step' => 5,
                'default' => 70,
            ]
        );       
        

        $this->add_control(
            'skills',
            [
                'label' => esc_html__('Skills List', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'separator' => 'before',
                'title_field' => '{{ skill_name }}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'skill_name' => esc_html__('Design', 'mim-plugin'),
                        'skill_percent' => esc_html__(80, 'mim-plugin'),
                    ],
                    [
                        'skill_name' => esc_html__('HTML & CSS', 'mim-plugin'),
                        'skill_percent' => esc_html__(90, 'mim-plugin'),
                    ],
                    [
                        'skill_name' => esc_html__('WordPress', 'mim-plugin'),
                        'skill_percent' => esc_html__(70, 'mim-plugin'),
                    ],
                ],
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
            'mim_about_section_style',
            [
                'label' => esc_html__('Section Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_about_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_about_section_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'mim_about_section_spacing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Spacing', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_about_section_padding',
            [
                'label' => esc_html__('Section Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .about-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'mim_about_section_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'), 
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_section_title_margin',
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
            'mim_about_section_title_color',
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
                'name' => 'mim_about_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );

        $this->end_controls_section();

        // Border Top Styles

        $this->start_controls_section(
            'mim_about_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_about_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_about_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_title_border_top_height',
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
            'mim_about_section_title_border_top_width',
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
            'mim_about_section_title_border_top_margin',
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
            'mim_about_section_title_border_top_bottom_margin',
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
            'mim_about_section_title_border_top_border_radius',
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
            'mim_about_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_about_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_title_border_bottom_height',
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
            'mim_about_section_title_border_bottom_width',
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
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_title_border_bottom_margin',
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
            'mim_about_section_title_border_bottom_bottom_margin',
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
            'mim_about_section_title_border_bottom_border_radius',
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
            'mim_about_section_content_section',
            [
                'label' => esc_html__('Content Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_about_section_hello_text_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Hello Text', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_hello_text_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .about-area .font-22.capitalize' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'mim_about_section_hello_text_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h3.font-22.capitalize' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_about_section_hello_text_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} h3.font-22.capitalize',
            ]
        );

        // Description

        $this->add_control(
            'mim_about_section_description_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_about_description_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .line-height-28' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_description_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.font-16.line-height-28' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_about_section_description_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} p.font-16.line-height-28',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_about_section_content_button',
            [
                'label' => esc_html__('Download CV Button', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'cv_btn_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .about-button.mt-30' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mim_about_button_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_about_button_typography',
                'selector' => '{{WRAPPER}} .about-button .btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_about_button_border',
                'selector' => '{{WRAPPER}} .about-button .btn',
            ]
        );

        $this->add_control(
            'mim_about_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_about_button_box_shadow',
                'selector' => '{{WRAPPER}} .about-button .btn',
            ]
        );
        $this->add_control(
            'mim_about_button_text_color',
            [
                'label' => esc_html__('Button Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('mim_about_button_tabs');

        $this->start_controls_tab(
            'mim_about_button_tab_normal',
            [
                'label' => esc_html__('Normal', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_about_button_normal_text',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_button_normal_background',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_about_button_hover_style',
            [
                'label' => esc_html__('Hover', 'mim-plugin'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_about_button_hover_boxshadow',
                'selector' => '{{WRAPPER}} .about-button .btn:hover',
            ]
        );

        $this->add_control(
            'mim_about_button_hover_color',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_button_hover_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'pxcnt_cfbtn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .about-button .btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_about_section_skill_items',
            [
                'label' => esc_html__('Skill Lists', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_text_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Skill Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_about_section_skill_item_text_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .progress-mark span, .progress-title-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_text_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.progress-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_about_section_skill_item_text_typography',
                'selector' => '{{WRAPPER}} span.progress-title',
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Skill Percent', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-mark span, .progress-title-holder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_about_section_skill_item_percent_typography',
                'selector' => '{{WRAPPER}} .progress-mark span, .progress-title-holder',
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_border_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Color', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_border_active_color',
            [
                'label' => esc_html__('Inner Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_border_inactive_color',
            [
                'label' => esc_html__('Outter Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-outter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_about_section_skill_item_percent_dot_color',
            [
                'label' => esc_html__('Dot Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-mark:after' => 'background: {{VALUE}};',
                ],
            ]
        );        

        $this->add_control(
            'mim_about_section_skill_item_percent_dot_border_color',
            [
                'label' => esc_html__('Dot Border Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .progress-mark:after' => 'box-shadow:0 0 0 4px {{VALUE}};',
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


        $mim_section_id =       $this->get_settings('mim_section_id');
        $mim_section_title =    $this->get_settings('mim_section_title');
        $mim_hello_text =       $this->get_settings('mim_hello_text');
        $mim_about_description =      $this->get_settings('mim_about_description');
        $cv_btn_label =     $this->get_settings('cv_btn_label');
        $cv_btn_url =       $this->get_settings('cv_btn_url');
        $skills =           $this->get_settings('skills');
        $background_type =  $this->get_settings('background_type');


        if ( $themefunctions->Version_Switcher() == 'dark' ) {
            $class_version = ($background_type == 'about-light') ? 'dark-version bg-color-3' : 'dark-version dark-bg';
            $class_two = 'white-color';
            $class_three = 'light-color';
        } else {
            $class_version = ($background_type == 'about-light') ? 'light-bg' : 'bg-color-1';
            $class_two = '';
            $class_three = '';
        }

?>

        <script>
            (function($) {
                "use strict";

                var ProWey = $('.skill-progress');
                if (ProWey.length > 0) {
                    ProWey.waypoint(function() {
                        jQuery('.skill-bar').each(function() {
                            jQuery(this).find('.progress-content').animate({
                                width: jQuery(this).attr('data-percentage')
                            }, 2000);

                            jQuery(this).find('.progress-mark').animate({
                                left: jQuery(this).attr('data-percentage')
                            },{
                                duration: 2150,
                                step: function(now, fx) {
                                    var data = Math.round(now);
                                    jQuery(this).find('.percent').html(data + '%');
                                }
                            });
                        });
                    }, {
                        offset: '90%'
                    });
                };
            

            })(jQuery);
        </script>
        
        <!-- About Section Start -->
        <section class="about-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($mim_section_id); ?>">
            <div class="container">

                <?php if ($mim_section_title) : ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title text-center mb-60">
                                <h2 class="mb-20 <?php echo esc_attr($class_two); ?>"><?php echo wp_kses_post($mim_section_title); ?></h2>
                                <div class="horizontal-line">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="left mr-40 animate move-fadeInUp">
                            <?php
                            if ($mim_hello_text) :
                            ?>
                                <h3 class="font-22 capitalize <?php echo esc_attr($class_two); ?>"><?php echo wp_kses_post($mim_hello_text); ?></h3>
                            <?php
                            endif;
                            if ($mim_about_description) :
                            ?>
                                <p class="font-16 line-height-28">
                                    <?php
                                    echo wp_kses_post($mim_about_description);
                                    ?>
                                </p>
                            <?php
                            endif;
                            if ($cv_btn_label && $cv_btn_url) :
                                $cv_file = $cv_btn_url['url'];
                            ?>
                                <div class="about-button mt-30">
                                    <a class="btn" href="<?php echo esc_url($cv_file); ?>"><?php echo wp_kses_post($cv_btn_label); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5 offset-lg-1">


                        <?php if ($skills) : ?>
                            <div class="right skill-progress animate move-fadeInUp">
                                <?php foreach ($skills as $skill) { ?>
                                    <div class="skill-bar" data-percentage="<?php echo esc_attr($skill['skill_percent']); ?>%">
                                        <h4 class="progress-title-holder">
                                            <span class="progress-title"><?php echo wp_kses_post($skill['skill_name']); ?></span>
                                            <span class="progress-wrapper">
                                                <span class="progress-mark">
                                                    <span class="percent"></span>
                                                </span>
                                            </span>
                                        </h4>
                                        <div class="progress-outter">
                                            <div class="progress-content"></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->
    <?php
    }
}