<?php


namespace MimTheme\Plugin\Elementor\Widgets;

use MimTheme\Plugin\Admin\Mim_Functions;
$Mim_Functions = new Mim_Functions();

use MimTheme\Frontend\ThemeFunctions;
//$themefunctions = new ThemeFunctions();

class PostsGrid extends \Elementor\Widget_Base
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
        return 'mimposts_dgrid';
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
        return __('Mim Posts Grid', 'mim-plugin');
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
        return 'eicon-posts-grid';
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
        return ['mim-plugin', 'post', 'grid', 'card', 'blog'];
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
            'mgpg_query',
            [
                'label' => esc_html__('Posts Query', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mgpg_posts_filter',
            [
                'label' => esc_html__('Filter By', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => esc_html__('Recent Posts', 'mim-plugin'),
                    /*'featured' => esc_html__( 'Popular Posts', 'mim-plugin' ),*/
                    'random_order' => esc_html__('Random Posts', 'mim-plugin'),
                    'show_byid' => esc_html__('Show By Id', 'mim-plugin'),
                    'show_byid_manually' => esc_html__('Add ID Manually', 'mim-plugin'),
                ],
            ]
        );

        $this->add_control(
            'mgpg_post_id',
            [
                'label' => __('Select posts', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $Mim_Functions->Display_Posts_Name(),
                'condition' => [
                    'mgpg_posts_filter' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mgpg_post_ids_manually',
            [
                'label' => __('posts IDs', 'mim-plugin'),
                'description' => __('Separate IDs with commas', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'mgpg_posts_filter' => 'show_byid_manually',
                ]
            ]
        );

        $this->add_control(
            'mgpg_posts_count',
            [
                'label'   => __('posts Limit', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'mgpg_grid_categories',
            [
                'label' => esc_html__('posts Categories', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $Mim_Functions->Display_Taxonomy_List(),
                'condition' => [
                    'mgpg_posts_filter!' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mgpg_custom_order',
            [
                'label' => esc_html__('Custom order', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Orderby', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__('None', 'mim-plugin'),
                    'ID'            => esc_html__('ID', 'mim-plugin'),
                    'date'          => esc_html__('Date', 'mim-plugin'),
                    'name'          => esc_html__('Name', 'mim-plugin'),
                    'title'         => esc_html__('Title', 'mim-plugin'),
                    'comment_count' => esc_html__('Comment count', 'mim-plugin'),
                    'rand'          => esc_html__('Random', 'mim-plugin'),
                ],
                'condition' => [
                    'mgpg_custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('order', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending', 'mim-plugin'),
                    'ASC'   => esc_html__('Ascending', 'mim-plugin'),
                ],
                'condition' => [
                    'mgpg_custom_order' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
        // posts Content
        $this->start_controls_section(
            'mgpg_layout',
            [
                'label' => esc_html__('Grid Layout', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mgpg_rownumber',
            [
                'label'   => __('Show Posts Per Row', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12'   => __('1', 'mim-plugin'),
                    '6'  => __('2', 'mim-plugin'),
                    '4'  => __('3', 'mim-plugin'),
                    '3'  => __('4', 'mim-plugin'),
                    '2'  => __('6', 'mim-plugin'),
                ]
            ]
        );
        $this->end_controls_section();
        // posts Content
        $this->start_controls_section(
            'mgpg_content',
            [
                'label' => esc_html__('Content Settings', 'mim-plugin'),
            ]
        );


        $this->add_control(
            'mgpg_post_img_show',
            [
                'label'     => __('Show Posts image', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'mgpg_show_title',
            [
                'label'     => __('Show posts Title', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_crop_title',
            [
                'label'   => __('Crop Title By Word', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'step'    => 1,
                'default' => 5,
                'condition' => [
                    'mgpg_show_title' => 'yes',
                ]

            ]
        );

        $this->add_control(
            'mgpg_desc_show',
            [
                'label'     => __('Show posts Description', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => ''

            ]
        );
        $this->add_control(
            'mgpg_crop_desc',
            [
                'label'   => __('Crop Description By Word', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'step'    => 1,
                'default' => 20,
                'condition' => [
                    'mgpg_desc_show' => 'yes',
                ]

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
                'default' => 'left',
                'classes' => 'flex-{{VALUE}}',
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_meta_show',
            [
                'label'     => __('Show Meta', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        $this->add_control(
            'mgpg_post_btnicon',
            [
                'label'     => __('Show Link Icon', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

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
            'mgpg_style',
            [
                'label' => __('Layout style', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mgpg_bg_color',
                'label' => esc_html__('Background', 'mim-plugin'),
                'types' => ['classic', 'gradient'],

                'selector' => '{{WRAPPER}} .blog-area .single-blog',
            ]
        );

        $this->add_control(
            'mgpg_border_radius',
            [
                'label' => __('Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mgpg_content_border',
                'selector' => '{{WRAPPER}} .blog-area .single-blog',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mgpg_content_shadow',
                'selector' => '{{WRAPPER}} .blog-area .single-blog',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'mgpg_img_style',
            [
                'label' => __('Image style', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'mgpg_post_img_show' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'image_width_set',
            [
                'label' => __('Width', 'mim-plugin'),
                'type' =>  \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],

                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog img' => 'flex: 0 0 {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_img_auto_height',
            [
                'label' => __('Image auto height', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('On', 'mim-plugin'),
                'label_off' => __('Off', 'mim-plugin'),
                'default' => 'yes',
            ]
        );
        $this->add_responsive_control(
            'mgpg_img_height',
            [
                'label' => __('Image Height', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'condition' => [
                    'mgpg_img_auto_height!' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mgpg_img_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_img_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mgpg_img_border_radius',
            [
                'label' => __('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'mgpg_img_bgcolor',
                'label' => esc_html__('Background', 'mim-plugin'),
                //'types' => [ 'classic', 'gradient' ],

                'selector' => '{{WRAPPER}} .blog-area .single-blog img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mgpg_img_border',
                'selector' => '{{WRAPPER}} .blog-area .single-blog img',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_title_style',
            [
                'label' => __('posts Title', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_title_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-title h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_title_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-title h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_title_color',
            [
                'label' => __('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title a h4, {{WRAPPER}} .blog-title h4' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'mgpg_title_bgcolor',
            [
                'label' => __('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title h4' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_descb_radius',
            [
                'label' => __('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blog-title h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_title_typography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .blog-title h4',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'mgpg_description_style',
            [
                'label' => __('Description', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_description_padding',
            [
                'label' => __('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.blog-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'mgpg_description_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.blog-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_color',
            [
                'label' => __('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.blog-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_bgcolor',
            [
                'label' => __('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.blog-desc' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mgpg_description_radius',
            [
                'label' => __('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.blog-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mgpg_description_typography',
                'label' => __('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} p..blog-desc',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'mgpg_meta_style',
            [
                'label' => __('Posts Meta', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mgpg_meta_margin',
            [
                'label' => __('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .date-comment h6,{{WRAPPER}} .date-comment h6 i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_control(
            'mgpg_meta_color',
            [
                'label' => __('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date-comment h6,{{WRAPPER}} .date-comment h6 i' => 'color: {{VALUE}};',
                ],

            ]
        );
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
        $mgpg_filter = $this->get_settings('mgpg_posts_filter');
        $mgpg_posts_count = $this->get_settings('mgpg_posts_count');
        $mgpg_custom_order = $this->get_settings('mgpg_custom_order');
        $mgpg_grid_categories = $this->get_settings('mgpg_grid_categories');
        $orderby = $this->get_settings('orderby');
        $order = $this->get_settings('order');


        // Query Argument
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $mgpg_posts_count,
        );

        switch ($mgpg_filter) {


            case 'featured':
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                break;

            case 'random_order':
                $args['orderby']    = 'rand';
                break;

            case 'show_byid':
                $args['post__in'] = $settings['mgpg_post_id'];
                break;

            case 'show_byid_manually':
                $args['post__in'] = explode(',', $settings['mgpg_post_ids_manually']);
                break;

            default: /* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
                break;
        }

        // Custom Order
        if ($mgpg_custom_order == 'yes') {
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        if (!(($mgpg_filter == "show_byid") || ($mgpg_filter == "show_byid_manually"))) {

            $post_cats = str_replace(' ', '', $mgpg_grid_categories);
            if ("0" != $mgpg_grid_categories) {
                if (is_array($post_cats) && count($post_cats) > 0) {
                    $field_name = is_numeric($post_cats[0]) ? 'term_id' : 'slug';
                    $args['tax_query'][] = array(
                        array(
                            'taxonomy' => 'category',
                            'terms' => $post_cats,
                            'field' => $field_name,
                            'include_children' => false
                        )
                    );
                }
            }
        }



        //grid layout
        $mgpg_rownumber = $this->get_settings('mgpg_rownumber');
        // grid content
        $mgpg_post_img_show = $this->get_settings('mgpg_post_img_show');
        $mgpg_show_title = $this->get_settings('mgpg_show_title');
        $mgpg_crop_title = $this->get_settings('mgpg_crop_title');
        $mgpg_desc_show = $this->get_settings('mgpg_desc_show');
        $mgpg_crop_desc = $this->get_settings('mgpg_crop_desc');
        $mgpg_meta_show = $this->get_settings('mgpg_meta_show');
        $mgpg_post_btnicon = $this->get_settings('mgpg_post_btn_icon');




        $mgpg_posts = new \WP_Query($args);

        if ($mgpg_posts->have_posts()) :
            ?>
            <div class="mgpd blog-area">
                <div class="row" data-masonry='{"percentPosition": true }'>
                    <?php while ($mgpg_posts->have_posts()) : $mgpg_posts->the_post(); ?>
                        <div class="col-lg-<?php echo esc_attr($mgpg_rownumber); ?>">

                            <div class="single-blog clearfix mb-4">
                                <?php if ($mgpg_post_img_show) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail(); ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($mgpg_meta_show) : ?>
                                    <div class="date-comment plr-20 ptb-20 clearfix">
                                        <div class="left floatleft">
                                            <h6 class="capitalize montserrat no-margin weight-regular"><i class="zmdi zmdi-calendar"></i><?php echo get_the_date('F j, Y'); ?></h6>
                                        </div>
                                        <div class="right floatright">
                                            <h6 class="capitalize montserrat no-margin weight-regular"> <i class="zmdi zmdi-comments"></i><?php echo get_comments_number(); ?></h6>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-title">
                                    <?php if ($mgpg_show_title) : ?>
                                        <div class="left"> <a href="<?php the_permalink(); ?>">
                                                <h4 class="capitalize montserrat no-margin weight-regular"> <?php echo wp_trim_words(get_the_title(), $mgpg_crop_title, ' '); ?></h4>
                                            </a></div>
                                    <?php endif; ?>
                                    <?php if ($mgpg_post_btnicon) : ?>
                                        <div class="right"> <a href="=" <?php the_permalink(); ?>"><i class="zmdi zmdi-plus"></i></a></div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($mgpg_desc_show) : ?>
                                    <p class="blog-desc"><?php echo wp_trim_words(get_the_content(), $mgpg_crop_desc, '...'); ?></p>
                                <?php endif; ?>
                            </div>


                        </div>
                    <?php
                    endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        endif;
    }
}