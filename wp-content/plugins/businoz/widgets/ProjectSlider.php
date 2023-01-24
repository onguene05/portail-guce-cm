<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class  ProjectSlider extends \Generic\Elements\GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'cust-project-slider';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Project Slider', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/project-slider/';
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'genwow', 'swiper', 'bdevs-elementor-js'];
    }
    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'swiper', 'bdevs-elementor-flaticon', 'bdevs-elementor-css'];
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_keywords()
    {
        return ['slider', 'image', 'gallery', 'project'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {


        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Design Style', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-elementor'),
                    'style_2' => __('Style 2', 'bdevs-elementor'),
                    'style_3' => __('Style 3', 'bdevs-elementor'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 4,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_3'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2', 'style_3'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'back Sub Title',
                'placeholder' => __('back Sub Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __('H1', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => __('H2', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => __('H3', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => __('H4', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => __('H5', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => __('H6', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-elementor'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();


        // Project Slider List
        $this->start_controls_section(
            '_section_project_list',
            [
                'label' => __('Project Slider List', 'bdevs-element'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                    'style_2' => __('Style 2', 'bdevs-element'),
                    'style_3' => __('Style 3', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'project_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Project Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-element'),
                'default' => __('Title', 'bdevs-element'),
                'placeholder' => __('Type title here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Button text', 'bdevs-element'),
                'default' => __('Button text', 'bdevs-element'),
                'placeholder' => __('Type Button text here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_3']
                ],
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Button URL', 'bdevs-element'),
                'default' => __('#', 'bdevs-element'),
                'placeholder' => __('Type Button url here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_3']
                ],
            ]
        );

        $repeater->add_control(
            'title_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title URL', 'bdevs-element'),
                'default' => __('Title URL', 'bdevs-element'),
                'placeholder' => __('Type title url here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2']
                ],
            ]
        );

        $repeater->add_control(
            'slider_sub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Sub Title', 'bdevs-element'),
                'default' => __('Sub Title', 'bdevs-element'),
                'placeholder' => __('Type sub title here', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2']
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->end_controls_section();

   // Category Color
        $this->start_controls_section(
            '_section_text_overlay2',
            [
                'label' => __( 'Category Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ],

                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay2' );

         $this->start_controls_tab(
            'tab_background_category_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgroundcat',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-skill__content span',
            ]
        );

        $this->add_control(
            'background_button_overlay_opacity',
            [
                'label' => __( 'Opacity', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-background-overlay .bd-skill__content span' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __('Animation Speed', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __('Slide speed in milliseconds', 'bdevs-elementor'),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay?', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __('Autoplay speed in milliseconds', 'bdevs-elementor'),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop?', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vertical',
            [
                'label' => __('Vertical Mode?', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __('Navigation', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => __('None', 'bdevs-elementor'),
                    'arrow' => __('Arrow', 'bdevs-elementor'),
                    'dots' => __('Dots', 'bdevs-elementor'),
                    'both' => __('Arrow & Dots', 'bdevs-elementor'),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Title / Content', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Description', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (empty($settings['slides'])) {
            return;
        }


?>
        <?php if ($settings['design_style'] === 'style_3') :

            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title-4 s-2 mb-15 bdevs-el-title');
        ?>
            <section class="bd-portfolio__area blue-bg fix pt-115 pb-120 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="bnd-portfolio-2-main p-relative">
                        <div class="bd-section-title-4 mb-50">
                            <?php if ($settings['sub_title']) : ?>
                                <h6 class="bd-small__title-4 mb-15"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                            <?php endif; ?>
                            <?php if ($settings['title']) :
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    wp_kses_post($settings['title'])
                                );
                            endif; ?>
                        </div>

                        <div class="col-xl-10">
                            <div class="bd-portfolio__active-2 swiper-container">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($settings['slides'] as $key => $slide) :
                                        if (!empty($slide['project_image']['id'])) {
                                            $project_image = wp_get_attachment_image_url($slide['project_image']['id'], 'full');
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="bd-portfolio__item p-relative">
                                                <?php if (!empty($project_image)) : ?>
                                                    <div class="bd-portfolio__img w-img">
                                                        <img src="<?php print esc_url($slide['project_image']['url']); ?>" alt="portfolio-1.png">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="bd-portfolio__text">
                                                    <div class="bd-Portfolio__inner">
                                                        <?php if (!empty($slide['title'])) : ?>
                                                            <h5><?php echo wp_kses_post($slide['title']); ?></h5>
                                                        <?php endif; ?>

                                                        <?php if (!empty($slide['button_text'])) : ?>
                                                            <span><a href="<?php echo esc_url($slide['button_url']); ?>"><?php echo wp_kses_post($slide['button_text']); ?></a></span>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="bd-portfolio-2-nav">
                            <button class="portfolio-2-button-prev"><i class="far fa-long-arrow-left"></i></button>
                            <button class="portfolio-2-button-next"><i class="far fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['design_style'] === 'style_2') : ?>
            <section class="wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="bd-skill__slider__areaa fix">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="bd-skill__wrapper">
                                    <div class="bd-skill__active swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($settings['slides'] as $key => $slide) :
                                                if (!empty($slide['project_image']['id'])) {
                                                    $project_image = wp_get_attachment_image_url($slide['project_image']['id'], 'full');
                                                }
                                            ?>
                                                <div class="swiper-slide">
                                                    <div class="bd-skill-item p-relative">
                                                        <?php if (!empty($project_image)) : ?>
                                                            <div class="bd-skill__thumb w-img">
                                                                <img src="<?php print esc_url($slide['project_image']['url']); ?>" alt="skill-img-1.png">
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="bd-skill__content">
                                                            <span><?php echo wp_kses_post($slide['slider_sub_title']); ?></span>
                                                            <?php if (!empty($slide['title'])) : ?>
                                                                <h3><a href="<?php echo esc_url($slide['title_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a></h3>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php else : ?>
            <section class="bd-portfolio__area fix p-relative pt-120 pb-120  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <?php if ($settings['back_title']) : ?>
                                <span class="bd-stroke__title s-4"><?php echo wp_kses_post($settings['back_title']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row  justify-content-center">
                    <div class="col-xxl-11">
                        <div class="bd-portfolio__wrapper p-relative">
                            <div class="bd-portfolio__active swiper-container">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($settings['slides'] as $key => $slide) :
                                        if (!empty($slide['project_image']['id'])) {
                                            $project_image = wp_get_attachment_image_url($slide['project_image']['id'], 'full');
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="bd-portfolio__item">
                                                <?php if (!empty($project_image)) : ?>
                                                    <div class="bd-portfolio__thumb w-img">
                                                        <img src="<?php print esc_url($slide['project_image']['url']); ?>" alt="portfolio-img">
                                                    </div>
                                                <?php endif; ?>


                                                <div class="bd-portfolio__content">
                                                    <div class="bd-portfolio__inner">
                                                        <span class="bdevs-el-subtitle"><?php echo wp_kses_post($slide['slider_sub_title']); ?></span>
                                                        <?php if (!empty($slide['title'])) : ?>
                                                            <h3 class="bdevs-el-title"><a href="<?php echo esc_url($slide['title_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a></h3>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="bd-portfolio__link">
                                                        <a href="<?php echo esc_url($slide['title_url']); ?>"><i class="fal fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
<?php
    }
}
