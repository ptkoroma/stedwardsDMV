<?php
namespace MimTheme\Plugin\Elementor\Widgets;

class Pricing extends \Elementor\Widget_Base
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
        return 'mim_price';
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
        return esc_html__('Mim Pricing', 'mim-plugin');
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
        return 'eicon-price-table';
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
        return ['pricing', 'table', 'price', 'details', 'mim-plugin'];
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
            'mim_price_section_details',
            [
                'label' => esc_html__('Pricing Section', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mim_price_section_title',
            [
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'  => true,
                'placeholder' => esc_html__('Our Pricing', 'mim-plugin'),
                'default'     => esc_html__('Our Pricing', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_price_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'  => true,
                'placeholder' => esc_html__('pricing', 'mim-plugin'),
                'default'     => esc_html__('pricing', 'mim-plugin'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_price_item_section_title',
            [
                'label' => esc_html__('Package Details', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'pricing_item_title',
            [
                'label' => esc_html__('Package Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block'  => true,
                'placeholder' => esc_html__('Plane Name', 'mim-plugin'),
                'default'     => esc_html__('Standard', 'mim-plugin'),
            ]
        );

        $repeater->add_control(
            'pricing_package_featured',
            [
                'label' => esc_html__( 'Featured Item', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'mim-plugin' ),
                'label_off' => esc_html__( 'No', 'mim-plugin' ),
                'return_value' => 'no',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
                    'pricing_package_feature_icon',
                    [
                        'label' => esc_html__( 'Icon', 'plugin-name' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-check',
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
            'mim_pricing_feature_one',
            [
                'label'       => esc_html__('Feature One', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature One', 'mim-plugin'),
                'default'     => esc_html__('Feature One', 'mim-plugin'),
            ]
        );

        $repeater->add_control(
            'mim_pricing_feature_two',
            [
                'label'       => esc_html__('Feature Two', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Two', 'mim-plugin'),
                'default'     => esc_html__('Feature Two', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_three',
            [
                'label'       => esc_html__('Feature Three', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Three', 'mim-plugin'),
                'default'     => esc_html__('Feature Three', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_four',
            [
                'label'       => esc_html__('Feature Four', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Four', 'mim-plugin'),
                'default'     => esc_html__('Feature Four', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_five',
            [
                'label'       => esc_html__('Feature Five', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Five', 'mim-plugin'),
                'default'     => esc_html__('Feature Five', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_six',
            [
                'label'       => esc_html__('Feature Six', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Six', 'mim-plugin'),
                'default'     => esc_html__('Feature Six', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_seven',
            [
                'label'       => esc_html__('Feature Seven', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Seven', 'mim-plugin'),
                'default'     => esc_html__('Feature Seven', 'mim-plugin'),
            ]
        );
        $repeater->add_control(
            'mim_pricing_feature_eight',
            [
                'label'       => esc_html__('Feature Eight', 'mim-plugin'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'input_type'  => 'text',
                'placeholder' => esc_html__('Feature Eight', 'mim-plugin'),
                'default'     => esc_html__('Feature Eight', 'mim-plugin'),
            ]
        );

        $repeater->add_control(
            'mim_item_price',
            [
                'label' => esc_html__('Price', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('$99', 'mim-plugin'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mim_item_price_text',
            [
                'label' => esc_html__('Subscription', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('/Month', 'mim-plugin'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mim_item_button_label',
            [
                'label' => esc_html__('Button Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Choose Now', 'mim-plugin'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mim_item_button_url',
            [
                'label' => esc_html__( 'URL', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'mim-plugin' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => true,
                    'nofollow' => true,
                    'class' => 'btn',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'mim_pricing_package_list',
            [
                'label' => esc_html__( 'Packages', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'pricing_item_title' => esc_html__( 'Standard', 'mim-plugin' ),
                        'mim_item_price' => esc_html__( '29', 'mim-plugin' ),
                    ],
                    [
                        'pricing_item_title' => esc_html__( 'Intermediate', 'mim-plugin' ),
                        'mim_item_price' => esc_html__( '49', 'mim-plugin' ),
                    ],
                    [
                        'pricing_item_title' => esc_html__( 'Premium', 'mim-plugin' ),
                        'mim_item_price' => esc_html__( '79', 'mim-plugin' ),
                    ]
                ],
                'title_field' => '{{{ pricing_item_title }}}',
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
            'mim_pricing_section_style',
            [
                'label' => esc_html__('Section Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_pricing_section_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_inner_spaces',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .pricing-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_background_color',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_color',
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
                'name' => 'mim_pricing_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_title_margin',
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
            'mim_pricing_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_border_top_height',
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
            'mim_pricing_section_title_border_top_width',
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
            'mim_pricing_section_title_border_top_margin',
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
            'mim_pricing_section_title_border_top_bottom_margin',
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
            'mim_pricing_section_title_border_top_border_radius',
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
            'mim_pricing_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_title_border_bottom_height',
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
            'mim_pricing_section_title_border_bottom_width',
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
            'mim_pricing_section_title_border_bottom_margin',
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
            'mim_pricing_section_title_border_bottom_bottom_margin',
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
            'mim_pricing_section_title_border_bottom_border_radius',
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
            'mim_pricing_section_packages_item',
            [
                'label' => esc_html__('Package Settings', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_packages_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_background',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Package Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_background_color',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Package Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_title_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table .head h3' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'mim_pricing_section_packages_item_title_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-table .head h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_pricing_section_packages_item_title_typography',
                'selector' => '{{WRAPPER}} .single-table .head h3',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_border_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table hr.line' => 'background: {{VALUE}} none repeat scroll 0 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_packages_item_border_height',
            [
                'label' => esc_html__('Height', 'mim-plugin'),
                'type' =>  \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .single-table hr.line' => 'height: {{SIZE}}{{UNIT}};',

                ],

            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_packages_item_border_width',
            [
                'label' => esc_html__('Width', 'mim-plugin'),
                'type' =>  \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .single-table hr.line' => 'width: {{SIZE}}{{UNIT}}; margin: 0 auto;',

                ],

            ]
        );

        $this->add_responsive_control(
            'mim_pricing_section_packages_item_border_radius_style',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-table hr.line' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 

        // Pricing Features

        $this->start_controls_section(
            'mim_pricing_section_packages_item_features',
            [
                'label' => esc_html__('Package Features', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_features_style',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Features', 'mim-plugin'),
                'separator' => 'before'
            ]
        );


        $this->add_responsive_control(
            'mim_pricing_section_packages_item_features_item_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .single-table .content li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_features_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-table .content li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_pricing_section_packages_item_features_typography',
                'selector' => '{{WRAPPER}} .single-table .content li',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_pricing_section_packages_item_pricing_area',
            [
                'label' => esc_html__('Package Pricing', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_pricing_area_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Currency', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_pricing_currency_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} sup.font-22.we-sami' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_pricing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Price', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_pricing_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-table .content h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_pricing_section_packages_item_pricing_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .single-table .content h1 span',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_subscription_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Subscription', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_pricing_section_packages_item_subscription_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-table .content h1 span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_pricing_section_packages_item_subscription_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .single-table .content h1 span',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );



        $this->end_controls_section();

        // Button

        $this->start_controls_section(
            'mim_pricing_button_style',
            [
                'label' => esc_html__('Package Button', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_pricing_button_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_pricing_button_typography',
                'selector' => '{{WRAPPER}} .single-table .content .btn',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_pricing_button_border',
                'selector' => '{{WRAPPER}} .single-table .content .btn',
            ]
        );

        $this->add_control(
            'mim_pricing_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_pricing_button_box_shadow',
                'selector' => '{{WRAPPER}} .single-table .content .btn',
            ]
        );
        $this->add_control(
            'mim_pricing_button_text_color',
            [
                'label' => esc_html__('Button Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('mim_pricing_button_tabs');

        $this->start_controls_tab(
            'mim_pricing_button_tab_normal',
            [
                'label' => esc_html__('Normal', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_pricing_button_normal_text',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_button_normal_background',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_pricing_button_hover_style',
            [
                'label' => esc_html__('Hover', 'mim-plugin'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_pricing_button_hover_boxshadow',
                'selector' => '{{WRAPPER}} .single-table .content .btn:hover',
            ]
        );

        $this->add_control(
            'mim_pricing_button_hover_color',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_button_hover_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'pxcnt_cfbtn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .single-table .content .btn:hover' => 'border-color: {{VALUE}};',
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
        $settings = $this->get_settings_for_display();
        $mim_price_section_title = $this->get_settings('mim_price_section_title');
        $mim_price_section_id = $this->get_settings('mim_price_section_id');
        $mim_pricing_package_list = $this->get_settings('mim_pricing_package_list');
        $class_two = '';
        $class_three = '';


?>

        <!-- Pricing Section Start -->
        <section class="pricing-area pricing-one light-bg section-padding" id="<?php echo wp_kses_post($mim_price_section_id); ?>">
            <div class="container">
                <?php if ($mim_price_section_title) : ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title text-center mb-60">
                                <h2 class="mb-20 <?php echo esc_attr($class_two); ?>"><?php echo wp_kses_post($mim_price_section_title); ?></h2>
                                <div class="horizontal-line">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-10 col-text-center">
                        <div class="row text-center">
                            <?php
                            if ($mim_pricing_package_list) :
                                foreach ($mim_pricing_package_list as $pricing_item) {
                                    $active_class = ($pricing_item['pricing_package_featured']) ? 'middel ' : 'mt-30';
                            ?>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="single-table <?php echo esc_attr($active_class . ' ' . $class_three); ?> mobile-mb-30">
                                            <div class="head v-align">
                                                <h3 class="we-bold no-margin uppercase"><?php echo wp_kses_post($pricing_item['pricing_item_title']); ?>
                                                </h3>
                                            </div>
                                            <hr class="line" />
                                            <div class="content-height">
                                                <div class="d-table">
                                                    <div class="d-table-cell">
                                                        <div class="content">
                                                            <ul>
                                                                <?php if($pricing_item['mim_pricing_feature_one']): ?>
                                                                    <li>
                                                                    <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_one']); ?> 
                                                                </li>
                                                                <?php endif; ?>


                                                                <?php if($pricing_item['mim_pricing_feature_two']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_two']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_three']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_three']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_four']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_four']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_five']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_five']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_six']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_six']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_seven']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                   <?php echo esc_html($pricing_item['mim_pricing_feature_seven']); ?>
                                                                       
                                                                   </li>
                                                                <?php endif; ?>

                                                                
                                                                <?php if($pricing_item['mim_pricing_feature_eight']): ?>
                                                                    <li>
                                                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['pricing_package_feature_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                                    <?php echo esc_html($pricing_item['mim_pricing_feature_eight']); ?>
                                                                        
                                                                    </li>
                                                                <?php endif; ?>

                                                                
                                                            </ul>
                                                            <h1 class="font-40 we-sami mb-20 mt-30">
                                                                <sup class="font-22 we-sami"><?php esc_html_e('$', 'mim-plugin'); ?></sup><?php echo esc_html($pricing_item['mim_item_price']); ?>
                                                                <span class="font-16 we-medium capitalize"> </sup><?php echo esc_html($pricing_item['mim_item_price_text']); ?></span>
                                                            </h1>
                                                            
                                                            <a href="<?php echo esc_url($pricing_item['mim_item_button_url']['url']); ?>" class="<?php echo esc_attr($pricing_item['mim_item_button_url']['class']); ?>"><?php echo esc_html($pricing_item['mim_item_button_label']); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                   
                                }
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Pricing Section End -->
        <?php
    }
}