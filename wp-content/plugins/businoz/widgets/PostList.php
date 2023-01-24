<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class PostList extends \Generic\Elements\GenericWidget {

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
    public function get_name() {
        return 'cust-post-list';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__( 'Post List', 'bdevs-elementor' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/bdevselementor/post-list/';
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
    public function get_icon() {
        return ' eicon-post-list gen-icon';
    }

    public function get_keywords() {
        return [ 'post', 'post-list', 'post-lists' ];
    }

    public function get_categories() {
        return [ 'bdevs-elementor' ];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public function get_post_types( $args = array() ){
        $default = [
            'public' => true,
            'show_in_nav_menus' => true
        ];
        $args = array_merge($default, $args);
        $post_types = get_post_types($args, 'objects');
        $post_types = wp_list_pluck($post_types, 'label', 'name');

        if (!empty($diff_key)) {
            $post_types = array_diff_key($post_types, $diff_key);
        }
        return $post_types;
    }

    protected function register_content_controls()
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
                    'designs' => ['design_6'],
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
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'title_tag2',
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
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align2',
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


        // List
        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => esc_html__('List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Source', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        $this->add_control(
            'show_post_by',
            [
                'label' => esc_html__('Show post by:', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => esc_html__('Recent Post', 'bdevs-elementor'),
                    'selected' => esc_html__('Selected Post', 'bdevs-elementor'),
                ],
                'condition' => [
                    'post_type' => ['post'],
                ],

            ]
        );

        $this->add_control(
            'manual_include',
            [
                'label' => esc_html__('Posts', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'show_label' => false,
                'label_block' => true,
                'multiple' => true,
                'options' => $this->get_posts_list(),
                'condition' => [
                    'show_post_by' => ['selected'],
                    'post_type' => ['post'],
                ],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Item Limit', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $this->end_controls_section();

        //Settings
        
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__('Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('Layout', 'bdevs-elementor'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'list',
                'options' => [
                    'list' => [
                        'title' => esc_html__('List', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__('Inline', 'bdevs-elementor'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => esc_html__('Featured Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_image',
                'default' => 'thumbnail',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'feature_image' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'list_icon',
            [
                'label' => esc_html__('List Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'feature_image!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'far fa-check-circle',
                    'library' => 'reguler'
                ],
                'condition' => [
                    'list_icon' => 'yes',
                    'feature_image!' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'content',
            [
                'label' => __('Content', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'design_style' => ['style_4', 'style_5'],
                ]
            ]
        );

        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_4', 'style_5'],
                ]
            ]
        );

        $this->add_control(
            'meta',
            [
                'label' => __('Show Meta', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'author_meta',
            [
                'label' => __('Author', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'author_icon',
            [
                'label' => __('Author Icon', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-user',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'author_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'date_meta',
            [
                'label' => __('Date', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label' => __('Date Icon', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-calendar-check',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'date_meta' => 'yes',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'category_meta',
            [
                'label' => __('Category', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label' => __('Category Icon', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-folder-open',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'meta' => 'yes',
                    'category_meta' => 'yes',
                    'post_type' => 'post',
                    'design_style' => ['style_1', 'style_2', 'style_3']
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'bdevs-elementor'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h4',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'item_align',
            [
                'label'     => esc_html__( 'Alignment', 'bdevs-elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'bdevs-elementor' ),
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
    }

    protected function register_style_controls()
    {
        $this->design_style();
        $this-> list();
        $this-> title();
        $this-> gen_blog_meta();
        $this-> author();
        $this-> button();
    }

    public function design_style(){
        $this->start_controls_section(
            '_section_design',
            [
                'label' => __( 'Presets', 'bdevs-elementor' ),
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

        $this->end_controls_section();
    }

    public function list() {
        $this->start_controls_section(
            '_section_post_list_style',
            [
                'label' => esc_html__('List', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_item_common',
            [
                'label' => esc_html__('Common', 'bdevs-elementor'),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => esc_html__('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => esc_html__('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'list_item_background',
                'label' => esc_html__('Background', 'bdevs-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bd-blog-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => esc_html__('Box Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bd-blog',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => esc_html__('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bd-blog',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bd-blog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function title() {
         //Title Style
         $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => esc_html__('Title', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-area .bd-blog-title2:hover > a ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    public function gen_blog_meta() {
         //Blog Meta
         $this->start_controls_section(
            '_section_blog_meta_style',
            [
                'label' => esc_html__('Blog Meta', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_typography',
                'label' => esc_html__('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevs-el-blog-meta',
            ]
        );

        $this->start_controls_tabs('blog_meta_title_tabs');
        $this->start_controls_tab(
            'blog_meta_normal_tab',
            [
                'label' => esc_html__('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__('Meta Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-meta ul li, .bd-blog-meta ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'blog_meta_icon_color',
            [
                'label' => esc_html__('Meta Icon Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-meta ul li i, .bd-blog-meta ul li a i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'blog_meta_hover_tab',
            [
                'label' => esc_html__('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'blog_meta_hover_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-meta ul li a:hover ' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function author() {
         //author Style
         $this->start_controls_section(
            '_section_post_list_author_style',
            [
                'label' => esc_html__('Author', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => esc_html__('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bd-blog-author-info-title',
            ]
        );


        $this->add_control(
            'autor_name_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-author-info-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function icon_and_feature() {

        //List Icon Style
        $this->start_controls_section(
            '_section_list_icon_feature_iamge_style',
            [
                'label' => esc_html__('Icon & Feature Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'feature_image',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'list_icon',
                            'operator' => '==',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Font Size', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => esc_html__('Line Height', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image!' => 'yes',
                    'list_icon' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => esc_html__('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-item a img',
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => esc_html__('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin_right',
            [
                'label' => esc_html__('Margin Right', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} span.bdevselement-post-list-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevselement-post-list-item a img' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //List Meta Style
        $this->start_controls_section(
            '_section_list_meta_style',
            [
                'label' => esc_html__('Meta', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'meta' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-meta-wrap span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_space',
            [
                'label' => esc_html__('Space Between', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span:last-child' => 'margin-right: 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_box_margin',
            [
                'label' => esc_html__('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_icon_heading',
            [
                'label' => esc_html__('Meta Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_icon_space',
            [
                'label' => esc_html__('Space Between', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function button() {
        // Button style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Title', 'bdevs-elementor' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Lire plus', 'bdevs-elementor' ),
				'placeholder' => esc_html__( 'Type text here', 'bdevs-elementor' ),
			]
		);

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-el-btn'
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
                'label' => esc_html__( 'Border Radius', 'bdevs-elementor' ),
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
                'label' => esc_html__( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_service_button_hover',
            [
                'label' => esc_html__( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn a:hover, {{WRAPPER}} .bdevs-el-btn a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn a:hover, {{WRAPPER}} .bdevs-el-btn a:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'bdevs-elementor' ),
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
        extract($settings);

        if (!$settings['post_type']) return;
        $args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
        ];
        if ('recent' === $settings['show_post_by']) {
            $args['posts_per_page'] = $settings['posts_per_page'];
        }

        $selected_post_type = 'selected_list_' . $settings['post_type'];

        $customize_title = [];

        if ('selected' === $settings['show_post_by'] ) {

            $args = array(
                'post_type' => $post_type,
                'post__in' => $manual_include
            );
            $posts = get_posts($args);
        } else {
            $posts = get_posts($args);
        }

        ?>


        <?php if ($settings['designs'] === 'design_5'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bd-blog__text bdevs-el-title');

        ?>



        <!-- Blog-area-start -->
        <section class="bd-blog__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $inx => $post): 
                        $categories = get_the_category($post->ID);
                    ?> 
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="bd-blog__style-3">
                            <div class="bd-blog__box p-relative mb-30">
                                <?php if ( ('yes' === $feature_image ) && !empty(get_the_post_thumbnail_url($post->ID, 'full'))): ?>
                                <div class="bd-blog__image w-img">
                                    <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="blog-3.jpg"></a>
                                </div>
                                <?php endif; ?>

                                <div class="bd-blog__content">
                                    <div class="bd-blog__title">
                                       <span><?php echo get_the_date("M d, Y"); ?></span>
                                       <h6>
                                            <a href="<?php print esc_url(get_category_link( current($categories)->term_id)); ?>">
                                            <?php if ($settings['category_icon']):
                                                Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                            endif; 
                                            echo esc_html( current($categories)->name ); ?>
                                            </a>
                                       </h6>
                                    </div>

                                    <?php $title = $post->post_title;
                                    if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                        $title = $customize_title[$post->ID];
                                    }
                                    printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                        tag_escape($settings['title_tag']),
                                        $this->get_render_attribute_string('title'),
                                        esc_html($title),
                                        esc_url(get_the_permalink($post->ID))
                                    ); ?>

                                    <a class="blog__btn-4" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php print esc_html__( 'Lire plus', 'businoz' );?> <i class="fa-regular fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Blog-area-end -->


        <?php elseif ($settings['designs'] === 'design_4'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>



        <!-- Blog-area-start -->
        <section class="bd-blog__area wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $inx => $post): 
                        $categories = get_the_category($post->ID);
                    ?> 
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="bd-blog__wrapper-3 p-relative mb-30">
                            <div class="bd-blog__title two">
                                <span><?php echo get_the_date("M d, Y"); ?></span>
                                <h6>
                                    <a href="<?php print esc_url(get_category_link( current($categories)->term_id)); ?>">
                                    <?php if ($settings['category_icon']):
                                        Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                    endif; 
                                    echo esc_html( current($categories)->name ); ?>
                                    </a>
                                </h6>
                            </div>
                            <div class="bd-blog__content-3">
                                <?php $title = $post->post_title;
                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                    $title = $customize_title[$post->ID];
                                }
                                printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    esc_html($title),
                                    esc_url(get_the_permalink($post->ID))
                                ); ?>

                                <p><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?> </p>
                            </div>
                            <a class="blog__btn-3" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php print esc_html__( 'Lire plus', 'businoz' );?> <i class="fa-regular fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Blog-area-start -->


        <?php elseif ($settings['designs'] === 'design_3'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

        <div class="bd-blog__style-2 blog-irc mb-60">
            <?php foreach ($posts as $inx => $post): 
                $categories = get_the_category($post->ID);
            ?> 
            <div class="bd-blog__wrapper">
                <?php if ( ('yes' === $feature_image ) && !empty(get_the_post_thumbnail_url($post->ID, 'full'))): ?>
                <div class="bd-blog__thumb bd-blog__thumb2">
                    <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="blog-1"></a>
                </div>
                <?php endif; ?>

                <div class="bd-blog__content">
                    <div class="bd-blog__title">
                        <span class="blog-sm__title"><?php echo get_the_date("M d, Y"); ?></span>
                        <h6><a href="<?php print esc_url(get_category_link( current($categories)->term_id)); ?>">
                        <?php if ($settings['category_icon']):
                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                        endif; 
                        echo esc_html( current($categories)->name ); ?>
                        </a></h6>
                    </div>

                    <div class="bd-blog__title__inner">
                        <?php $title = $post->post_title;
                        if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                            $title = $customize_title[$post->ID];
                        }
                        printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            esc_html($title),
                            esc_url(get_the_permalink($post->ID))
                        ); ?>
                    </div>
                    <div class="bd-blog__meta">
                       <div class="thumb">
                          <?php echo get_avatar( $post->post_author ); ?>
                       </div>

                       <div class="text">
                            <h5><?php echo get_the_author_meta( 'nicename', $post->post_author );  ?></h5>
                       </div>
                    </div>
                    <div class="bd-blog__footer">
                        <div class="read__more">
                          <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php print esc_html__( 'Lire plus', 'businoz' );?></a>
                        </div>

                       <div class="comments">
                          <span><i class="fas fa-comments"></i><?php echo get_comments_number( $post->ID ); ?> <?php print esc_html__( 'Comments', 'businoz' );?></span>
                       </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>


        <?php elseif ($settings['designs'] === 'design_2'):

            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

        <div class="bd-small__blog">
            <?php foreach ($posts as $inx => $post): 
                $categories = get_the_category($post->ID);
            ?> 
            <div class="bd-small__blog-item p-relative mb-60">
                <?php if ( ('yes' === $feature_image ) && !empty(get_the_post_thumbnail_url($post->ID, 'full'))): ?>
                <div class="bd-small__blog-thumb">
                   <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="blog-4.png"></a>
                </div>
                <?php endif; ?>
                <div class="bd-small__blog-content">
                   <div class="bd-blog__title">
                      <span><?php echo get_the_date("M d, Y"); ?></span>

                      <h6>
                        <a href="<?php print esc_url(get_category_link( current($categories)->term_id)); ?>">
                        <?php if ($settings['category_icon']):
                            Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                        endif; 
                        echo esc_html( current($categories)->name ); ?>
                        </a>
                      </h6>
                   </div>
                   <div class="bd-small__blog-inner">
                        <?php $title = $post->post_title;
                        if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                            $title = $customize_title[$post->ID];
                        }
                        printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            esc_html($title),
                            esc_url(get_the_permalink($post->ID))
                        ); ?>
                   </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>


        <?php else:
            $this->add_render_attribute('title', 'class', 'item_title');
            $this->add_render_attribute('title', 'class', 'lv-blog-box-title bdevs-el-title');
            $title = wp_kses_post( $settings['title'] ?? '' );
            if (!empty($posts)):
        ?>

        <!-- Blog-area-start -->
        <section class="bd-blog__area  wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $inx => $post): 
                        $categories = get_the_category($post->ID);
                    ?> 
                    <div class="col-xl-6 col-lg-6">
                        <div class="bd-blog__wrapper style-2 mb-30">
                            <?php if ( ('yes' === $feature_image ) && !empty(get_the_post_thumbnail_url($post->ID, 'full'))): ?>
                            <div class="bd-blog__thumb bd-blog__thumb2 p-relative">
                                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="blog-1"></a>
                                <div class="bd-blog__small__text">

                                   <h5><a href="<?php print esc_url(get_category_link( current($categories)->term_id)); ?>">
                                    <?php if ($settings['category_icon']):
                                        Icons_Manager::render_icon($settings['category_icon'], ['aria-hidden' => 'true']);
                                    endif; 
                                    echo esc_html( current($categories)->name ); ?>
                                    </a></h5>

                                   <span><a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><i class="fal fa-share"></i></a></span>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="bd-blog__content">
                                <span class="blog-sm__title"><?php echo get_the_date("M d, Y"); ?></span>

                                <?php $title = $post->post_title;
                                if ('selected' === $settings['show_post_by'] && array_key_exists($post->ID, $customize_title)) {
                                    $title = $customize_title[$post->ID];
                                }
                                printf('<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape($settings['title_tag']),
                                    $this->get_render_attribute_string('title'),
                                    esc_html($title),
                                    esc_url(get_the_permalink($post->ID))
                                ); ?>

                                <div class="bd-blog__meta">
                                   <div class="thumb">
                                      <?php echo get_avatar( $post->post_author ); ?>
                                   </div>

                                   <div class="text">
                                        <h5><?php echo get_the_author_meta( 'nicename', $post->post_author );  ?></h5>
                                   </div>
                                </div>
                                <div class="bd-blog__footer">
                                    <div class="read__more">
                                      <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php print esc_html__( 'Lire plus', 'businoz' );?></a>
                                    </div>

                                   <div class="comments">
                                      <span><i class="fas fa-comments"></i><?php echo get_comments_number( $post->ID ); ?> <?php print esc_html__( 'Comments', 'businoz' );?></span>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Blog-area-start -->

        <?php
        else:
            printf('%1$s %2$s %3$s',
                esc_html__('No ', 'bdevs-elementor'),
                esc_html($settings['post_type']),
                esc_html__('Found', 'bdevs-elementor')
            );
        endif; ?>
        <?php endif;
    }

    public function get_posts_list() {

        $list = get_posts(
            array(
                'post_type' => 'post',
                'posts_per_page' => -1,
            )
        );

        $options = array();

        if (!empty($list) && !is_wp_error($list)) {
            foreach ($list as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }
}
