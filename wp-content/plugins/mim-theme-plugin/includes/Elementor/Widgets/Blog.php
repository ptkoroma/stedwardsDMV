<?php
namespace MimTheme\Plugin\Elementor\Widgets;

use MimTheme\Plugin\Admin\Mim_Functions;
use MimTheme\Frontend\ThemeFunctions;



class Blog extends \Elementor\Widget_Base
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
        return 'mimblog';
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
        return esc_html__('Mim Blog Posts', 'mim-plugin');
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
        return ['blog', 'posts', 'info', 'details', 'mim-plugin'];
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
            'mim_blog_section',
            [
                'label' => esc_html__('Blog Section', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'blog_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('blog', 'mim-plugin'),
                'default'     => esc_html__('blog', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'blog_section_title',
            [
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('Blog Posts', 'mim-plugin'),
                'default'     => esc_html__('Blog Posts', 'mim-plugin'),
            ]
        );

       
        $this->end_controls_section();

        $this->start_controls_section(
            'mim_blog_query',
            [
                'label' => esc_html__('Posts Query', 'mim-plugin'),
            ]
        );

        // Post Filter
        $this->add_control(
            'mim_post_filter_heading',
            [
                'label' => __( 'Post Filter', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'mim_posts_filter',
            [
                'label' => esc_html__('Filter By', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => esc_html__('Recent Posts', 'mim-plugin'),
                    //'featured' => esc_html__( 'Popular Posts', 'mim-plugin' ),
                    'random_order' => esc_html__('Random Posts', 'mim-plugin'),
                    'show_byid' => esc_html__('Show By Id', 'mim-plugin'),
                    'show_byid_manually' => esc_html__('Add ID Manually', 'mim-plugin'),
                ],
            ]
        );

        $this->add_control(
            'mim_post_id',
            [
                'label' => __('Select posts', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $Mim_Functions->Mim_Post_Name(),
                'condition' => [
                    'mim_posts_filter' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mim_post_ids_manually',
            [
                'label' => esc_html__('Posts IDs', 'mim-plugin'),
                'description' => esc_html__('Separate IDs with commas', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [
                    'mim_posts_filter' => 'show_byid_manually',
                ]
            ]
        );

        // Post Category
        $this->add_control(
            'mim_post_category',
            [
                'label' => __( 'Post Category', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'mim_posts_filter!' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mim_select_categories',
            [
                'label' => esc_html__('Post Categories', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $Mim_Functions->Display_Taxonomy_List(), 
                'condition' => [
                    'mim_posts_filter!' => 'show_byid',
                ]
            ]
        );

        $this->add_control(
            'mim_post_post_limit',
            [
                'label' => __( 'Posts Limit', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'mim_posts_count',
            [
                'label'   => __('Posts to Display', 'mim-plugin'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'step'    => 1,
            ]
        );


        // Post Order
        $this->add_control(
            'mim_post_custom_order',
            [
                'label' => __( 'Custom Order', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'mim_custom_order',
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
                    'mim_custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending', 'mim-plugin'),
                    'ASC'   => esc_html__('Ascending', 'mim-plugin'),
                ],
                'condition' => [
                    'mim_custom_order' => 'yes',
                ]
            ]
        );


        $this->end_controls_section();

        // Post Layouts

        $this->start_controls_section(
            'mim_layout',
            [
                'label' => esc_html__('Grid Layout', 'mim-plugin'),
            ]
        );
        
        $this->add_control(
            'mim_rownumber',
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

        // Content Settings
        $this->start_controls_section(
            'mim_content',
            [
                'label' => esc_html__('Content Settings', 'mim-plugin'),
            ]
        );


        $this->add_control(
            'mim_post_img_show',
            [
                'label'     => __('Show Posts image', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'mim_show_title',
            [
                'label'     => __('Show posts Title', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
       
        $this->add_control(
            'mim_title_tag',
            [
                'label' => __('Title HTML Tag', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h4',
                'condition' => [
                    'mim_show_title' => 'yes',
                ]

            ]
        );


        $this->end_controls_section();


        // Post Meta Settings

        $this->start_controls_section(
            'mim_meta_section',
            [
                'label' => __('Posts Meta', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'default' => '',
            ]
        );
        $this->add_control(
            'mim_date_show',
            [
                'label'     => __('Show Date', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

            ]
        );
        
        $this->add_control(
            'mim_comments_show',
            [
                'label'     => __('Show Comments', 'mim-plugin'),
                'type'      => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',

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
            'mim_blog_section_styles',
            [
                'label' => esc_html__('Blog Section', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'mim_blog_section_background_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Background', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_blog_section_background_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'mim_blog_section_spacing_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Spacing', 'mim-plugin'),
                'separator' => 'before'
            ]
        );


        $this->add_responsive_control(
            'mim_blog_section_padding',
            [
                'label' => esc_html__('Section Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_section_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mim_blog_section_title_margin',
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
            'mim_blog_section_title_color',
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
                'name' => 'mim_blog_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
            ]
        );

        $this->end_controls_section();

        // Border Top Styles

        $this->start_controls_section(
            'mim_blog_section_seprator_section',
            [
                'label' => esc_html__('Separator', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_blog_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Top', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_blog_section_title_border_top_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.top' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_section_title_border_top_height',
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
            'mim_blog_section_title_border_top_width',
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
            'mim_blog_section_title_border_top_margin',
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
            'mim_blog_section_title_border_top_bottom_margin',
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
            'mim_blog_section_title_border_top_border_radius',
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
            'mim_blog_section_title_below_down_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border Bottom', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_blog_section_title_border_bottom_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div.bottom' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_section_title_border_bottom_height',
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
            'mim_blog_section_title_border_bottom_width',
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
            'mim_blog_section_title_border_bottom_margin',
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
            'mim_blog_section_title_border_bottom_bottom_margin',
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
            'mim_blog_section_title_border_bottom_border_radius',
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
            'mim_content_settings',
            [
                'label' => esc_html__('Content Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_blog_post_content_section_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Content Section', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'mim_blog_post_content_section_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .single-blog' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_post_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Post Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'mim_blog_post_title_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_blog_post_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .blog-title h4',
            ]
        );  

        $this->add_control(
            'mim_blog_post_plus_icon',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Plus Icon', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs('mim_blog_post_icontabs');
        $this->start_controls_tab(
            'mim_blog_post_icon_tab_normal',
            [
                'label' => __('Normal', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_blog_post_plus_icon_color',
            [
                'label' => esc_html__('Normal Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .right.floatright a i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_post_plus_icon_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title .right a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_blog_post_plus_icon_hover',
            [
                'label' => __('Hover', 'magical-addons-for-elementor'),
            ]
        );

        $this->add_control(
            'mim_blog_post_plus_icon_hover_color',
            [
                'label' => esc_html__('Hover Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .right.floatright a i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_post_plus_icon_hover_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-title .right a:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_blog_section_meta_section',
            [
                'label' => esc_html__('Meta Style', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_blog_meta_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .single-blog .date-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_post_meta_icon_color',
            [
                'label' => esc_html__('Icon Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .left.floatleft i, .right.floatright i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_blog_post_meta_text_color',
            [
                'label' => esc_html__('Meta Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date-comment h6' => 'color: {{VALUE}};',
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
        $section_id =       $this->get_settings('blog_section_id');
        $blog_post_section_title =       $this->get_settings('blog_section_title');
        $blog_post_selected_items =       $this->get_settings('blog_post_selected_items');
        $background_type =       $this->get_settings('background_type');
        $mim_filter = $this->get_settings('mim_posts_filter');
        $mim_posts_count = $this->get_settings('mim_posts_count');
        $mim_custom_order = $this->get_settings('mim_custom_order');
        $mim_select_categories = $this->get_settings('mim_select_categories');
        $orderby = $this->get_settings('orderby');
        $order = $this->get_settings('order');

        // Query Argument
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $mim_posts_count,
        );

        // Post Filter

        switch ($mim_filter) {

            // case 'featured':
            //     $args['tax_query'][] = array(
            //         'taxonomy' => 'post_visibility',
            //         'field'    => 'name',
            //         'terms'    => 'featured',
            //         'operator' => 'IN',
            //     );
            //     break;

            case 'random_order':
                $args['orderby']    = 'rand';
                break;

            case 'show_byid':
                $args['post__in'] = $settings['mim_post_id'];
                break;

            case 'show_byid_manually':
                $args['post__in'] = explode(',', $settings['mim_post_ids_manually']);
                break;

            default: /* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
                break;
        }

        // Custom Order
        if ($mim_custom_order == 'yes') {
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        if (!(($mim_filter == "show_byid") || ($mim_filter == "show_byid_manually"))) {

            $post_cats = str_replace(' ', '', $mim_select_categories);
            if ("0" != $mim_select_categories) {
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
        $mim_post_style = $this->get_settings('mim_post_style');
        $mim_rownumber = $this->get_settings('mim_rownumber');
        // grid content
        $mim_post_img_show = $this->get_settings('mim_post_img_show');
        $mim_show_title = $this->get_settings('mim_show_title');
        $mim_title_tag = $this->get_settings('mim_title_tag');

        // Show Meta
        $mim_date_show = $this->get_settings('mim_date_show');
        $mim_comments_show = $this->get_settings('mim_comments_show');


        if ( $themefunctions->Version_Switcher() == 'dark') {
            $class_version = ($background_type == 'blog-light') ? 'dark-version bg-color-3' : 'dark-version dark-bg';
            $class_two = 'white-color';
        } else {
            $class_version = ($background_type == 'blog-light') ? 'light-bg' : 'bg-color-1';
            $class_two = '';
        }


        $mim_posts = new \WP_Query($args);

        if ($mim_posts->have_posts()) :
?>

    <!-- Blog Section Start -->
        <section class="blog-area section-padding <?php echo esc_attr($class_version); ?>" id="<?php echo esc_attr($section_id); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="section-title text-center mb-60">
                            <h2 class="mb-20"><?php echo wp_kses_post($blog_post_section_title); ?></h2>
                            <div class="horizontal-line">
                                <div class="top"></div>
                                <div class="bottom"></div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="row">

                    <?php 
                        while ($mim_posts->have_posts()) : $mim_posts->the_post(); 
                        $categories = get_the_category();
                        $mgp_tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'mim-plugin'));

                    ?>
                    <div class="col-sm-<?php echo esc_attr($mim_rownumber); ?>">
                        <div class="single-blog clearfix">
                            <?php if (has_post_thumbnail() && $mim_post_img_show == 'yes') : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                            <?php endif; ?>
                            <div class="date-comment plr-20 ptb-20 clearfix">
                                <div class="left floatleft">
                                    <?php if($mim_date_show): ?>
                                    <h6 class="capitalize montserrat no-margin weight-regular"><i class="zmdi zmdi-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></h6>
                                    <?php endif; ?>
                                </div>
                                <div class="right floatright">
                                    <?php if($mim_comments_show): ?>
                                    <h6 class="capitalize montserrat no-margin weight-regular"><i class="zmdi zmdi-comments"></i> <?php comments_number( 'no responses', 'one response', '% responses' ); ?></h6>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="blog-title clearfix">
                                <div class="left floatleft">
                                    <?php if ($mim_show_title) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <<?php echo esc_html__($mim_title_tag); ?> class="capitalize montserrat no-margin weight-regular"><?php the_title(); ?></<?php echo esc_html__($mim_title_tag); ?>>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="right floatright">
                                    <a href="<?php the_permalink(); ?>"><i class="zmdi zmdi-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <!-- Blog Section End -->
<?php
    endif;

    }
}