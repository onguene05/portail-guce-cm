<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class About extends \Generic\Elements\GenericWidget
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
        return 'cust-about';
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
        return __('About', 'bdevs-elementor');
    }
    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/about/';
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
        return 'eicon-single-post';
    }

    public function get_keywords()
    {
        return ['info', 'blurb', 'box', 'about', 'testimonial', 'content'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }



    public function get_tp_contact_form()
    {
        if (!class_exists('WPCF7')) {
            return;
        }
        $tp_cfa         = array();
        $tp_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
        $tp_forms       = get_posts($tp_cf_args);
        $tp_cfa         = ['0' => esc_html__('Select Form', 'bdevs-elementor')];
        if ($tp_forms) {
            foreach ($tp_forms as $tp_form) {
                $tp_cfa[$tp_form->ID] = $tp_form->post_title;
            }
        } else {
            $tp_cfa[esc_html__('No contact form found', 'bdevs-elementor')] = 0;
        }
        return $tp_cfa;
    }


    /**
     * Register content related controls
     */
    protected function register_content_controls()
    {

        $this->design_style();
        $this->title_and_desc();
        $this->images();
        $this->button();
        $this->video_button();
        $this->about_features_list();
        $this->about_author();
        $this->skills();
        $this->about_since();
        $this->about_batch();
        $this->about_info_list();
        $this->contact_form07();
        $this->about_customer();
        $this->about_number_list();
        $this->about_number_list02();
        $this->text_overlay();
        $this->button_overlay();
        $this->Phone_number_gradient();

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
                    'design_6' => __('Design 6', 'bdevs-elementor'),
                    'design_7' => __('Design 7', 'bdevs-elementor'),
                    'design_8' => __('Design 8', 'bdevs-elementor'),
                    'design_9' => __('Design 9', 'bdevs-elementor'),
                    'design_10' => __('Design 10', 'bdevs-elementor'),
                    'design_11' => __('Design 11', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    public function title_and_desc()
    {
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('About', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Back Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
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
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_5', 'design_7', 'design_8','design_10', 'design_11'],
                ],
            ]
        );

        $this->add_control(
            'agency_sub_title',
            [
                'label' => __('Agency Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_8']
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
            'description',
            [
                'label' => __('Description', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs info box description goes here', 'bdevs-elementor'),
                'placeholder' => __('Type info box description', 'bdevs-elementor'),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_5', 'design_6', 'design_7', 'design_8', 'design_9','design_10', 'design_11'],
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('30', 'bdevs-elementor'),
                'placeholder' => __('Type number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2', 'design_3', 'design_4', 'design_5', 'design_9'],
                ],
            ]
        );

        $this->add_control(
            'number2',
            [
                'label' => __('Number 02', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('5000+', 'bdevs-elementor'),
                'placeholder' => __('Type number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );

        $this->add_control(
            'experience',
            [
                'label' => __('Experience', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Years Experience', 'bdevs-elementor'),
                'placeholder' => __('Type Experience here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2', 'design_4'],
                ],
            ]
        );

        $this->add_control(
            'leadership',
            [
                'label' => __('Leadership', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Leadership Development', 'bdevs-elementor'),
                'placeholder' => __('Type Leadership Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'icon_title',
            [
                'label' => __('Icon Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Innovative HR Solution', 'bdevs-elementor'),
                'placeholder' => __('Type Icon Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_4'],
                ],
            ]
        );

        $this->add_control(
            'icon_description',
            [
                'label' => __('Icon Description', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Icon Description', 'bdevs-elementor'),
                'placeholder' => __('Type Icon Description', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
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
    }

    public function images()
    {
        // img
        $this->start_controls_section(
            '_section_about_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_5', 'design_6', 'design_7', 'design_8', 'design_9','design_10', 'design_11'],
                ],
            ]
        );


        $this->add_control(
            'image2',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 2nd', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_6'],
                ],
            ]
        );

        $this->add_control(
            'signature_img',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Signature Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'image3',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 3rd', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4', 'design_6'],
                ],
            ]
        );

        $this->add_control(
            'image4',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 4th', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_6'],
                ],
            ]
        );

        $this->add_control(
            'image5',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Image 5th', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_20'],
                ],
            ]
        );

        $this->add_control(
            'review_img',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Review Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4'],
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    public function about_features_list()
    {

        $this->start_controls_section(
            '_section_features_list',
            [
                'label' => __('Features List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2', 'design_3', 'design_4', 'design_7'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_2' => __('Style 2', 'bdevs-elementor'),
                    'style_3' => __('Style 3', 'bdevs-elementor'),
                    'style_4' => __('Style 4', 'bdevs-elementor'),
                ],
                'default' => 'style_2',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-elementor'),
                'placeholder' => __('Type title here', 'bdevs-elementor'),
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
                'label' => __('URL', 'bdevs-elementor'),
                'default' => __('#', 'bdevs-elementor'),
                'placeholder' => __('Type url here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_4'],
                ],
            ]
        );

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Number', 'bdevs-elementor'),
                'placeholder' => __('Type Number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_3'],
                ],
            ]
        );


        $repeater->add_control(
            'subtitle',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'placeholder' => __('Type Subtitle here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_4'],
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_4'],
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Description', 'bdevs-elementor'),
                'placeholder' => __('Type Description here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_10', 'style_5'],
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
    }

    public function about_info_list()
    {

        $this->start_controls_section(
            '_section_features_info',
            [
                'label' => __('About Info', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_8'],
                ],
            ]
        );


        $this->add_control(
            'about_info_title_one',
            [
                'label' => __('Title One', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('title one', 'bdevs-elementor'),
                'placeholder' => __('Type Info Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'about_info_title_two',
            [
                'label' => __('Title Two', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('title two', 'bdevs-elementor'),
                'placeholder' => __('Type Info Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();
    }

    public function about_customer()
    {

        $this->start_controls_section(
            '_customer_about_section',
            [
                'label' => __('About Customer', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );


        $this->add_control(
            'about_customer_des',
            [
                'label' => __('Customer Description', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('description', 'bdevs-elementor'),
                'placeholder' => __('Type description', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'about_customer_number',
            [
                'label' => __('Customer Number', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('number', 'bdevs-elementor'),
                'placeholder' => __('Type number', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'about_customer_mail',
            [
                'label' => __('Customer Email', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('email', 'bdevs-elementor'),
                'placeholder' => __('Type email', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();
    }


    public function video_button()
    {
        // hero_video_button
        $this->start_controls_section(
            '_video_button',
            [
                'label' => __('Video', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            '_video_text',
            [
                'label'       => __('Video Text', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Watch Video', 'bdevs-elementor'),
                'placeholder' => __('Enter video Title', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_video_url',
            [
                'label' => __('Video URL', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('video url goes here', 'bdevs-elementor'),
                'placeholder' => __('Set Video URL', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->end_controls_section();
    }

    public function about_author()
    {
        // hero_video_button
        $this->start_controls_section(
            '_about_author',
            [
                'label' => __('About Author', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'about_author_image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __('Author Image', 'bdevs-elementor'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_control(
            'about_author_title',
            [
                'label' => __('Author Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Author Title', 'bdevs-elementor'),
                'placeholder' => __('Author Title', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_author_url',
            [
                'label' => __('Author URL', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Author URL', 'bdevs-elementor'),
                'placeholder' => __('Author URL', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_control(
            'about_author_des',
            [
                'label' => __('Author Designation', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Author Designation', 'bdevs-elementor'),
                'placeholder' => __('Author Designation', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }


    public function skills()
    {
        // skills
        $this->start_controls_section(
            '_skill_analysis',
            [
                'label' => __('About Skills', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3', 'design_11'],
                ],
            ]
        );

        $this->add_control(
            'skills_number',
            [
                'label' => __('Skills Number', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('65', 'bdevs-elementor'),
                'placeholder' => __('Skills Number', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'skills_title',
            [
                'label' => __('Skills Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Business Analysis', 'bdevs-elementor'),
                'placeholder' => __('Skills Title', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'skills_des',
            [
                'label' => __('Skills Des', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Expectional business model', 'bdevs-elementor'),
                'placeholder' => __('Skills Des', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );


        $this->end_controls_section();
    }


    public function about_since()
    {
        // hero_video_button
        $this->start_controls_section(
            '_about_since',
            [
                'label' => __('About Since', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_12'],
                ],
            ]
        );

        $this->add_control(
            'about_since_title',
            [
                'label' => __('Since Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Since Title', 'bdevs-elementor'),
                'placeholder' => __('Since Title', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_since_year',
            [
                'label' => __('Since Year', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Since Year', 'bdevs-elementor'),
                'placeholder' => __('Since Year', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'about_since_location',
            [
                'label' => __('Since Location', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Since Location', 'bdevs-elementor'),
                'placeholder' => __('Since Location', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->end_controls_section();
    }

    public function about_batch()
    {
        // hero_video_button
        $this->start_controls_section(
            '_about_batch',
            [
                'label' => __('About Batch', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_7'],
                ],
            ]
        );

        $this->add_control(
            'about_batch_title',
            [
                'label' => __('Batch Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Batch Title', 'bdevs-elementor'),
                'placeholder' => __('Batch Title', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function button()
    {

        // Button 01
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_4', 'design_8'],
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

        $this->add_control(
            'button_icon',
            [
                'label' => __('Icon', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-right',
            ]
        );

        $this->add_control(
            'button_selected_icon',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => __('Icon Position', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button 02
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __('Button 02', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'button_text2',
            [
                'label' => __('Text 02', 'bdevs-elementor'),
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
            'button_link2',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_icon2',
            [
                'label' => __('Icon', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-right',
            ]
        );

        $this->add_control(
            'button_selected_icon2',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_icon_position2',
            [
                'label' => __('Icon Position', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing2',
            [
                'label' => __('Icon Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function contact_form07()
    {
        $this->start_controls_section(
            'tpcore_contact',
            [
                'label' => esc_html__('Contact Form', 'bdevs-elementor'),
                'condition' => [
                    'designs' => ['design_9'],
                ],
            ]
        );

        $this->add_control(
            'tpcore_select_contact_form',
            [
                'label'   => esc_html__('Select Form', 'bdevs-elementor'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '0',
                'options' => $this->get_tp_contact_form(),
            ]
        );

        $this->end_controls_section();
    }

    public function about_number_list()
    {
        $this->start_controls_section(
            '_section_number_list',
            [
                'label' => __('Number List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_11'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_11' => __('Style 11', 'bdevs-elementor'),
                ],
                'default' => 'style_2',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-elementor'),
                'placeholder' => __('Type title here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Number', 'bdevs-elementor'),
                'placeholder' => __('Type Number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides01',
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
    }


    public function about_number_list02()
    {
        $this->start_controls_section(
            '_section_number_list02',
            [
                'label' => __('Number List 02', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_11'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __('Field condition', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_11' => __('Style 11', 'bdevs-elementor'),
                ],
                'default' => 'style_2',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-elementor'),
                'placeholder' => __('Type title here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Number', 'bdevs-elementor'),
                'placeholder' => __('Type Number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides02',
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
    }

 // background_overlay

    public function text_overlay(){

     // Background Overlay
        $this->start_controls_section(
            '_section_text_overlay',
            [
                'label' => __( 'Text Overlay', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay' );

        $this->start_controls_tab(
            'tab_background_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-about__experience h2',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
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
                    '{{WRAPPER}}  .elementor-background-overlay .ddd' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_overlay_hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn-hover-bg-color',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .ddd:hover',
            ]
        );


        $this->add_control(
            'background_hover_overlay_opacity',
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
                    '{{WRAPPER}} .ddd .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }



 // Button overlay

    public function button_overlay(){

        // Background Overlay
        $this->start_controls_section(
            '_section_text_overlay2',
            [
                'label' => __( 'Button Overlay', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2','design_5'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay2' );

         $this->start_controls_tab(
            'tab_background_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_2','design_5'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-home-2__btn-2,.bd-contact__text .call__icon',
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
                    '{{WRAPPER}}  .elementor-background-overlay .bd-home-2__btn-2, .bd-contact__text .call__icon' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_button_overlay_hover',
            [
                'label' => __( 'Hover', 'elementor' ),
            ]
        );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn-hover-bg-color2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-home-2__btn-2:hover',
            ]
        );


        $this->add_control(
            'background_button_hover_overlay_opacity',
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
                    '{{WRAPPER}} .bd-home-2__btn-2:hover .elementor-background-overlay' => 'opacity: {{SIZE}};',
                ],
                // 'condition' => [
                //     'background_overlay_background' => [ 'classic', 'gradient' ],
                // ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }

 // Phone color

    public function Phone_number_gradient(){

        // Phone Number Gradient
        $this->start_controls_section(
            '_section_text_overlay3',
            [
                'label' => __( 'Phone Number Gradient Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay3' );

         $this->start_controls_tab(
            'tab_background_phone_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background3',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-contact__text .call__icon',
            ]
        );


        $this->end_controls_tab();


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }

    /**
     * Register styles related controls
     */
    protected function register_style_controls()
    {

        $this->title_style_controls();
        $this->description_style_controls();
        $this->button_style_controls();
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
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'condition' => [
                    'designs' => ['design_6', 'design_8','design_7'],
                ],
            ]
        );


        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_6', 'design_8','design_10'],
                ],
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
                'condition' => [
                    'designs' => ['design_6', 'design_8','design_10'],
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
                'condition' => [
                    'designs' => ['design_6', 'design_8','design_10'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'condition' => [
                    'designs' => ['design_6', 'design_8','design_10'],
            ],
            ],
            
        );


        //Agency Subtitle    
        $this->add_control(
            '_agency_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Agency Subtitle', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_8'],
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_agency_spacing',
            [
                'label' => __('Agency Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle-agency' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'designs' => ['design_8'],
                ],

            ]
        );

        $this->add_control(
            'subtitle_agency_color',
            [
                'label' => __('Agency Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle-agency' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'designs' => ['design_8'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'agencysubtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle-agency',
                'condition' => [
                    'designs' => ['design_8'],
                ],
            ]
        );


        // Features Subtitle    
        $this->add_control(
            '_features_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Features Subtitle', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_7'],
                ],
            ]
        );

        $this->add_responsive_control(
            'features_subtitle_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-fe-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'designs' => ['design_7'],
                ],

            ]
        );

        $this->add_control(
            'features_subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-fe-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'designs' => ['design_7'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'featuressubtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-fe-subtitle',
                'condition' => [
                    'designs' => ['design_7'],
                ],
            ]
        );
    }

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


        $this->end_controls_section();
    }

    protected function button_style_controls()
    {


        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_2', 'design_3', 'design_4', 'design_5', 'design_8'],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
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
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
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
                'label' => __('Background Color', 'bdevs-elementor'),
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
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'bdevs-elementor'),
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();


?>

    <?php if ($settings['designs'] === 'design_11') :

    $this->add_render_attribute('title', 'class', 'bd-big__title-4 medium mb-30 bdevs-el-title');

    if (!empty($settings['image']['id'])) {
        $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
    }

    ?>


    <!-- Fatures-area-start -->
    <section class="bd-features__area pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="bd-section-title-4 mb-40 bdevs-el-content">
                        <?php if ($settings['sub_title']) : ?>
                        <h6 class="bd-small__title-4 bdevs-el-subtitle mb-5"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                        <?php endif; ?>

                        <?php
                        if ($settings['title']) :
                            printf(
                                '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                wp_kses_post($settings['title'])
                            );
                        endif;
                        ?>

                        <?php if ($settings['description']) : ?>
                        <p class="bd-paragraph-title-4"><?php echo wp_kses_post($settings['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="bd-fatures__box mb-60">
                        <div class="bd-features__content-2">
                            <div class="bd-features__info">
                                <div class="bd-features__title">
                                  <h6 class="active"><?php print esc_html__('Company Impressions', 'businoz'); ?></h6>
                                </div>
                                <div class="bd-features__improve__list">
                                    <?php foreach ($settings['slides01'] as $slide) : ?>
                                    <div class="bd-features__improve">
                                        <h2><?php echo wp_kses_post($slide['number']); ?></h2>
                                        <span><?php echo wp_kses_post($slide['title']); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="bd-features__info">
                                <div class="bd-features__title">
                                    <h6><?php print esc_html__('Captured', 'businoz'); ?></h6>
                                </div>
                                <div class="bd-features__improve__list">
                                    <?php foreach ($settings['slides02'] as $slide) : ?>
                                    <div class="bd-features__improve">
                                        <h2><?php echo wp_kses_post($slide['number']); ?></h2>
                                        <span><?php echo wp_kses_post($slide['title']); ?></span>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <?php if (!empty($settings['skills_number'])) : ?>
                        <div class="bd-skill__style-2">
                            <div class="bd-skill__progress p-relative mb-40 fix">
                                <div class="bd-skill__title-wrapper">
                                    <h6 class="bd-skill__title"><?php echo wp_kses_post($settings['skills_title']); ?></h6>
                                </div>
                                <span class="progress-count"><?php echo esc_attr($settings['skills_number']); ?>%</span>
                                <div class="progress">
                                    <div class="progress-bar wow slideInLeft" data-wow-duration="1.5s" data-wow-delay=".4s"
                                        role="progressbar" data-width="<?php echo esc_attr($settings['skills_number']); ?>%" aria-valuenow="<?php echo esc_attr($settings['skills_number']); ?>" aria-valuemin="0"
                                        aria-valuemax="100"
                                        style="width: <?php echo esc_attr($settings['skills_number']); ?>%; visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: slideInLeft;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <?php if (!empty($image)) : ?>
                    <div class="bd-features__images mb-60">
                        <img src="<?php echo esc_url($image); ?>" alt="features-3.png">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Fatures-area-end -->



        <?php elseif ($settings['designs'] === 'design_10') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-5 bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

        ?>

        <section class="bd-about__area pt-120 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
             <div class="container">
                <div class="row">
                   <div class="col-xl-6 col-lg-6 col-md-6">
                    <?php if ($settings['image']) : ?>
                      <div class="bd-about__img w-img mb-30">
                         <img src="<?php echo esc_url($image); ?>" alt="about-img-3.jpg">
                      </div>
                      <?php endif; ?>
                   </div>
                   <div class="col-xl-6 col-lg-6 col-md-6">
                      <div class="bd-about__wrapper mb-30">
                         <div class="bd-section__title-5 mb-35">
                            <?php if ($settings['sub_title']) : ?>
                            <h5 class="bd-smaill__title-5 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h5>
                            <?php endif; ?>

                            <?php
                            if ($settings['title']) :
                                printf(
                                    '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    wp_kses_post($settings['title'])
                                );
                            endif;
                            ?>

                         </div>
                         <?php if ($settings['about_customer_des']) : ?>
                         <div class="bd-customer__text">
                            <p><?php echo wp_kses_post($settings['about_customer_des']); ?></p>
                         </div>
                        <?php endif; ?>
                         <div class="bd-customer__wrapper">
                            <?php if ($settings['about_customer_number']) : ?>
                            <div class="bd-customer__number">
                               <span><?php echo wp_kses_post($settings['about_customer_number']); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if ($settings['about_customer_mail']) : ?>
                            <div class="bd-customer__mail">
                               <h5><?php echo esc_html('or','bdevs-elementor') ?></h5>
                               <h3><a href="mailto:info@webmail.com"><?php echo wp_kses_post($settings['about_customer_mail']); ?></a></h3>
                            </div>
                            <?php endif; ?>
                         </div>
                         <?php if ($settings['description']) : ?>
                         <div class="bd-book__tittle bdevs-el-content">
                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                         </div>
                         <?php endif; ?>
                      </div>
                   </div>
                </div>
             </div>
        </section>


        <?php elseif ($settings['designs'] === 'design_9') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-3 medium mb-35 bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'bd-theme-4-btn-1 mb-50 bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <!-- Faq-area-start -->
            <section class="bd-faq-area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-8">
                            <?php if (!empty($image)) : ?>
                                <div class="bd-faq-thumb w-img mb-30">
                                    <img src="<?php echo esc_url($image); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-10">
                            <div class="bd-faq-contant mb-30">
                                <div class="bd-faq-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="80px" height="80px">
                                        <image x="0px" y="0px" width="80px" height="80px" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAClFBMVEUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauUOauX////1wVBPAAAA2nRSTlMAB3ndCT/Iy0IUk/z9lhZX3N5aJKqtJwJu7O5yBDbAwzkNiPn6iw9M1ddPHKCjHmXn6Gcut7kwfvX2gQpDztFGF5eZGFvh414or7IpBXTw8XcGO8U+EY2QE1HZ21QgpKciC3Hp6wwVv70dzRvPUtA8Yhpg+HrMdRlz7XYlyv5IpTimAXuYfH2zNICCwhLBg4SFELaGvlAOZIe8M4q6u4m4j9isjJqc+3DqTW9ZStMrm54qsDcDalbyaEd/ROahJqvgPff0YeRByakjxkDlX2Pz38SuRV1ssbQx2noPAwQAAAABYktHRNuZBBYUAAAAB3RJTUUH5gQbDBYZD7jAEgAABHpJREFUWMOt2PlfFGUcB/CB1d3MUlPblIpDXMpI0IpatF1MPKggDhFUQiRrUTJNVyziyBAkMBOUTNQItewuLe3WTKL7vvv8NTHPd2Z2dveZmWdm+fzAa/Y53q+Z4ZnneWYkSSRJyS5X8gShpkKZ6MZYPFeMEzfpyslguerqKePhTZ0GLddMT5ibMRNRudabEHfdrNmIScr1Nzj3bkwFJ2npDrmMOZngZq4vy4l3080wzLxbbHPZt8I083PsebkLYJGFt9ngbr/DipOTd6cgN+Euv4gH5C9aLOLdHRDj5AQLLLkl94hzcpYWmnvLltvzgBUrTbiie+1ycu6734ArLnnAiQeUlpXzvIpVzjg57so4bnXVXOceMLl6TbS3dl0inJyaB3Vc7fpEOTl1GxSu/qGN4+EBD5c8wsBQja5wdsMmW2nQT+nTlEVsc1AraqwVfOAjt6tR6xzcrBY+ukUtW2vXk6TH1L5bsyOFmlhhH9wW4z3O/m5XpphK+2Al9QxsZ792SOGd7KCwSQNDvmrB+EIaGKBZJzkslWKXTpRBr/hA8apg4AmGPIlSqRl4ikSPArbki3r5LQrYSF4J0CyDKCOx1SnoIW8XVBB0H6e0RoFtJokCPUtY9zJEQFVsatfAp3d7TbL7GQ1sbyJvJ/SgIhbmqKCnw3ywdHhUMEf5/yIaxB6tLQM7rYZfpwpKuvPTg+iKArcWm3vFwSiwC/Eg9upBdBc8a5KCbujBveCB6KFab5vosGnzxnrRIBax6owGUTA1g3XogRGIXtZg9T4xL+25OC8WVMX9It4+jhcH4nkSlc21+0BPXA64leslrxfmIPpYs352Hw9ydwTlB+W6hn72ow9WIA6xhlkDY4cGO+kXZC+L6/FARTy8CXiRD+YCAwYeF8QROsdBuI7yvKMuDJJ3BGIgjtE5Hkc44IlLIIzBw6zBHIiC8NEIz+OPl5fIG4I4qIov8+qOk3cMdkBUsU71nPeLPNrA+GAPxDCJM0/E5CR5p2AXVESpIyZUWgX7IF7hPidsdu2EE/DVJCOwfKkD8PRrkklmnbYLvv4G9Zz6ZkzeovK3N9oD33mXdUt6L77qDH0QOhu0A3aHWKfsAV5lKr17r3lfHBymDx8f1IAbVzqrPndKEMw8T7fpw1KDG4+PlO9BH4dFwAWfUOsus9X0U2rz2efWYKCInrkLMM18egIvNlmBJ2npqU2DRVZtYA37vzAHh+hZrbhk5QHLv6TLPmQCXlYWkZUj1h7g30Gtv/IbgaNfU4teEU5OH7WfuIIPfjODlpI6UQ/4lhar777ngXU0s7e4xT2g9SKtFevjQdrVSD+M2vGAH5UPsz0x4MhPVP6z8CuFmsu51HPZL3rwkvLSOGSXk+OjoZb+awT8rZY7SEXzOz0MOftV8EI9KyhqdOYBW84yYPEZGRxRN+t/WH4yNM7CdjL2YEQa/ZOOz2c698amvL9ImT4q0Vx/bjgRTk41Tcp08dKkvxP1gH9CkUXx33mJe8AJbTe5bZ0/pTnhpPj/k1+O/wfmjwVJok+i0QAAAABJRU5ErkJggg==" />
                                    </svg>
                                </div>

                                <?php
                                if ($settings['title']) :
                                    printf(
                                        '<%1$s %2$s>%3$s</%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        wp_kses_post($settings['title'])
                                    );
                                endif;
                                ?>

                                <div class="bd-faq-Subscribe-from p-relative mb-40">
                                    <!-- Start Contact Form -->
                                    <?php if (!empty($settings['tpcore_select_contact_form'])) : ?>
                                        <div class="form-wrapper">
                                            <?php echo do_shortcode('[contact-form-7  id="' . $settings['tpcore_select_contact_form'] . '"]'); ?>
                                        </div>
                                    <?php else : ?>
                                        <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'tpcore') . '</p></div>'; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="faq__happy-wapper">
                                    <?php if ($settings['number']) : ?>
                                        <div class="faq__happy-user">
                                            <span><?php echo wp_kses_post($settings['number']); ?></span>
                                            <h6><?php print esc_html__('Happy Users', 'businoz'); ?></h6>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($settings['description']) : ?>
                                        <div class="faq__happy-text">
                                            <p><?php echo wp_kses_post($settings['description']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Faq-area-end -->

        <?php elseif ($settings['designs'] === 'design_8') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-4 mb-30 bdevs-el-title');

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'bd-theme-4-btn-1 mb-50 bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <section class="bd-about__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <?php if (!empty($image)) : ?>
                                <div class="bd-about__image w-img mb-60">
                                    <img src="<?php echo esc_url($image); ?>" alt="about-7.png">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-about__box mb-60">
                                <div class="bd-section-title-4 mb-35 b">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bd-small__title-4 mb-15 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>
                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if ($settings['agency_sub_title']) : ?>
                                        <p class="bd-about__sub-title mb-20 bdevs-el-subtitle-agency"><?php echo wp_kses_post($settings['agency_sub_title']); ?></p>
                                    <?php endif; ?>
                                    <?php if ($settings['description']) : ?>
                                        <p class="bd-paragraph-title"><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                    printf(
                                        '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string('button'),
                                        esc_html($settings['button_text'])
                                    );
                                elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                    <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                    if ($settings['button_icon_position'] === 'before') : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                    <?php
                                    else : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>>
                                            <span><?php echo esc_html($settings['button_text']); ?></span>

                                            <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        </a>
                                <?php
                                    endif;
                                endif; ?>

                                <div class="bd-about__features-box">
                                    <?php if ($settings['about_info_title_one']) : ?>
                                        <div class="bd-about__features">
                                            <div class="bd-about-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px" height="30px">
                                                    <image x="0px" y="0px" width="32px" height="30px" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAeCAMAAAB61OwbAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKkJMKn///8ORw/DAAAAoXRSTlMAC4rg6ujhkxSFm+Te7NrB3+mRGySqwwcNTgUZlWdPr8Z9f7m3I3ga0O38VTH9b4f+wCFf40eDd6m9mcUq9x4rD7ISA3M5MpenPyd7DKD1Pkzy8LvZa/GrHBCi00A9aMcT9Pi4FgKlrO/z1SwY4naIBNcOIsSBjmp8nTqcZLZQvryCU8jCkr+kXmZlWfa6NN1LH2AmlAEKFTDlRBHM1jbmRnPIOf4AAAABYktHRKKw3d+MAAAAB3RJTUUH5gQdECAs4ECQjAAAAcJJREFUKM9jYGRiZmHFAVjY2DkYOBfiBVwM3PgV8DDw4pDh4xcAUcwMgtjlhYQZRESBtAAOBWLiEpJS0ny4FcgwyC6UY5DHUKCgqKikqAxkqEipqqlLaKAq0NRaqM0ABDq6C1l09YAMfQMUBYZGxiamDGZMjEYm5tIWCy2trBeiOJJfnYHBRpyBxdaOwZ6BwcECKgxTYODo5OziyuDmvnChhyeDl7cPo68BigI/f4aAhWwqugsDgxYuDA5ZGMpgFIaiYGF4RGTUwoXRejGxcfFA96gnuKNakZgkx2C2MDmFgSGVwSFtYTqDa0YmsoKs7EiGnFxNO4Y8Pub8goTCTB2GouISJAXpDByupQvLGMpBHE6GioWVVeoM1RAFfiBKmUHPduHCGoZacDym1i1cmMTEAPapIEN6fUMDfyNDU7NhSQBDhUJDQ0srg2dwm3UcQ14LUKadgSDo6Ozq6uqURZAonLhuhh78SY6VoRe/gniGvn68BkxgYJjYEScLBmAHQEAnRER20mTCnkACoECAgJYpU9Elp013mjETYXXmrNnTfZDlJyfPiZ+L7DhmhTn185AUuM33ywwTRMq2GZl+QQvAUgANQm5fS21vwQAAAABJRU5ErkJggg==" />
                                                </svg>
                                            </div>
                                            <div class="bd-about__features-text">
                                                <span><?php echo wp_kses_post($settings['about_info_title_one']); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($settings['about_info_title_two']) : ?>
                                        <div class="bd-about__features">
                                            <div class="bd-about-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px">
                                                    <image x="0px" y="0px" width="30px" height="30px" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAMAAAAM7l6QAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB11BMVEX9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP9WiP///9QQVZDAAAAm3RSTlMAcN3ihEBakLAxTRxohhdMOH786Qm7zBQs35YD0gbY7xUBtjlT6g3NVx7t4A8YbKTx+qt0HwQmQc6nXOTrZ5Lj6NdWEKa6Gwf+8Ly4due5o/UpiRNteAsF0AJfb5Gst4jygmr3z9P7yMU/rewaUsEMEZupPUIIl38KfKju9LXG+S9ixIeUstHDmDSx9sBgIVFV3NRUoq4lPmnlnOaRLfcAAAABYktHRJxxvMInAAAAB3RJTUUH5gULCyQrQimtSQAAAfpJREFUKM91U/lbUlEQPYWYqQGCCImoDxOCzLS0HglqakqlVFAQRaZFq5oVUWa2b2YuZXvzzzbz4n0gfcwPM2fO+ebembsAxbZtu6ECZc1IbJVl5R0iV/3P76yukVAr8i5BJrOloNZZyWbkWG8nanAwcO4manTptVLU5Gbkbm5p5aB4hGnLy3skafcK9NnEK03C7M3L/gAn+zqwv/NAV/fBQz3obWCi+7C+9xHVZqDg0T7SLBTup4HBY0OF3lzDrSNUZMdHO8a2zjYUYfrEyVPtIo+XTm6aYDbqBxynGZw5WzjJWJgX6mSyL66cO59IXvhXnroYMwOXOLHXI8ghjX6iyxhnOAlFVrkCrd1mdYr9NPg4fLjK8FrmunYYsEmYCt1gfzPpvJW5jTsMIzMtwgcwzV6dTVRJNie9WATdnb83yeE+UBmsiEPb8IE3lX2Ycz9i+BhYeLJY26v3739KSzW5Z0TPHfFBevGydPBX9BphWfcNRrjJrZYaS5NHfy1vadGrFInOd+999MGIZZGj+LhCasae1dXZAblQE1Ad/WRdXQMSPia61vPyhhRNJARmQtoTUoX5nJe1Sb/kBG4GFuS1rApj1PtqJFr6yiD5zRrxzDPIzhB9L9y4Ze6HhDUpqhPUs/HThVJLi7xS9peYRf5VVkbM8PtPspj4C9Usxmd3PAXgAAAAAElFTkSuQmCC" />
                                                </svg>
                                            </div>
                                            <div class="bd-about__features-text">
                                                <span><?php echo wp_kses_post($settings['about_info_title_two']); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        <?php elseif ($settings['designs'] === 'design_7') :

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bd-big__title-4 medium mb-10 bdevs-el-title');

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'edu-six-btn bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <section class="bd-process__area grey-bg pt-120 pb-60 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <?php if (!empty($image)) : ?>
                                <div class="bd-process-thumb-4 w-img mb-60">
                                    <img src="<?php echo esc_url($image); ?>" alt="process-5.png">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-proceess__list mb-60">
                                <div class="bd-section-title-4 mb-45 bdevs-el-content">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bdevs-el-subtitle bd-small__title-4 mb-15"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>
                                    <?php if ($settings['description']) : ?>
                                        <p class="bd-paragraph-title-4"><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>


                                <?php foreach ($settings['slides'] as $slide) :
                                    if (!empty($slide['image']['id'])) {
                                        $image = wp_get_attachment_image_url($slide['image']['id'], $settings['thumbnail_size']);
                                    }
                                ?>
                                    <div class="bd-process__list-item mb-30">
                                        <div class="bd-process__list-info">

                                            <?php if ($slide['image']) : ?>
                                                <div class="bd-process__list-icon">
                                                    <img src="<?php print esc_url($slide['image']['url']); ?>" alt="process-icon-6.png">
                                                </div>
                                            <?php endif; ?>

                                            <div class="bd-process__list-content">
                                                <?php if ($slide['subtitle']) : ?>
                                                    <span class="bdevs-el-fe-subtitle"><?php echo wp_kses_post($slide['subtitle']); ?></span>
                                                <?php endif; ?>
                                                <?php if ($slide['slide_url']) : ?>
                                                    <h3 class="bdevs-el-title"><a href="<?php echo esc_url($slide['slide_url']); ?>"><?php echo wp_kses_post($slide['title']); ?></a></h3>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="process__list-arrow">
                                            <a href="<?php echo esc_url($slide['slide_url']); ?>"><i class="fal fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['designs'] === 'design_6') :

            $title = wp_kses_post($settings['title']);

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image3']['id'])) {
                $image3 = wp_get_attachment_image_url($settings['image3']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image4']['id'])) {
                $image4 = wp_get_attachment_image_url($settings['image4']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

            <!-- Archivement-area-start -->
            <section class="bd-about__video__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6">
                            <div class="bd-archivement-wrapper mb-60">
                                <?php if (!empty($image)) : ?>
                                    <div class="bd-archivement__image w-img">
                                        <img src="<?php echo esc_url($image); ?>" alt="archivement-img">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="bd-archivement-box mb-60">
                                <div class="bd-acivement__title">
                                    <?php if ($settings['title']) : ?>
                                        <h3><?php echo wp_kses_post($settings['title']); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($settings['description']) : ?>
                                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="bd-archivement__img-item">
                                    <?php if (!empty($image2)) : ?>
                                        <div class="bd-acivement__single-img">
                                            <img src="<?php echo esc_url($image2); ?>" alt="archivement.png">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($image3)) : ?>
                                        <div class="bd-archivement__single-img">
                                            <img src="<?php echo esc_url($image3); ?>" alt="archivement.png">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($image4)) : ?>
                                        <div class="bd-archivement__single-img">
                                            <img src="<?php echo esc_url($image4); ?>" alt="archivement.png">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Archivement-area-end -->


        <?php elseif ($settings['designs'] === 'design_5') :

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['signature_img']['id'])) {
                $signature_img = wp_get_attachment_image_url($settings['signature_img']['id'], $settings['thumbnail_size']);
            }


            $this->add_render_attribute('title', 'class', 'bdevs-el-title');
            $this->add_render_attribute('title', 'data-wow-delay', '');

        ?>

            <!-- About-area-start -->
            <section class="bd-about__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-5 col-lg-5">
                            <div class="bd__about__wrap mb-30">
                                <?php if (!empty($image)) : ?>
                                    <div class="bd-about__image w-img">
                                        <img src="<?php echo esc_url($image); ?>" alt="about-img">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7">
                            <div class="bs__about-us__box mb-30">
                                <div class="bd-section__title-two common mb-75">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if ($settings['description']) : ?>
                                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="bd-features__contact style-2">
                                    <?php if ($settings['number']) : ?>
                                        <div class="bd-contact__text">
                                            <div class="call__icon f-left mr-15">
                                                <a href="tel:<?php echo esc_url($settings['number']); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/features/features-icon-1.png" alt="features-icon-1.png"></a>
                                            </div>
                                            <div class="call__title style-2 fix">
                                                <h3><a href="tel:<?php echo esc_url($settings['number']); ?>"><?php echo wp_kses_post($settings['number']); ?></a></h3>
                                                <span><?php print esc_html__('Phone Number', 'businoz'); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($signature_img)) : ?>
                                        <div class="bd-features__signature">
                                            <img src="<?php echo esc_url($signature_img); ?>" alt="features-signature">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About-area-start -->

        <?php elseif ($settings['designs'] === 'design_4') :

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image3']['id'])) {
                $image3 = wp_get_attachment_image_url($settings['image3']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['review_img']['id'])) {
                $review_img = wp_get_attachment_image_url($settings['review_img']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bd-big__title-3 medium mb-35 bdevs-el-title');
            $this->add_render_attribute('title', 'data-wow-delay', '');

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'bd-theme-3-btn-4 bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <!-- About-area-start -->
            <section class="bd-about__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-section_wrapper-3 p-relative mb-60">
                                <?php if (!empty($image)) : ?>
                                    <div class="bd-about_image_1">
                                        <img src="<?php echo esc_url($image); ?>" alt="about_4.png">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($image2)) : ?>
                                    <div class="bd-about_image_2 w-img">
                                        <img src="<?php echo esc_url($image2); ?>" alt="about_2.png">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($image3)) : ?>
                                    <div class="bd-about_image_3">
                                        <img src="<?php echo esc_url($image3); ?>" alt="about_5.png">
                                    </div>
                                <?php endif; ?>

                                <div class="bd-about_shape_experience">
                                    <h2><?php echo wp_kses_post($settings['number']); ?></h2>
                                    <span><?php echo wp_kses_post($settings['experience']); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-about__content-wrapper-3 mb-60">
                                <div class="bd-section__title-3">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bd-small__title-3 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                    <div class="about-section__border-3 pb-40"></div>

                                    <?php if ($settings['description']) : ?>
                                        <p class="bd-paragraph__title-3 mb-35"><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="bd-about__content-3 mb-30">
                                    <?php if ($settings['icon_title']) : ?>
                                        <div class="bd-about_item">
                                            <div class="bd-about_3_img">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_icon_5.png" alt="about_icon_5.png">
                                            </div>
                                            <div class="bd-about_3_text">
                                                <h4><?php echo wp_kses_post($settings['icon_title']); ?></h4>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="bd-about_item">
                                        <?php if (!empty($review_img)) : ?>
                                            <div class="bd-about_3_img">
                                                <img src="<?php echo esc_url($review_img); ?>" alt="about_6.png">
                                            </div>
                                        <?php endif; ?>
                                        <div class="bd-about_review">
                                            <h3><?php echo wp_kses_post($settings['number2']); ?></h3>
                                            <span><?php print esc_html__('Active Review', 'businoz'); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bd-about__btn">
                                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                        printf(
                                            '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string('button'),
                                            esc_html($settings['button_text'])
                                        );
                                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                        if ($settings['button_icon_position'] === 'before') : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                        <?php
                                        else : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                                <span><?php echo esc_html($settings['button_text']); ?></span>

                                                <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About-area-end -->


        <?php elseif ($settings['designs'] === 'design_3') :

            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['signature_img']['id'])) {
                $signature_img = wp_get_attachment_image_url($settings['signature_img']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

            <!-- Features-area-start -->
            <section class="bd-features__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-features__content__wrapper mb-60">
                                <div class="bd-section__title-two common mb-40 bdevs-el-content">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if ($settings['description']) : ?>
                                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="bd-features__content">
                                    <div class="bd-featureas__list mb-60">
                                        <ul>
                                            <?php foreach ($settings['slides'] as $slide) : ?>
                                                <li><span><?php echo wp_kses_post($slide['number']); ?></span><?php echo wp_kses_post($slide['title']); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="bd-features__contact mb-30">
                                        <?php if (!empty($settings['number'])) : ?>
                                            <div class="bd-contact__text">
                                                <div class="call__icon f-left mr-15">
                                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/features/features-icon-1.png" alt="features-icon-1.png">
                                                </div>

                                                <div class="call__title fix">
                                                    <h3><a href="tel:<?php echo esc_url($settings['number']); ?>"><?php echo wp_kses_post($settings['number']); ?></a></h3>
                                                    <span><?php print esc_html__('Phone Number', 'businoz'); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($signature_img)) : ?>
                                            <div class="bd-features__signature">
                                                <img src="<?php echo esc_url($signature_img); ?>" alt="features-signature">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-features__images__box mb-60 p-relative">
                                <?php if (!empty($image)) : ?>
                                    <div class="features__images-1 mb-20">
                                        <img src="<?php echo esc_url($image); ?>" alt="features-img-1">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($image2)) : ?>
                                    <div class="features__images-2">
                                        <img src="<?php echo esc_url($image2); ?>" alt="features-img-1">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['skills_number'])) : ?>
                                    <div class="features__progress-wrapper p-relative">
                                        <div class="bd-features__circle">
                                            <input type="text" class="knob" value="0" data-rel="<?php echo esc_attr($settings['skills_number']); ?>" data-linecap="round" data-width="130" data-height="130" data-bgcolor="#ECECEC" data-fgcolor="#ff4834" data-thickness=".12" data-readonly="true" disabled />
                                            <div class="bd-progress__text text-center">
                                                <h3><?php echo wp_kses_post($settings['skills_title']); ?></h3>
                                                <span><?php echo wp_kses_post($settings['skills_des']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Features-area-end -->


        <?php elseif ($settings['designs'] === 'design_2') :
            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

            $this->add_render_attribute('button', 'class', 'bd-home-2__btn-2 bdevs-el-btn');

            if (!empty($settings['button_link'])) {
                $this->add_link_attributes('button', $settings['button_link']);
            }

            $this->add_render_attribute('button2', 'class', 'bd-home-2__btn-3');

            if (!empty($settings['button_link2'])) {
                $this->add_link_attributes('button2', $settings['button_link2']);
            }

        ?>

            <!-- About-area-start -->
            <section class="bd-about__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-section__wrapper-2 p-relative mb-60">
                                <?php if (!empty($image)) : ?>
                                    <div class="bd-about__img-3">
                                        <img src="<?php echo esc_url($image); ?>" alt="about_1.png">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($image2)) : ?>
                                    <div class="bd-about__img-4 ">
                                        <img src="<?php echo esc_url($image2); ?>" alt="about_2.png">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['shape_switch'])) : ?>
                                    <div class="bd-about__shape-circle">
                                        <span></span>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_icon_4.png" alt="about_icon_4">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-about__content-wrapper-2 mb-60">
                                <div class="bd-section__title-two common mb-30">
                                    <?php if ($settings['sub_title']) : ?>
                                        <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if ($settings['description']) : ?>
                                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <div class="bd-about__content mb-40">
                                    <div class="bd-about__experience f-left mb-10">
                                        <h2><?php echo wp_kses_post($settings['number']); ?></h2>
                                        <span><?php echo wp_kses_post($settings['experience']); ?></span>
                                    </div>
                                    <div class="bd-about__list">
                                        <ul>
                                            <?php foreach ($settings['slides'] as $slide) : ?>
                                                <li><i class="far fa-check"></i><?php echo wp_kses_post($slide['title']); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                                <div class="bd-about__btn">
                                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                        printf(
                                            '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string('button'),
                                            esc_html($settings['button_text'])
                                        );
                                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                        if ($settings['button_icon_position'] === 'before') : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                        <?php
                                        else : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                                <span><?php echo esc_html($settings['button_text']); ?></span>

                                                <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif; ?>



                                    <?php if ($settings['button_text2'] && ((empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) && empty($settings['button_icon2']))) :
                                        printf(
                                            '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string('button2'),
                                            esc_html($settings['button_text2'])
                                        );
                                    elseif (empty($settings['button_text2']) && ((!empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) || !empty($settings['button_icon2']))) : ?>
                                        <a <?php $this->print_render_attribute_string('button2'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2'); ?></a>
                                        <?php elseif ($settings['button_text2'] && ((!empty($settings['button_selected_icon2']) || empty($settings['button_selected_icon2']['value'])) || !empty($settings['button_icon2']))) :
                                        if ($settings['button_icon_position2'] === 'before') : ?>
                                            <a <?php $this->print_render_attribute_string('button2'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2']); ?>
                                                <span><?php echo esc_html($settings['button_text2']); ?></span></a>
                                        <?php
                                        else : ?>
                                            <a <?php $this->print_render_attribute_string('button2'); ?>>
                                                <span><?php echo esc_html($settings['button_text2']); ?></span>

                                                <?php bdevs_elementor_render_icon($settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2']); ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About-area-end -->


        <?php else :
            if (!empty($settings['image']['id'])) {
                $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
            }

            if (!empty($settings['image2']['id'])) {
                $image2 = wp_get_attachment_image_url($settings['image2']['id'], $settings['thumbnail_size']);
            }

            $this->add_render_attribute('title', 'class', 'bd-big__title mb-15 bdevs-el-title');

            $this->add_render_attribute('button', 'class', 'bd-theme__btn-3 bdevs-el-btn');

            if (!empty($settings['button_link'])) {
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

            <!-- About-area-start -->
            <section class="bd-about__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-section__wrapper p-relative mb-60">
                                <?php if (!empty($image)) : ?>
                                    <div class="bd-about__thumb-1">
                                        <img src="<?php echo esc_url($image); ?>" alt="about_img_1">
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($image2)) : ?>
                                    <div class="bd-about__thumb-2">
                                        <img src="<?php echo esc_url($image2); ?>" alt="about_img_1">
                                    </div>
                                <?php endif; ?>

                                <?php if ($settings['leadership']) : ?>
                                    <div class="bd-about__shape-1">
                                        <i class="fa-regular fa-arrow-up-long"></i>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_icon_1.png" alt="about_icon_1">
                                        <span><?php echo wp_kses_post($settings['leadership']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['shape_switch'])) : ?>
                                    <div class="bd-about__shape-2 d-none d-sm-block">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_icon_2.png" alt="about_icon_2">
                                    </div>
                                    <div class="bd-about__shape-3 d-none d-md-block">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_shape_large.png" alt="about_shape_large">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="bd-about__content-wrapper-2 mb-60">
                                <div class="bd-section__title p-relative z-index-11 mb-45">
                                    <?php if ($settings['back_title']) : ?>
                                        <span class="bd-stroke__title s-2"><?php echo wp_kses_post($settings['back_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if ($settings['sub_title']) : ?>
                                        <strong class="bd-small__title"><?php echo wp_kses_post($settings['sub_title']); ?></strong>
                                    <?php endif; ?>

                                    <?php
                                    if ($settings['title']) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            wp_kses_post($settings['title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if ($settings['description']) : ?>
                                        <p class="title-paraghrap"><?php echo wp_kses_post($settings['description']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <?php if ($settings['icon_title']) : ?>
                                    <div class="bd-about__content mb-60">
                                        <div class="bd-about__icon">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about_icon_3.png" alt="about_icon_3">
                                        </div>
                                        <div class="bd-about__title fix">
                                            <h3><?php echo wp_kses_post($settings['icon_title']); ?></h3>
                                            <p><?php echo wp_kses_post($settings['icon_description']); ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="bd-about__founder">
                                    <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                        printf(
                                            '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string('button'),
                                            esc_html($settings['button_text'])
                                        );
                                    elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                        <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                                        <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                        if ($settings['button_icon_position'] === 'before') : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                                <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                        <?php
                                        else : ?>
                                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                                <span><?php echo esc_html($settings['button_text']); ?></span>

                                                <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                            </a>
                                    <?php
                                        endif;
                                    endif; ?>

                                    <div class="founder__text">
                                        <h3><?php echo wp_kses_post($settings['about_author_title']); ?> </h3>
                                        <span><?php echo wp_kses_post($settings['about_author_des']); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- About-area-end -->


        <?php endif; ?>
<?php
    }
}
