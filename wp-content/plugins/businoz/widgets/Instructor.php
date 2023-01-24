<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Instructor extends \Generic\Elements\GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'instructor';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Instructor', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/instructor/';
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
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-lock-user gen-icon';
    }
    public function get_keywords() {
        return [ 'slider', 'memeber', 'gallery', 'instructor', 'carousel' ];
    }
    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

protected function register_content_controls() {

           $this->start_controls_section(
            '_section_design_style',
            [
                'label' => __( 'Presets', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'designs',
            [
                'label' => __('Designs', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'design_1' => __('Design 1', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['design_1','design_2'],
                ],
            ]
        );

        $this->add_control(
            'icon_switch',
            [
                'label' => __('Subtitle Icon Show/Hide', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'design_style' => ['design_1'],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'heading_title_icon',
            [
                'label' => __('Title Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                 'condition' => [
                    'design_style' => ['design_1','design_3'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Heading Sub Title',
                'placeholder' => __( 'Heading Sub Text', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-elementor' ),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'bdevs-elementor' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Description Text', 'bdevs-elementor' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'sec_title_tag',
            [
                'label'   => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'bdevs-elementor' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h2',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'sec_align',
            [
                'label'     => __( 'Alignment', 'bdevs-elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_button_style',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-elementor'),
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->end_controls_section();



        // member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Members List', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'bdevs-elementor' ),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-elementor' ),
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
                'label' => __( 'Title', 'bdevs-elementor' ),
                'default' => __( 'BDevs Member Title', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
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
                'label' => __( 'Designation', 'bdevs-elementor' ),
                'default' => __( 'BDevs Officer', 'bdevs-elementor' ),
                'placeholder' => __( 'Type designation here', 'bdevs-elementor' ),
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
                'placeholder' => __( 'Type link here', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instructor_review',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Instructor Review', 'bdevs-elementor' ),
                'default' => __( 'Instructor Review', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instructor_course',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Instructor Course', 'bdevs-elementor' ),
                'default' => __( 'Instructor Course', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bdevs-elementor' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-elementor' ),
                'label_off' => __( 'No', 'bdevs-elementor' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your profile link', 'bdevs-elementor' ),
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
                'label' => __( 'Email', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your email link', 'bdevs-elementor' ),
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
                'label' => __( 'Phone', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your phone link', 'bdevs-elementor' ),
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
                'label' => __( 'Facebook', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your facebook link', 'bdevs-elementor' ),
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
                'label' => __( 'Twitter', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your twitter link', 'bdevs-elementor' ),
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
                'label' => __( 'Instagram', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your instagram link', 'bdevs-elementor' ),
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
                'label' => __( 'LinkedIn', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevs-elementor' ),
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
                'label' => __( 'Youtube', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your youtube link', 'bdevs-elementor' ),
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
                'label' => __( 'Google Plus', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevs-elementor' ),
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
                'label' => __( 'Flickr', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your flickr link', 'bdevs-elementor' ),
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
                'label' => __( 'Vimeo', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevs-elementor' ),
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
                'label' => __( 'Behance', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your hehance link', 'bdevs-elementor' ),
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
                'label' => __( 'Dribbble', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevs-elementor' ),
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
                'label' => __( 'Pinterest', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevs-elementor' ),
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
                'label' => __( 'Github', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your github link', 'bdevs-elementor' ),
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
                'label' => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'bdevs-elementor' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h4',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-elementor' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
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

    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevselementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Title', 'bdevselementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselementor' ),
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
                'label' => __( 'Text Color', 'bdevselementor' ),
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
                'label' => __( 'Subtitle', 'bdevselementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselementor' ),
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
                'label' => __( 'Text Color', 'bdevselementor' ),
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
                'label' => __( 'Description', 'bdevselementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselementor' ),
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
                'label' => __( 'Text Color', 'bdevselementor' ),
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

        // services item
        $this->start_controls_section(
            '_box_section_style_content',
            [
                'label' => __( 'Box Title / Content', 'bdevselementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            '_box_content_padding',
            [
                'label' => __( 'Content Padding', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_content_background',
                'selector' => '{{WRAPPER}} .bdevs-box-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Box Title
        $this->add_control(
            '_box_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevselementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            '_box_title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_box_title_color',
            [
                'label' => __( 'Text Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'boxtitle',
                'selector' => '{{WRAPPER}} .bdevs-box-title',
            ]
        );

        // description
        $this->add_control(
            '_box_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevselementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            '_box_description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            '_box_description_color',
            [
                'label' => __( 'Text Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-box-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'boxdescription',
                'selector' => '{{WRAPPER}} .bdevs-box-content p',
            ]
        );

        $this->end_controls_section();

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevselementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevselementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevselementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'team-title' );
        $this->add_render_attribute( 'name', 'class', 'name' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'bdevs-card-text' );

        if (!empty($title)) {
            $title = wp_kses_post( $settings['title' ] );
        }

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        if (!empty($settings['heading_title_icon']['id'])) {
            $heading_title_icon = wp_get_attachment_image_url($settings['heading_title_icon']['id'], $settings['thumbnail_size']);
        }

        ?>

    <?php if ( $settings['designs'] === 'design_3' ):

        // bg_image
        if (!empty($settings['bg_shape_image']['id'])) {
            $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['shape_size'] );
            if ( ! $bg_shape_image ) {
                $bg_shape_image = $settings['bg_shape_image']['url'];
            }
        }

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';

        $this->add_inline_editing_attributes( 'title_slider', 'basic' );
        $this->add_render_attribute( 'title_slider', 'class', 'ateam__text--title' );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section-title text-white bdevs-el-title' );

        $this->add_inline_editing_attributes( 'designation', 'basic' );
        $this->add_render_attribute( 'designation', 'class', 'team__position' );

        $title = wp_kses_post( $settings['title'] );
    ?>

    <section class="">
        <div class="container"></div>
    </section>

    <!-- style 2 -->
    <?php elseif ( $settings['designs'] === 'design_2' ):

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';

        $this->add_inline_editing_attributes( 'title_slider', 'basic' );
        $this->add_render_attribute( 'title_slider', 'class', 'a-text-white ateam__3--title' );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section-title bdevs-el-title' );

        $title = wp_kses_post( $settings['title'] );

    ?>

    <section class="gen-team-area">
        <div class="container">
            <div class="gen-team-wrapper team-boxed-style">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="gen-team-single mb-30">
                            <div class="gen-team-single-inner">
                                <div class="gen-team-thumb">
                                    <a href="#"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/img/team/team-thumb1.jpg'; ?>" alt="team-img"></a>
                                    <div class="gen-social-links team-social-links">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="gen-team-content">
                                    <h4 class="gen-member-name"><a href="#">Brandon Tylor </a></h4>
                                    <span class="gen-member-designation">Sr. Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="gen-team-single mb-30">
                            <div class="gen-team-single-inner">
                                <div class="gen-team-thumb">
                                    <a href="#"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/img/team/team-thumb1.jpg'; ?>" alt="team-img"></a>
                                    <div class="gen-social-links team-social-links">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="gen-team-content">
                                    <h4 class="gen-member-name"><a href="#">Brandon Tylor </a></h4>
                                    <span class="gen-member-designation">Sr. Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="gen-team-single mb-30">
                            <div class="gen-team-single-inner">
                                <div class="gen-team-thumb">
                                    <a href="#"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/img/team/team-thumb1.jpg'; ?>" alt="team-img"></a>
                                    <div class="gen-social-links team-social-links">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="gen-team-content">
                                    <h4 class="gen-member-name"><a href="#">Brandon Tylor </a></h4>
                                    <span class="gen-member-designation">Sr. Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="gen-team-single mb-30">
                            <div class="gen-team-single-inner">
                                <div class="gen-team-thumb">
                                    <a href="#"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/assets/img/team/team-thumb1.jpg'; ?>" alt="team-img"></a>
                                    <div class="gen-social-links team-social-links">
                                        <ul>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="gen-team-content">
                                    <h4 class="gen-member-name"><a href="#">Brandon Tylor </a></h4>
                                    <span class="gen-member-designation">Sr. Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>


    <!-- style 1 -->
    <?php else:
        $this->add_inline_editing_attributes( 'title_slider', 'basic' );
        $this->add_render_attribute( 'title_slider', 'class', 'bdevs-el-title' );

    ?>

    <section class="member-area">
     <div class="container">
        <div class="row">
            <?php foreach ( $settings['slides'] as $slide ) :
                $title = wp_kses_post( $slide['title' ] );
                $slide_url = esc_url($slide['slide_url']);

                $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                if ( ! $image ) {
                    $image = $slide['image']['url'];
                }
            ?>
           <div class="col-xl-3 col-lg-4 col-md-6">
              <div class="member-main-wrapper mb-30">
                 <div class="member-body text-center">
                    <div class="member-item">
                        <?php if( !empty($image) ) : ?>
                       <div class="member-thumb">
                          <a href="<?php echo wp_kses_post( $slide['slide_url'] ); ?>"><img src="<?php print esc_url($image); ?>"
                                alt="member-img"></a>
                       </div>
                       <?php endif; ?>

                       <div class="member-content">
                          <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_slider' ),
                                $title,
                                $slide_url
                                );
                          ?>
                          <?php if( !empty( $slide['designation'] ) ) : ?>
                          <span class="bdevs-el-subtitle"><?php echo wp_kses_post( $slide['designation'] ); ?></span>
                          <?php endif; ?>
                       </div>
                       <?php if( !empty($slide['show_social'] ) ) : ?>
                       <div class="member-social">
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
                 <div class="member-meta">
                    <div class="member-reating">
                       <i class="fas fa-star"></i>
                       <?php if( !empty( $slide['instructor_review'] ) ) : ?>
                       <span><?php echo wp_kses_post( $slide['instructor_review'] ); ?></span>
                       <?php endif; ?>
                    </div>
                    <?php if( !empty( $slide['instructor_course'] ) ) : ?>
                    <div class="member-course">
                       <i class="flaticon-computer"></i>
                        <span><?php echo wp_kses_post( $slide['instructor_course'] ); ?></span>
                    </div>
                    <?php endif; ?>
                 </div>
              </div>
           </div>
           <?php endforeach; ?>
        </div>
     </div>
    </section>

    <?php endif; ?>

        <?php
    }
}
