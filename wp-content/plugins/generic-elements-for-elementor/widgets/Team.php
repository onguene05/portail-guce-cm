<?php
namespace Generic\Elements;
defined( 'ABSPATH' ) || die();

class Team extends GenericWidget {

    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'generic-team';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Team', 'generic-elements' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.generic.net/genericelement/team/';
    }
    public function get_script_depends() {
        return ['bootstrap','swiper', 'generic-element-js'];
    }

    public function get_style_depends() {
        return ['bootstrap','fontawesome','swiper', 'generic-element-css'];
    }

    public function get_categories() {
        return [ 'generic-elements' ];
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-person gen-icon';
    }

    public function get_keywords() {
        return [ 'team', 'slider', 'memeber', 'gallery', 'carousel' ];
    }

    // register_content_controls
    protected function register_content_controls() {
        $this->member_list_content_controls();
        $this->member_list_slider_settings();
    }

    // members_list_content_controls
    protected function member_list_content_controls(){
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => esc_html__( 'Members List', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'show_slider',
			[
				'label'        => esc_html__( 'Enable Slide', 'generic-elements' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'yes'          => esc_html__( 'Show', 'generic-elements' ),
				'no'           => esc_html__( 'Hide', 'generic-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => esc_html__( 'Information', 'generic-elements' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => esc_html__( 'Image', 'generic-elements' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__( 'Title', 'generic-elements' ),
                'default' => esc_html__( 'Generic Member Title', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type title here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => esc_html__( 'Job Title', 'generic-elements' ),
                'default' => esc_html__( 'Generic Officer', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type designation here', 'generic-elements' ),
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
                'placeholder' => esc_html__( 'Type link here', 'generic-elements' ),
                'default' => esc_html__( '#', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => esc_html__( 'Links', 'generic-elements' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => esc_html__( 'Show Options?', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'generic-elements' ),
                'label_off' => esc_html__( 'No', 'generic-elements' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => esc_html__( 'Website Address', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your profile link', 'generic-elements' ),
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
                'label' => esc_html__( 'Email', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your email link', 'generic-elements' ),
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
                'label' => esc_html__( 'Phone', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your phone link', 'generic-elements' ),
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
                'label' => esc_html__( 'Facebook', 'generic-elements' ),
                'default' => esc_html__( '#', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your facebook link', 'generic-elements' ),
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
                'label' => esc_html__( 'Twitter', 'generic-elements' ),
                'default' => esc_html__( '#', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your twitter link', 'generic-elements' ),
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
                'label' => esc_html__( 'Instagram', 'generic-elements' ),
                'default' => esc_html__( '#', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your instagram link', 'generic-elements' ),
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
                'label' => esc_html__( 'LinkedIn', 'generic-elements' ),
                'default' => esc_html__( '#', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your linkedin link', 'generic-elements' ),
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
                'label' => esc_html__( 'Youtube', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your youtube link', 'generic-elements' ),
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
                'label' => esc_html__( 'Google Plus', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your Google Plus link', 'generic-elements' ),
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
                'label' => esc_html__( 'Flickr', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your flickr link', 'generic-elements' ),
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
                'label' => esc_html__( 'Vimeo', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your vimeo link', 'generic-elements' ),
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
                'label' => esc_html__( 'Behance', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your hehance link', 'generic-elements' ),
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
                'label' => esc_html__( 'Dribbble', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your dribbble link', 'generic-elements' ),
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
                'label' => esc_html__( 'Pinterest', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your pinterest link', 'generic-elements' ),
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
                'label' => esc_html__( 'Github', 'generic-elements' ),
                'placeholder' => esc_html__( 'Add your github link', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
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
                    ]
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

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'generic-elements' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'generic-elements' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'generic-elements' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'generic-elements' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'generic-elements' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'generic-elements' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h5',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'generic-elements' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'generic-elements' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'generic-elements' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    // member_list_slider_settings
    protected function member_list_slider_settings(){
        // Slider Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__( 'Settings', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'generic-elements' ),
                'label_off' => esc_html__( 'No', 'generic-elements' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
            'label' => esc_html__( 'Slider Speed', 'generic-elements' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'placeholder' => esc_html__( 'Enter Slider Speed', 'generic-elements' ),
            'default' => '5000',
            'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
        );

        $this->add_control(
        'ts_slider_dot_nav_show',
            [
            'label' => esc_html__( 'Dot nav', 'generic-elements' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'generic-elements' ),
            'label_off' => esc_html__( 'No', 'generic-elements' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );
        $this->end_controls_section();
    }


    // register_style_controls
    protected function register_style_controls() {
        $this->member_list_title_content_style_controls();
        $this->member_list_social_icon_style_controls();
        $this->member_list_navigation_dots_style_controls();
    }

    // member_list_title_content_style_controls
    protected function member_list_title_content_style_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__( 'Title / Content', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .generic-el-content',
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
                'label' => esc_html__( 'Members Name', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .generic-el-title',
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Designation', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .generic-el-subtitle',
            ]
        );

        $this->end_controls_section();
    }

    // member_list_social_icon_style_controls
    protected function member_list_social_icon_style_controls(){
        // Social Icon
        $this->start_controls_section(
            '_section_style_social_icon',
            [
                'label' => esc_html__( 'Social Icon', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_social_icon',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__( 'Social Icon Color', 'generic-elements' ),
                'separator' => 'before'
            ]
        );

        $this->start_controls_tabs( '_tabs_dots2' );
        $this->start_controls_tab(
            '_tabs_dots_normals',
            [
                'label' => esc_html__( 'Normal', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'member_social_icon_color',
            [
                'label' => esc_html__( 'Social Icon Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-four-social ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'member_social_icon_bg_color',
            [
                'label' => esc_html__( 'Social Icon Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-four-social ul li a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_dots_normal',
            [
                'label' => esc_html__( 'Hover', 'generic-elements' ),
            ]
        );
        $this->add_control(
            'member_social_icon_hover_color',
            [
                'label' => esc_html__( 'Social Icon Hover Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-four-social ul li a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'member_social_icon_hover_bg_color',
            [
                'label' => esc_html__( 'Social Icon Hover Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-four-social ul li a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tabs();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // member_list_navigation_dots_style_controls
    protected function member_list_navigation_dots_style_controls(){
        // Navigation - Dots
        $this->start_controls_section(
            '_section_style_dots',
            [
                'label' => esc_html__( 'Navigation - Dots', 'generic-elements' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label' => esc_html__( 'Vertical Position', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bd-team-active.swiper-container-horizontal .team-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label' => esc_html__( 'Spacing', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bd-team-active.swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label' => esc_html__( 'Alignment', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'generic-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'generic-elements' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'generic-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-area .bd-team-active.swiper-container-horizontal .team-pagination.team-dots' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_dots' );
        $this->start_controls_tab(
            '_tadb_dots_normal',
            [
                'label' => esc_html__( 'Normal', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'dots_nav_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-active.swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => esc_html__( 'Active', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'dots_nav_active_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-team-active.swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    // Render Funciton
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract( $settings );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bd-team-four-title generic-el-title' );
        $this->add_render_attribute( 'name', 'class', 'name' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'generic-card-text' );

        if (!empty($title)) {
            $title = wp_kses_post( $settings['title' ] );
        }

        // ================

        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        // ================

        if ( empty( $settings['slides'] ) ) {
            return;
        }
        ?>

        <!-- team area start here -->
        <section class="bd-team-area">
            <div class="container">
                <?php if( $show_slider == 'yes' ): ?>
                <div class="bd-team-active swiper-container" autoplay-speed ="<?php echo esc_attr( $ts_slider_speed ); ?>" autoplay_stop="<?php echo esc_attr( $auto_nav_slide ); ?>">
                    <div class="swiper-wrapper pb-40">
                        <?php foreach ( $settings['slides'] as $slide ) :
                            $title = wp_kses_post( $slide['title' ] );
                            $slide_url = esc_url($slide['slide_url']);

                            if (!empty($slide['image']['id'])) {
                                $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                            }

                        ?>
                        <div class="swiper-slide">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="image not found">
                                <div class="bd-team-four-text">
                                    <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title' ),
                                        $title,
                                        $slide_url
                                    ); ?>

                                    <?php if( !empty( $slide['designation'] ) ) : ?>
                                    <span class="generic-el-subtitle"><?php echo wp_kses_post( $slide['designation'] ); ?></span>
                                    <?php endif; ?>

                                    <?php if( !empty($slide['show_social'] ) ) : ?>
                                    <div class="bd-team-four-social">
                                        <ul>
                                            <?php if( !empty($slide['web_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                                    <i class="far fa-globe"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['email_title'] ) ) : ?>
                                            <li>
                                                <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                                    <i class="fal fa-envelope"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                                            <li>
                                                <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                                    <i class="fab fa-flickr"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                                    <i class="fab fa-vimeo-v"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                                    <i class="fab fa-behance"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                                    <i class="fab fa-dribbble"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                                    <i class="fab fa-github"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>

                    <?php if(!empty($dot_nav_show)) : ?>
                    <!-- If we need pagination -->
                    <div class="team-pagination team-dots"></div>
                    <?php endif; ?>

                </div>
                <?php endif; ?>
                <?php if( $show_slider == '' ): ?>
                    <div class="row">
                    <?php foreach ( $slides as $slide ) :
                        $title = wp_kses_post( $slide['title' ] );
                        $slide_url = esc_url($slide['slide_url']);
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                        }
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="bd-portfolio bd-team-four mb-30">
                                <img src="<?php print esc_url($slide['image']['url']); ?>" alt="img not found">
                                <div class="bd-team-four-text">
                                    <h5 class="bd-team-four-title"><?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape( $settings['title_tag'] ),
                                        $this->get_render_attribute_string( 'title' ),
                                        $title,
                                        $slide_url
                                    ); ?></h5>
                                    <span><?php echo wp_kses_post( $slide['designation'] ); ?></span>
                                    <div class="bd-team-four-social">
                                        <ul>
                                        <?php if( !empty($slide['web_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                                    <i class="far fa-globe"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['email_title'] ) ) : ?>
                                            <li>
                                                <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                                    <i class="fal fa-envelope"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                                            <li>
                                                <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                                    <i class="fas fa-phone"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                                    <i class="fab fa-flickr"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                                    <i class="fab fa-vimeo-v"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                                    <i class="fab fa-behance"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                                    <i class="fab fa-dribbble"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                                    <i class="fab fa-pinterest-p"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>

                                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                            <li>
                                                <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                                    <i class="fab fa-github"></i>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <!-- team area end here -->

        <?php
    }
}
