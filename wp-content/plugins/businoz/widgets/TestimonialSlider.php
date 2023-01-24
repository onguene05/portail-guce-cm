<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class TestimonialSlider extends \Generic\Elements\GenericWidget
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
        return 'cust-testimonial-slider';
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
        return __('Testimonial Slider', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/testimonial-slider/';
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
        return 'eicon-slider-full-screen gen-icon';
    }

    public function get_keywords()
    {
        return ['slider', 'testimonial', 'gallery', 'carousel'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {

        $this->design_style();
        $this->title_and_desc();
        $this->test_image();
        $this->test_slide();
        $this->test_settings();
    }

    public function design_style()
    {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __('Presets', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'designs',
            [
                'label' => __('Designs', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'design_1' => __('Design 1', 'bdevs-elementor'),
                    'design_2' => __('Design 2', 'bdevs-elementor'),
                    'design_3' => __('Design 3', 'bdevs-elementor'),
                    'design_4' => __('Design 4', 'bdevs-elementor'),
                    'design_5' => __('Design 5', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape SWITCHER', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    public function title_and_desc()
    {

        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Sub title', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1', 'design_3', 'design_5'],
                ],
            ]
        );


        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Back Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Back Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_3'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
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
    }

    public function test_image()
    {
        // Images
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Bg Image', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();
    }



    public function test_slide()
    {

        // Slides
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Slides', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-elementor'),
                    'style_2' => __('Style 2', 'bdevs-elementor'),
                    'style_3' => __('Style 3', 'bdevs-elementor'),
                    'style_4' => __('Style 4', 'bdevs-elementor'),
                    'style_5' => __('Style 5', 'bdevs-elementor'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __('Information', 'bdevs-elementor'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('profile Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_3', 'style_5'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'signature_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Signature Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_10'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slide_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Slide Title', 'bdevs-elementor'),
                'condition' => [
                    'field_condition' => ['style_10'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'course_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Course Title', 'bdevs-elementor'),
                'condition' => [
                    'field_condition' => ['style_20'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'slide_url',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Slider URL', 'bdevs-elementor'),
                'condition' => [
                    'field_condition' => ['style_2',],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'course_subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Course Sub Title', 'bdevs-elementor'),
                'condition' => [
                    'field_condition' => ['style_20'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'message',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'default' => __('BDevs Discriptions', 'bdevs-elementor'),
                'placeholder' => __('Discription ', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'default' => __('BDevs Client Name', 'bdevs-elementor'),
                'placeholder' => __('Client Name', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation_name',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'default' => __('BDevs Client Designation', 'bdevs-elementor'),
                'placeholder' => __('Designation Name', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $repeater->add_control(
            'nav_bg_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Nav BG Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_4'],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'bdevs-elementor'),
                'condition' => [
                    'field_condition' => ['style_2'],
                ],
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __('Show Options?', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'bdevs-elementor'),
                'label_off' => __('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'social_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __('Social Title', 'bdevs-elementor'),
                'default' => __('Follow', 'bdevs-elementor'),
                'placeholder' => __('Type Social title here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'bdevs-elementor'),
                'placeholder' => __('Add your profile link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Email', 'bdevs-elementor'),
                'placeholder' => __('Add your email link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Phone', 'bdevs-elementor'),
                'placeholder' => __('Add your phone link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Facebook', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Add your facebook link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Twitter', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Add your twitter link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Instagram', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Add your instagram link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('LinkedIn', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Add your linkedin link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Youtube', 'bdevs-elementor'),
                'placeholder' => __('Add your youtube link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Google Plus', 'bdevs-elementor'),
                'placeholder' => __('Add your Google Plus link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Flickr', 'bdevs-elementor'),
                'placeholder' => __('Add your flickr link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Vimeo', 'bdevs-elementor'),
                'placeholder' => __('Add your vimeo link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Behance', 'bdevs-elementor'),
                'placeholder' => __('Add your hehance link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Dribbble', 'bdevs-elementor'),
                'placeholder' => __('Add your dribbble link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Pinterest', 'bdevs-elementor'),
                'placeholder' => __('Add your pinterest link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Github', 'bdevs-elementor'),
                'placeholder' => __('Add your github link', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(client_name || "Carousel Item"); #>',
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
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }


    public function test_settings()
    {

        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__('Autoplay', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
                'label' => esc_html__('Slider Speed', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'placeholder' => esc_html__('Enter Slider Speed', 'bdevs-elementor'),
                'default' => '5000',
                // 'default' => 5000,
                'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
        );

        $this->add_control(
            'ts_slider_nav_show',
            [
                'label' => esc_html__('Nav show', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'ts_slider_dot_nav_show',
            [
                'label' => esc_html__('Dot nav', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'bdevs-elementor'),
                'label_off' => esc_html__('No', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->title_style_controls();
        $this->description_style_controls();
        $this->review_title_style_controls();
    }

    protected function title_style_controls()
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
                    '{{WRAPPER}} .bdevs-el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
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
    }

    // Description Control
    protected function description_style_controls()
    {

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
    }

    // Review Style Control
    protected function review_title_style_controls()
    {

        // Testimoniyal
        $this->add_control(
            '_testimoniyal_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Testimonial Author Name', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control(
            'testimonial_author_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-test' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'test_title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'default' => __('BDevs  Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-test' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'test_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-test',
            ]
        );

        $this->add_control(
            'testimonial_sub_title ',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Testimonial Sub Title', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );


        $this->add_control(
            'test_sub_title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-sub_test' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'test_sub_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-sub_test',
            ]
        );

        $this->add_control(
            'testimonial_dis_title ',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Testimonial Discription', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );


        $this->add_control(
            'test_dis_title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-discription_test' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'test_discription_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-discription_test',
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

        <?php if ($settings['designs'] == 'design_5') :
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title-3 medium text-white bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }
        ?>

            <section class="bd-testimoonial__area black-bg p-relative z-index-11 pt-120 pb-90">
                <div class="testimonial-bg-3 w-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/testimonial-pattern.png" alt="testimonial-pattern">
                </div>
                <div class="container">
                    <div class="row wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                        <div class="bd__testimonial-info p-relative">
                            <div class="bd-section__title-3 mb-35 ">
                                <?php if ($settings['sub_title']) : ?>
                                    <h6 class="bd-small__title-3 green-color bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                <?php endif; ?>
                                <?php if ($settings['title']) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        wp_kses_post($settings['title'])
                                    );
                                endif;
                                ?>
                                <!-- If we need navigation buttons -->
                                <div class="bd-testimomial-nav">
                                    <div class="testimomial-button-prev"><i class="far fa-long-arrow-left"></i></div>
                                    <div class="testimomial-button-next"><i class="far fa-long-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                        <div class="bd-testimonial-two-active swiper-container">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['slides'] as $slide) :
                                    if (!empty($slide['image']['id'])) {
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                    }
                                ?>
                                    <div class="swiper-slide">
                                        <div class="bd-testimonial-items mb-30">
                                            <div class="bd-tetimonial-contant-3">
                                                <?php if (!empty($slide['message'])) : ?>
                                                    <p class="bdevs-el-discription_test"><?php echo wp_kses_post($slide['message']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="bd-testimonial-author-3">
                                                <?php if (!empty($slide['image']['url'])) : ?>
                                                    <div class="bd-testimomial-image">
                                                        <img src="<?php print esc_url($slide['image']['url']); ?>" alt="author-img">
                                                    </div>
                                                <?php endif; ?>

                                                <div class="bd-testimonial-title-3">
                                                    <?php if (!empty($slide['client_name'])) : ?>
                                                        <h4 class="bdevs-el-test"><?php echo wp_kses_post($slide['client_name']); ?></h4>
                                                    <?php endif; ?>
                                                    <?php if (!empty($slide['designation_name'])) : ?>
                                                        <span class="bdevs-el-sub_test"><?php echo wp_kses_post($slide['designation_name']); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['designs'] == 'design_4') : ?>

            <!-- testimonial area start -->
            <div class="testimonial-area testimonial-bg-settings p-rel testimonial-area-spacing">
                <div class="container p-rel">
                    <div class="row justify-content-center">
                        <div class="col-xxl-8">
                            <div class="lv-testimonial-slide-box-wrap p-rel">
                                <div class="testimonial-active swiper-container mb-30 mb-md-0" id="active-testimonial-grub">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['slides'] as $slide) :
                                            if (!empty($slide['image']['id'])) {
                                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="lv-testimonial-box">
                                                    <?php if (!empty($image)) : ?>
                                                        <div class="lv-testimonial-img text-center">
                                                            <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img">
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if ($slide['message']) : ?>
                                                        <div class="lv-testimonial-content bdevs-el-content mb-25">
                                                            <p><?php echo wp_kses_post($slide['message']); ?></p>

                                                            <?php if ($settings['shape_switch']) : ?>
                                                                <div class="lv-testimonial-bg-img-pos">
                                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/path/testimonial-path-1.png" alt="img">
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <div class="lv-testimonial-author-box text-center">
                                                        <?php if ($slide['client_name']) : ?>
                                                            <h5 class="lv-testimonial-author-name bdevs-el-title">
                                                                <?php echo wp_kses_post($slide['client_name']); ?>
                                                            </h5>
                                                        <?php endif; ?>
                                                        <?php if ($slide['date']) : ?>
                                                            <span class="lv-testimonial-author-date bdevs-el-subtitle">
                                                                <?php echo wp_kses_post($slide['date']); ?>
                                                            </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="lv-testimonial-pagination-nav-wrap lv-common-pagination text-center">
                                    <div class="swiper-button-prev-2 lv-common-pagination-prev-nav"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/path/testimonial-arrow-prev.png" alt="img"></div>
                                    <div class="testimonial-paginations-2 lv-common-pagination-dots"></div>
                                    <div class="swiper-button-next-2 lv-common-pagination-next-nav"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/path/testimonial-arrow-next.png" alt="img"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- testimonial area end -->

        <?php elseif ($settings['designs'] == 'design_3') :

            $settings = $this->get_settings_for_display();
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title white mb-55 bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

        ?>

            <!-- Testimonial-area-start -->
            <section class="bd-testimonial__area theme-bg p-relative pt-120 pb-90 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <?php if (!empty($image)) : ?>
                    <div class="bd-testimonial__left-img">
                        <div class="bd-testimonial__img" data-background="<?php echo esc_url($image); ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="bd-testimomial__shape">
                    <div class="bd-testimomial__icon">
                        <i class="fal fa-quote-right"></i>
                    </div>
                </div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-5"></div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="bd-testimonial__main mb-30">
                                <div class="bd-section__title p-relative z-index-11 mb-45">
                                    <?php if ($settings['back_title']) : ?>
                                        <span class="bd-stroke__title s-3"><?php echo wp_kses_post($settings['back_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if ($settings['sub_title']) : ?>
                                        <strong class="bd-small__title s-2 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></strong>
                                    <?php endif; ?>

                                    <?php if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                </div>

                                <div class="bd-testimonial__slide swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['slides'] as $slide) :
                                            if (!empty($slide['image']['id'])) {
                                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="bd-testimonial__content p-relative z-index-11">
                                                    <?php if ($slide['message']) : ?>
                                                        <p class="testimonial-title__paraghrap">
                                                            <?php echo wp_kses_post($slide['message']); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                    <div class="bd-testimonial__author p-relative">
                                                        <div class="bd-testimopnial__inner">
                                                            <?php if ($slide['image']) : ?>
                                                                <div class="bd-author__img">
                                                                    <img src="<?php print esc_url($slide['image']['url']); ?>" alt="author-1">
                                                                </div>
                                                            <?php endif; ?>

                                                            <div class="bd-author__text">
                                                                <?php if ($slide['client_name']) : ?>
                                                                    <h3 class="bdevs-el-test"><?php echo wp_kses_post($slide['client_name']); ?></h3>
                                                                <?php endif; ?>

                                                                <?php if ($slide['designation_name']) : ?>
                                                                    <span class="bdevs-el-sub_test"><?php echo wp_kses_post($slide['designation_name']); ?></span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="bd-author__icon">
                                                                <i class="fal fa-quote-right"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bd-testimonial__quite">
                                                        <i class="fal fa-quote-right"></i>
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
            </section>
            <!-- Testimonial-area-end -->


        <?php elseif ($settings['designs'] == 'design_2') :
            $settings = $this->get_settings_for_display();
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'testimonial__title bdevs-el-title');

        ?>

            <section class="bd-testimonial__area-3 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="testimoniaal__slide-3 swiper-container">
                                <div class="swiper-wrapper">
                                    <?php foreach ($settings['slides'] as $slide) :
                                        if (!empty($slide['image']['id'])) {
                                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                        }
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="bd-testimonial__item mb-120 ">
                                                <div class="bd-testomonial__icon text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26px" height="20px">
                                                        <image x="0px" y="0px" width="26px" height="20px" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAUCAQAAAA5SeU1AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElNRQfmBQwOGyAWOaSvAAABCklEQVQ4y+2NPS+DYRiFr75e9bFgFNKpA8YOwmb2N4hBIkZDExubzcRiNJuoaISkk9HUpIuPRKKkNNKhksvwUu2TtoPZuZfzXOc59420ZsoNiz5aN99GfyZy2SPL1nyISRSzRZ4RylxR5YZQS+yRo06JIi/JljEL6qmLprrcwHW16poTyRtxyHN1s+t3xBX1zMlfgrirrvaszNn02uF2hlmbHves4IkfZjoZ7qvZnpVZdSekeO9lnzvb6kxII6Yp0Vs5nqmEMGWNN55ItTMOOPz2Fyxw25HCe8wnGTLBqkKbH2U+SBtRsCVRk35qRPxB/6VWKd2FDrTcYJc0HVNhPIApXlv+gTsM8toXRMfypvBdu0cAAAAASUVORK5CYII=" />
                                                    </svg>
                                                </div>
                                                <?php if ($slide['message']) : ?>
                                                    <p class="bd-testimonial__text bdevs-el-discription_test text-center">
                                                        <?php echo wp_kses_post($slide['message']); ?>
                                                    </p>
                                                <?php endif; ?>
                                                <div class="bd-testimonial-author-2">
                                                    <?php if ($slide['image']) : ?>
                                                        <div class="author__img">
                                                            <img src="<?php print esc_url($slide['image']['url']); ?>" alt="author-5.png">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="author__title">
                                                        <?php if ($slide['client_name']) : ?>
                                                            <h4 class="bdevs-el-test"><?php echo wp_kses_post($slide['client_name']); ?></h4>
                                                        <?php endif; ?>

                                                        <?php if ($slide['designation_name']) : ?>
                                                            <h6 class="bdevs-el-sub_test"><?php echo wp_kses_post($slide['designation_name']); ?></h6>
                                                        <?php endif; ?>
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


        <?php else :

            $this->add_render_attribute('title', 'class', 'bd-big__title-4 bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }
        ?>

            <section class="bd-testimoonial__area pt-120 pb-90 grey-bg p-relative fix  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <?php if ($settings['shape_switch']) : ?>
                    <img class="testimonial__pattren-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/pattern-1.png" alt="pattern-1.png">
                    <img class="testimonial__pattren-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/testimonial/pattern-2.png" alt="pattern-2.png">
                <?php endif; ?>

                <div class="container">
                    <div class="row">
                        <div class="bd-testimonial__info p-relative mb-35">
                            <div class="bd-section-title-4">
                                <?php if ($settings['sub_title']) : ?>
                                    <h6 class="bd-small__title-4 mb-5 bdevs-el-subtitle">
                                        <?php echo wp_kses_post($settings['sub_title']); ?>
                                    </h6>
                                <?php endif; ?>

                                <?php if ($settings['title']) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        wp_kses_post($settings['title'])
                                    );
                                endif;
                                ?>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="bd-testimomial-nav style-2">
                                <div class="testimomial-button-prev"><i class="far fa-long-arrow-left"></i></div>
                                <div class="testimomial-button-next"><i class="far fa-long-arrow-right"></i></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="testimonial__style-2">
                                <div class="bd-testimonial-two-active swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($settings['slides'] as $slide) :
                                            if (!empty($slide['image']['id'])) {
                                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                            }
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="bd-testimonial-items mb-30">
                                                    <div class="bd-tetimonial-contant-3">
                                                        <?php if ($slide['message']) : ?>
                                                            <p class="bdevs-el-discription_test"><?php echo wp_kses_post($slide['message']); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="bd-testimonial-author-3">
                                                        <?php if (!empty($image)) : ?>
                                                            <div class="bd-testimomial-image">
                                                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="author-2">
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="bd-testimonial-title-3">
                                                            <?php if ($slide['client_name']) : ?>
                                                                <h4 class="bdevs-el-test">
                                                                    <?php echo wp_kses_post($slide['client_name']); ?>
                                                                </h4>
                                                            <?php endif; ?>
                                                            <?php if ($slide['designation_name']) : ?>
                                                                <span class="bdevs-el-sub_test"><?php echo wp_kses_post($slide['designation_name']); ?></span>
                                                            <?php endif; ?>
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
                </div>
            </section>

        <?php endif; ?>
<?php
    }
}
