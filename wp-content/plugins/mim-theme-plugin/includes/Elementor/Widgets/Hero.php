<?php
namespace MimTheme\Plugin\Elementor\Widgets;
use MimTheme\Frontend\ThemeFunctions;

class Hero extends \Elementor\Widget_Base
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
        return 'mimhero';
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
        return esc_html__('Mim Hero Section', 'mim-plugin');
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
        return 'eicon-header';
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
        return ['header', 'hero', 'section', 'details', 'mim-plugin'];
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
            'mim_hero_section',
            [
                'label' => esc_html__('Hero Section Details', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'hero_section_id',
            [
                'label' => esc_html__('Section ID', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('hero', 'mim-plugin'),
                'default'     => esc_html__('hero', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'hero_sub_title',
            [
                'label' => esc_html__('Sub Title', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('HELLO, MY NAME IS', 'mim-plugin'),
                'default'     => esc_html__('HELLO, MY NAME IS', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'hero_title',
            [
                'label' => esc_html__('Heading', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('ANDREW JORDAN', 'mim-plugin'),
                'default'     => esc_html__('ANDREW JORDAN', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'hero_description',
            [
                'label' => esc_html__('Description', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder'     => esc_html__('On the other hand, we denounce with righteous indignation and dislike men who are so beguiled demord by.', 'mim-plugin'),
                'default'     => esc_html__('On the other hand, we denounce with righteous indignation and dislike men who are so beguiled demord by.', 'mim-plugin'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_hero_section_button',
            [
                'label' => esc_html__('Hero Section Button', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_btn_label',
            [
                'label' => esc_html__('Hero Button', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label_block'  => true,
                'placeholder' => esc_html__('My Work', 'mim-plugin'),
                'default'     => esc_html__('My Work', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'hero_btn_url',
            [
                'label' => esc_html__( 'Button URL', 'mim-plugin' ),
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

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_hero_section_image',
            [
                'label' => esc_html__('Hero Section Image', 'mim-plugin'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_image_heading',
            [
                'label' => __( 'Hero Section Image', 'devboy-core' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hero_main_image',
            [
                'label' => esc_html__( 'Choose Image', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'hero_main_image_dimensions',
            [
                'label' => esc_html__( 'Image Dimension', 'mim-plugin' ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'mim-plugin' ),
                'default' => [
                    'width' => '419',
                    'height' => '750',
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
            'mim_hero_section_background',
            [
                'label' => esc_html__('Section Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_hero_section_inner_spaces',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-style-1' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'mim_heading_section',
            [
                'label' => esc_html__('Mim Heading Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'mim_sub_heading_style',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Sub Heading', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_sub_heading_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-text h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_sub_heading_typography',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .slider-text h5'
            ]
        );


        $this->add_responsive_control(
            'mim_sub_heading_margin_bottom',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slider-text h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_heading_style',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Heading', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_heading_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-text h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_heading_typgraphy',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .slider-text h1'
            ]
        );

        $this->add_responsive_control(
            'mim_heading_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slider-text h1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mim_description_style',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'mim-plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'mim_description_color',
            [
                'label' => esc_html__('Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-text>p' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_description_typgraphy',
                'label' => esc_html__('Typography', 'mim-plugin'),
                'selector' => '{{WRAPPER}} .slider-text>p'
            ]
        );

        $this->add_responsive_control(
            'mim_description_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slider-text>p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mim_image_style',
            [
                'label' => esc_html__('Image Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_image_style_alignment',
            [
                'label' => esc_html__('Alignment', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'mim-plugin'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'mim-plugin'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'mim-plugin'),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .slider-img' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_image_margin_before',
            [
                'label' => esc_html__('Person Image', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'mim_image_margin',
            [
                'label' => esc_html__('Margin', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slider-img.text-right' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'mim_button_style',
            [
                'label' => esc_html__('Button Styles', 'mim-plugin'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mim_button_padding',
            [
                'label' => esc_html__('Padding', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mim_button_typography',
                'selector' => '{{WRAPPER}} .slider-button .btn'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mim_button_border',
                'selector' => '{{WRAPPER}} .slider-button .btn',
            ]
        );

        $this->add_control(
            'mim_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_button_box_shadow',
                'selector' => '{{WRAPPER}} .slider-button .btn',
            ]
        );
        $this->add_control(
            'mim_button_text_color',
            [
                'label' => esc_html__('Button Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('mim_button_tabs');

        $this->start_controls_tab(
            'mim_button_tab_normal',
            [
                'label' => esc_html__('Normal', 'mim-plugin'),
            ]
        );

        $this->add_control(
            'mim_button_normal_text',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_button_normal_background',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'mim_button_hover_style',
            [
                'label' => esc_html__('Hover', 'mim-plugin'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'mim_button_hover_boxshadow',
                'selector' => '{{WRAPPER}} .slider-button .btn:hover',
            ]
        );

        $this->add_control(
            'mim_button_hover_color',
            [
                'label' => esc_html__('Text Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_button_hover_background_color',
            [
                'label' => esc_html__('Background Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mim_button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'mim-plugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'pxcnt_cfbtn_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-button .btn:hover' => 'border-color: {{VALUE}};',
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


        $section_id =       $this->get_settings('hero_section_id');
        $hero_sub_title =    $this->get_settings('hero_sub_title');
        $hello_title =       $this->get_settings('hero_title');
        $hero_description =      $this->get_settings('hero_description');
        $hero_btn_label =     $this->get_settings('hero_btn_label');
        $hero_main_image = $this->get_settings('hero_main_image');
        $hero_main_image_dimensions = $this->get_settings('hero_main_image_dimensions');
        $background_type =  $this->get_settings('background_type');


        if ( ! empty( $settings['hero_btn_url']['url'] ) ) {
            $this->add_link_attributes( 'hero_btn_url', $settings['hero_btn_url'] );
        }

        

        if ( $themefunctions->Version_Switcher() == 'dark' ) {
            $class_version = 'dark-version bg-color-3';
            $class_two = 'white-color';
            $class_three = 'light-color';
        } else {
            $class_version =  'light-bg';
            $class_two = '';
            $class_three = '';
        }
        
        ?>
        
            <!-- Hero Section Start -->

                <header class="header-style-1 <?php echo esc_attr($class_version); ?>" id="<?php echo esc_html($section_id); ?>">
                    <div class="bottom slider-area">
                        <div class="container">
                            <div class="row relative">
                                <div class="col-xs-12 col-sm-6 static">
                                    <div class="slider-text percent-50">
                                        <h5 class="mb-11"><?php echo esc_html($hero_sub_title); ?></h5>
                                        <h1 class="mb-30"><?php echo esc_html($hello_title); ?></h1>
                                        <p class="font-16 line-height-28">
                                            <?php echo esc_html($hero_description); ?>
                                        </p>
                                        <?php if($hero_btn_label): ?>
                                        <div class="slider-button smooth-scroll mt-40">
                                            
                                                <a class="btn lg-btn" <?php echo $this->get_render_attribute_string( 'hero_btn_url' ); ?>><?php echo esc_html($hero_btn_label); ?></a>
                                            
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="slider-img text-right">
                                        <?php if($hero_main_image): ?>
                                        <img src="<?php echo esc_attr($hero_main_image['url']); ?>" alt="Image Layer" width="<?php echo esc_attr($hero_main_image_dimensions['width']); ?>" height="<?php echo esc_attr($hero_main_image_dimensions['height']) ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            <!-- Hero Section End -->
        <?php
    }
}