<?php
namespace MimTheme\Plugin\Elementor\Widgets;
use MimTheme\Frontend\ThemeFunctions;

use MimTheme\Plugin\Admin\Mim_Functions;


class Contacts extends \Elementor\Widget_Base
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
        return 'mimcontact';
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
        return esc_html__('Mim Contact', 'mim-plugin');
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
        return ['contact', 'us', 'info', 'details', 'mim-plugin'];
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

        $Mim_Functions = new Mim_Functions();

        $this->start_controls_section(
            'mim_info_section',
            [
                'label' => esc_html__('Contact Details', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('contact', 'mim-plugin'),
                'default'     => esc_html__('contact', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_mtitle',
            [
                'label' => esc_html__('Contact Details Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => __('Let\'s get in touch', 'mim-plugin'),
                'default'     => __('Let\'s get in touch', 'mim-plugin'),
            ]
        );
        $this->add_control(
            'mim_content',
            [
                'label' => esc_html__('Description', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder'     => __('Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'mim-plugin'),
                'default'     => __('Lorem ipsum dolor sit amet consectetur adipisicing elit.', 'mim-plugin'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'mim_list_icon',
            [
                'label' => __('List Icon', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                ],

            ]
        );

        $repeater->add_control(
            'mim_list_head',
            [
                'label' => esc_html__('List Header', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'mim_list_text',
            [
                'label' => esc_html__('List Text', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'text_type',
            [
                'label'   => __('Text Type', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'link'   => __('Link', 'mim-plugin'),
                    'phone'  => __('Phone', 'mim-plugin'),
                    'email'  => __('Email', 'mim-plugin'),
                    'text'  => __('Plane Text', 'mim-plugin'),
                ]
            ]
        );

        $this->add_control(
            'mim_list_item',
            [
                'label' => esc_html__('Contact Information List', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'separator' => 'before',
                'title_field' => '{{ mim_list_text }}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'mim_list_icon' => [
                            'value' => 'fas fa-phone',
                            'library' => 'solid',
                        ],
                        'mim_list_head' => esc_html__('Phone', 'mim-plugin'),
                        'mim_list_text' => esc_html__('+88 669 658 6586', 'mim-plugin'),
                        'text_type' => 'phone',
                    ],
                    [
                        'mim_list_icon' => [
                            'value' => 'far fa-envelope',
                            'library' => 'regular',
                        ],
                        'mim_list_head' => esc_html__('Email', 'mim-plugin'),
                        'mim_list_text' => esc_html__('email@domain.com', 'mim-plugin'),
                        'text_type' => 'email',
                    ],
                    [
                        'mim_list_icon' => [
                            'value' => 'fas fa-university',
                            'library' => 'solid',
                        ],
                        'mim_list_head' => esc_html__('Location', 'mim-plugin'),
                        'mim_list_text' => esc_html__('Location Name,Here.US', 'mim-plugin'),
                        'text_type' => 'text',
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            'mim_contact_form',
            [
                'label' => esc_html__('Contact Form', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // $this->add_control(
        //     'mim_cshortcode',
        //     [
        //         'label' => esc_html__('Contact Form shortcode', 'elementor'),
        //         'type' => \Elementor\Controls_Manager::TEXTAREA,
        //         'dynamic' => [
        //             'active' => true,
        //         ],
        //         'placeholder' => '[contact-form-7 id="1" title="Contact form 1"]',
        //         'default' => '',
        //     ]
        // );

        $this->add_control(
            'form_id',
            [
                'label' => esc_html__('Select Your Form', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => esc_html__('', 'mim-plugin')] + $Mim_Functions->mim_get_cf7_forms(),
            ]
        );

        $this->add_control(
            'html_class',
            [
                'label' => esc_html__('HTML Class', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'description' => esc_html__('Add CSS custom class to the form.', 'mim-plugin'),
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
            'mim_contact_section_background',
            [
                'label' => esc_html__('Section Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_contact_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_contact_section_background_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mim_contact_section_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_contact_section_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_contact_section_title_margin',
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
            'mim_contact_section_title_color',
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
                'name' => 'mim_contact_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );

        $this->end_controls_section();

        // Border Top Styles

        $this->start_controls_section(
            'mim_contact_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_contact_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_contact_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_contact_section_title_border_top_height',
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
            'mim_contact_section_title_border_top_width',
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
            'mim_contact_section_title_border_top_margin',
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
            'mim_contact_section_title_border_top_bottom_margin',
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
            'mim_contact_section_title_border_top_border_radius',
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
            'mim_contact_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_contact_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_contact_section_title_border_bottom_height',
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
            'mim_contact_section_title_border_bottom_width',
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
            'mim_contact_section_title_border_bottom_margin',
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
            'mim_contact_section_title_border_bottom_bottom_margin',
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
            'mim_contact_section_title_border_bottom_border_radius',
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
            'mim_border_section',
            [
                'label' => esc_html__('Contact Details Text Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        

        $this->add_control(
            'mim_contact_description_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'mim_contact_description_margin',
            [
                'label' => esc_html__('Margin Bottom', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-area .section-title p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mim_contact_description_color',
            [
                'label' => esc_html__('Description Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-area .section-title p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_contact_tdesc_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .contact-area .section-title p',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'mim_dlist_section',
            [
                'label' => esc_html__('Details List Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'mim_dlist_bspacing',
            [
                'label' => __('Details List Bottom Space', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-text li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mim_sicon_size',
            [
                'label' => __('Details List Icon Size', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .contact-text li i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mim_list_head',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('List Header', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'mim_dlist_hcolor',
            [
                'label' => __('List Header Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-text li h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_dlist_htypography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .contact-text li h4',
            ]
        );
        $this->add_control(
            'mim_dlist_head',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('List text', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'mim_dlist_tcolor',
            [
                'label' => __('List Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-text li span a,{{WRAPPER}} .contact-text li span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_dlist_ttypography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .contact-text li span a,{{WRAPPER}} .contact-text li span',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_cfbtn_style',
            [
                'label' => __('Contact Form Button', 'magical-addons-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_cfbtn_padding',
            [
                'label' => __('Padding', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_cfbtn_typography',
                'selector' => '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_cfbtn_border',
                'selector' => '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]',
            ]
        );

        $this->add_control(
            'mim_cfbtn_border_radius',
            [
                'label' => __('Border Radius', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_cfbtn_box_shadow',
                'selector' => '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]',
            ]
        );
        $this->add_control(
            'mgcard_button_color',
            [
                'label' => __('Button color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('infobox_btn_tabs');

        $this->start_controls_tab(
            'mim_cfbtn_normal_style',
            [
                'label' => __('Normal', 'magical-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'mim_cfbtn_color',
            [
                'label' => __('Text Color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_cfbtn_bg_color',
            [
                'label' => __('Background Color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn, {{WRAPPER}} .contact-form button, {{WRAPPER}} .contact-form input[type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_cfbtn_hover_style',
            [
                'label' => __('Hover', 'magical-addons-for-elementor'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgcard_btnhover_boxshadow',
                'selector' => '{{WRAPPER}} .contact-form input.btn:hover, {{WRAPPER}} .contact-form button:hover, {{WRAPPER}} .contact-form input[type="submit"]:hover',
            ]
        );

        $this->add_control(
            'mim_cfbtn_hcolor',
            [
                'label' => __('Text Color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn:hover, {{WRAPPER}} .contact-form button:hover, {{WRAPPER}} .contact-form input[type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_cfbtn_hbg_color',
            [
                'label' => __('Background Color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn:hover, {{WRAPPER}} .contact-form button:hover, {{WRAPPER}} .contact-form input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_cfbtn_hborder_color',
            [
                'label' => __('Border Color', 'magical-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'mim_cfbtn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-form input.btn:hover, {{WRAPPER}} .contact-form button:hover, {{WRAPPER}} .contact-form input[type="submit"]:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

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
        $mim_mtitle = $this->get_settings('mim_mtitle');
        $mim_content = $this->get_settings('mim_content');
        $mim_list_item = $this->get_settings('mim_list_item');
        $mim_stitle = $this->get_settings('mim_stitle');
        $mim_cftitle = $this->get_settings('mim_cftitle');
        $section_id = $this->get_settings('section_id');

        if ($themefunctions->Version_Switcher() == 'dark') {
            $class_version = 'dark-version dark-bg';
            $class_two = 'white-color';
        } else {
            $class_version = 'light-bg';
            $class_two = '';
        }

?>

        <div class="contact-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($section_id); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="left">
                            <div class="section-title mb-30">
                                <?php if ($mim_mtitle) : ?>
                                    <h2 class="mb-15 "><?php echo esc_html($mim_mtitle); ?></h2>
                                <?php endif; ?>
                                <div class="horizontal-line mb-20">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                                <?php if ($mim_content) : ?>
                                    <p><?php echo esc_html($mim_content); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($mim_list_item) : ?>
                                <ul class="contact-text clearfix">
                                    <?php
                                    foreach ($mim_list_item as $item) :
                                        if ($item['text_type'] == 'phone') {
                                            $text_type = 'tel:' . $item['mim_list_text'];
                                        } elseif ($item['text_type'] == 'email') {
                                            $text_type = 'mailto:' . $item['mim_list_text'];
                                        } else {
                                            $text_type = $item['mim_list_text'];
                                        }

                                    ?>
                                        <li>
                                            <?php \Elementor\Icons_Manager::render_icon($item['mim_list_icon']); ?>
                                            <h4 class="montserrat weight-regular no-margin capitalize"><?php echo esc_html($item['mim_list_head']); ?></h4>

                                            <?php if ($item['text_type'] != 'text') : ?>
                                                <span> <a class="montserrat weight-regular" href="<?php echo esc_url($text_type); ?>"><?php echo esc_attr($item['mim_list_text']); ?></a></span>
                                            <?php else : ?>
                                                <span class="montserrat weight-regular"><?php echo esc_attr($item['mim_list_text']); ?></span>
                                            <?php endif; ?>

                                        </li>

                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-8">
                        <div class="right">
                            <div class="contact-form pt-40">
                                <?php
                                $Mim_Functions = new Mim_Functions();
                                if (!empty($settings['form_id'])) {
                                    echo $Mim_Functions->mim_do_shortcode('contact-form-7', [
                                        'id' => $settings['form_id'],
                                        'html_class' => 'mim-cf7-form ' . esc_html($settings['html_class']),
                                    ]);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}