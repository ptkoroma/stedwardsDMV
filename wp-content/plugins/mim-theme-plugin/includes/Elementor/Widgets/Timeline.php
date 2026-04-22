<?php
namespace MimTheme\Plugin\Elementor\Widgets;

class Timeline extends \Elementor\Widget_Base
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
        return 'mimtimeline';
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
        return esc_html__('Mim Timeline Section', 'mim-plugin');
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
        return 'eicon-time-line';
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
        return ['time-line', 'timeline', 'time line', 'details', 'mim-plugin'];
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
            'mim_timeline_section',
            [
                'label' => esc_html__('Timeline Section Details', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'timeline_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('timeline', 'mim-plugin'),
                'default'     => esc_html__('timeline', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'timeline_section_title',
            [
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('Timeline', 'mim-plugin'),
                'default'     => esc_html__('Timeline', 'mim-plugin'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_timeline_items',
            [
                'label' => esc_html__('Timeline Items', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'timeline_item_heading',
            [
                'label' => __( 'Items', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'mim_timeline_title', [
                'label' => esc_html__( 'Timeline Title', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Behance' , 'mim-plugin' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mim_timeline_subheading', [
                'label' => esc_html__( 'Timeline Sub-heading', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Timeline Sub-heading' , 'mim-plugin' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'mim_timeline_description', [
                'label' => esc_html__( 'Timeline Description', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur itaque non aspernatur sapiente, culpa, enim nisi minus voluptas! Non, tempora iusto sapiente aliquid eligendi.' , 'mim-plugin' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'timeline_item_list',
            [
                'label' => esc_html__( 'Timeline Items', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'mim_timeline_title' => esc_html__( 'Timeline Title', 'mim-plugin' ),
                        'mim_timeline_subheading' => esc_html__( 'Timeline Sub-heading', 'mim-plugin' ),
                        'mim_timeline_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur itaque non aspernatur sapiente, culpa, enim nisi minus voluptas! Non, tempora iusto sapiente aliquid eligendi.', 'mim-plugin' ),
                    ],
                    [
                        'mim_timeline_title' => esc_html__( 'Timeline Title', 'mim-plugin' ),
                        'mim_timeline_subheading' => esc_html__( 'Timeline Sub-heading', 'mim-plugin' ),
                        'mim_timeline_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur itaque non aspernatur sapiente, culpa, enim nisi minus voluptas! Non, tempora iusto sapiente aliquid eligendi.', 'mim-plugin' ),
                    ],
                    [
                        'mim_timeline_title' => esc_html__( 'Timeline Title', 'mim-plugin' ),
                        'mim_timeline_subheading' => esc_html__( 'Timeline Sub-heading', 'mim-plugin' ),
                        'mim_timeline_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur itaque non aspernatur sapiente, culpa, enim nisi minus voluptas! Non, tempora iusto sapiente aliquid eligendi.', 'mim-plugin' ),
                    ],
                    [
                        'mim_timeline_title' => esc_html__( 'Timeline Title', 'mim-plugin' ),
                        'mim_timeline_subheading' => esc_html__( 'Timeline Sub-heading', 'mim-plugin' ),
                        'mim_timeline_description' => esc_html__( 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis consectetur itaque non aspernatur sapiente, culpa, enim nisi minus voluptas! Non, tempora iusto sapiente aliquid eligendi.', 'mim-plugin' ),
                    ],
                ],
                'mim_timeline_title' => '{{{ mim_timeline_title }}}',
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
            'mim_timeline_section_styles',
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
                    '{{WRAPPER}} .experience-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_pricing_section_background_color',
            [
                'label' => esc_html__('Background', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .experience-area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_timeline_section_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Section Title', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'mim_timeline_section_title_color',
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
                'name' => 'mim_timeline_section_title_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .section-title h2',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'mim_timeline_section_title_below_border',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Border', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_timeline_section_title_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .horizontal-line div' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_timeline_section_item_styles',
            [
                'label' => esc_html__('Item Content', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'mim_timeline_section_item_background',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-content .timeline-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_heading_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Heading', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'mim_timeline_section_item_heading',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-text>h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_timeline_section_item_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .timeline-text>h3',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_sub_heading_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Sub-heading', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'mim_timeline_section_item_sub_heading_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-text>h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_timeline_section_item_sub_heading_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .timeline-text>h4',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_description_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'mim-plugin'),
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'mim_timeline_section_item_description_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-text>p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_timeline_section_item_description_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .timeline-text>p',
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_2
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_timeline_section_item_element_style',
            [
                'label' => esc_html__('Elements', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_before_dot_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Item Before Dot', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_before_dot_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sin-timeline::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_after_border_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Item After Border', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_after_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sin-timeline:nth-child(2n+1) .timeline-content .timeline-text' => 'border-right: 4px solid {{VALUE}};',
                    '{{WRAPPER}} .sin-timeline:nth-child(2n) .timeline-content .timeline-text' => 'border-left: 4px solid {{VALUE}};',
                    '{{WRAPPER}} .timeline-text::before' => 'border-color: transparent transparent transparent {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_center_border_color_before',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Item Center Border', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_timeline_section_item_center_border_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline-wraper::before' => 'background:{{VALUE}} none repeat scroll 0 0;',
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
        $settings = $this->get_settings_for_display();


        $section_id =       $this->get_settings('timeline_section_id');
        $timeline_section_title =    $this->get_settings('timeline_section_title');
        $timeline_item_list =       $this->get_settings('timeline_item_list');


?>
        
        <!-- Timeline Section Start -->

        <div class="experience-area background-1 ptb-120 section-padding" id="<?php echo esc_attr($section_id); ?>">
            <div class="container">
                
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title text-center mb-60">
                                <h2 class="mb-20">
                                    <?php echo esc_html__($timeline_section_title); ?>
                                </h2>
                                <div class="horizontal-line">
                                    <div class="top"></div>
                                    <div class="bottom"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="timeline-wraper">

                        <?php foreach($timeline_item_list as $timeline_item): ?>
                        
                        <div class="sin-timeline col-sm-12 col-md-6 col-lg-6">
                            <div class="timeline-content timeline-xs">
                                <div class="timeline-text white-bg">
                                        <h3><?php echo esc_html__($timeline_item['mim_timeline_title']); ?></h3>
                                    
                                        <h4><?php echo esc_html__($timeline_item['mim_timeline_subheading']); ?></h4>
                                    
                                        <p>
                                            <?php echo wp_kses_post($timeline_item['mim_timeline_description']); ?>
                                        </p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Timeline Section End -->
        <?php
    }
}