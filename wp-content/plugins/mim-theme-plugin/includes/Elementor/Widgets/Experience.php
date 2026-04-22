<?php
namespace MimTheme\Plugin\Elementor\Widgets;
use MimTheme\Frontend\ThemeFunctions;
use MimTheme\Frontend\UnisonFunctions;

class Experience extends \Elementor\Widget_Base
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
        return 'mimexperience';
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
        return esc_html__('Mim Experience', 'mim-plugin');
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
        return 'eicon-skill-bar';
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
        return ['experience', 'expert', 'skills', 'details', 'mim-plugin'];
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
            'mim_experience_section',
            [
                'label' => esc_html__('Mim Experience', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('experience', 'mim-plugin'),
                'default'     => esc_html__('experience', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'experience_section_title',
            [
                'label' => esc_html__('Experience Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('My Experience', 'mim-plugin'),
                'default'     => esc_html__('My Experience', 'mim-plugin'),
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_experience_section_list',
            [
                'label' => esc_html__('Experience Lists', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'experience_organization', [
                'label' => esc_html__( 'Organization Name', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Behance' , 'devboy-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'experience_year', [
                'label' => esc_html__( 'Experience Year', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '2007 - 2008' , 'devboy-core' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'experience_title', [
                'label' => esc_html__( 'Experience Title', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Designer & Developer' , 'devboy-core' ),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'experience_description', [
                'label' => esc_html__( 'Experience Description', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.' , 'devboy-core' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'experince_details_list',
            [
                'label' => esc_html__( 'My Experiences', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'experience_organization' => esc_html__( 'Behance', 'devboy-core' ),
                        'experience_year' => esc_html__( '2007 - 2008', 'devboy-core' ),
                        'experience_title' => esc_html__( 'Web Designer & Developer', 'devboy-core' ),
                        'experience_description' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.', 'devboy-core' ),
                    ],
                    [
                        'experience_organization' => esc_html__( 'Behance', 'devboy-core' ),
                        'experience_year' => esc_html__( '2007 - 2008', 'devboy-core' ),
                        'experience_title' => esc_html__( 'Web Designer & Developer', 'devboy-core' ),
                        'experience_description' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.', 'devboy-core' ),
                    ],
                    [
                        'experience_organization' => esc_html__( 'Behance', 'devboy-core' ),
                        'experience_year' => esc_html__( '2007 - 2008', 'devboy-core' ),
                        'experience_title' => esc_html__( 'Web Designer & Developer', 'devboy-core' ),
                        'experience_description' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.', 'devboy-core' ),
                    ],
                    [
                        'experience_organization' => esc_html__( 'Behance', 'devboy-core' ),
                        'experience_year' => esc_html__( '2007 - 2008', 'devboy-core' ),
                        'experience_title' => esc_html__( 'Web Designer & Developer', 'devboy-core' ),
                        'experience_description' => esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority.', 'devboy-core' ),
                    ],
                ],
                'title_field' => '{{{ experience_title }}}',
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
            'mim_experience_section_style',
            [
                'label' => esc_html__('Experience Section Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_hero_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_hero_section_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_section_spacing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Spacing', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_hero_section_padding',
            [
                'label' => esc_html__('Section Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .experience-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_section_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_experience_section_title_margin',
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
            'mim_experience_section_title_color',
            [
                'label' => esc_html__('Title Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_experience_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );
        
        $this->end_controls_section();

        // Border Top Styles

        $this->start_controls_section(
            'mim_experience_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_experience_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_experience_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_section_title_border_top_height',
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
            'mim_experience_section_title_border_top_width',
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
            'mim_experience_section_title_border_top_margin',
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
            'mim_experience_section_title_border_top_bottom_margin',
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
            'mim_experience_section_title_border_top_border_radius',
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
            'mim_experience_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_experience_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_section_title_border_bottom_height',
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
            'mim_experience_section_title_border_bottom_width',
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
            'mim_experience_section_title_border_bottom_margin',
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
            'mim_experience_section_title_border_bottom_bottom_margin',
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
            'mim_experience_section_title_border_bottom_border_radius',
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
            'mim_experience_item_style',
            [
                'label' => esc_html__('Experience Item Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_experience_organization_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Organization Name', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_experience_organization_title_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-experi .left-text>h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       
        $this->add_control(
            'mim_experience_organization_title_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-experi .left-text>h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_experience_organization_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .single-experi .left-text>h4',
            ]
        );
        $this->add_control(
            'mim_experience_year',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Experience Year', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_experience_year_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-experi .left-text>p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_year_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-experi .left-text>p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_experience_year_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .single-experi .left-text>p',
            ]
        );

        $this->add_control(
            'mim_job_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Job Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_job_title_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-experi .right-text>h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_job_title_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-experi .right-text>h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_job_title_color_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .single-experi .right-text>h3',
            ]
        );

        $this->add_control(
            'mim_job_description_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_job_description_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .right-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_job_description_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .right-text p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_job_description_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .right-text p',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'mim_experience_item_inner_border',
            [
                'label' => esc_html__('Experience Border Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_experience_item_inner_border_icon_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_experience_item_inner_border_icon_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-experi .right-text i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_experience_item_inner_border_icon_border_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Icon', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_experience_item_inner_border_icon_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-experi .dashed-line' => 'border-right: 2px dashed {{VALUE}};',
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
        $unisonfunctions = new UnisonFunctions();
        $ThemeFunctions = new ThemeFunctions();
        $settings = $this->get_settings_for_display();
        $section_id =       $this->get_settings('section_id');
        $experience_section_title =       $this->get_settings('experience_section_title');
        $experince_details_list =       $this->get_settings('experince_details_list');
        $experience_items_left =       $this->get_settings('experience_items_left');
        $experience_items_right =       $this->get_settings('experience_items_right');

        //$background_type = $unisonfunctions->Unison_Builder_Field($atts['background_type']);
        $background_type = 'exp-dark';

        if ($ThemeFunctions->Version_Switcher() == 'dark') {
            $class_version = ($background_type == 'exp-light') ? 'dark-version bg-color-3' : 'dark-version dark-bg';
            $class_two = 'white-color';
        } else {
            $class_version = ($background_type == 'exp-light') ? 'light-bg' : 'bg-color-1';
            $class_two = '';
        }

?>
        
        <!-- Experience Section Start -->

        <section class="experience-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($section_id); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="section-title text-center mb-60">
                                    <h2 class="mb-20"><?php echo esc_attr($experience_section_title); ?></h2>
                                    <div class="horizontal-line">
                                        <div class="top"></div>
                                        <div class="bottom"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <?php 
                                $size = count($experince_details_list);
                                $left_last = ($size - 2);
                                $a_s = ($size - 1);
                                $a = 0;
                                foreach ($experince_details_list as $experince_list) {
                                    if ($a != $a_s) {
                                        $class_one_l = 'mb-25';
                                        $class_two_l = 'relative';
                                    } else {
                                        $class_one_l = '';
                                        $class_two_l = '';
                                    }
                                        ?>
                                            <div class="col-xs-12 col-sm-6 mobile-mb-30">
                                                <div class="left">
                                                    <div class="single-experi <?php echo esc_attr($class_one_l); ?>">
                                                        <div class="left-text floatleft <?php echo esc_attr($class_two_l); ?>">
                                                            <?php if ( $a != $size && $a != $left_last && end($experince_details_list) != $experince_list ) { ?>
                                                                <div class="dashed-line"></div>
                                                            <?php } ?>

                                                            <h4 class="montserrat weight-medium capitalize"><?php echo wp_kses_post($experince_list['experience_organization']); ?></h4>
                                                            <p class="montserrat weight-medium"><?php echo wp_kses_post($experince_list['experience_year']); ?></p>
                                                        </div>
                                                        <div class="right-text">
                                                            <i class="zmdi zmdi-check-circle"></i>
                                                            <h3 class="capitalize font-20"><?php echo wp_kses_post($experince_list['experience_title']); ?></h3>
                                                            <p><?php echo wp_kses_post($experince_list['experience_description']); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php 
                                    $a++; 
                                } 
                            ?>
                        </div>
                    </div>
                </section>
        
        <!-- Experience Section End -->
<?php
    }
}