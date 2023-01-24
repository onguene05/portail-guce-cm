<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class PostList extends GenericWidget {

    /**
     * Get widget name.
     *
     * Retrieve Generic Elements widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'generic-postlist';
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
        return esc_html__( 'Post List', 'generic-elements' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/generic-elements/post-list/';
    }

    public function get_script_depends() {
        return [ 'generic-element-js','bootstrap' ];
    }

    public function get_style_depends() {
        return [ 'generic-element-css','bootstrap','fontawesome', 'flaticon' ];
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
        return [ 'generic-elements' ];
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

    // register_content_controls
    protected function register_content_controls() {
        $this->post_list_content_controls();
        $this->post_list_settings_controls();
    }

    // post_list_content_controls
    protected function post_list_content_controls(){
        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => esc_html__('List', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => esc_html__('Source', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        $this->add_control(
            'show_post_by',
            [
                'label' => esc_html__('Show post by:', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => esc_html__('Recent Post', 'generic-elements'),
                    'selected' => esc_html__('Selected Post', 'generic-elements'),
                ],
                'condition' => [
                    'post_type' => ['post'],
                ],

            ]
        );

        $this->add_control(
            'manual_include',
            [
                'label' => esc_html__('Posts', 'generic-elements'),
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
                'label' => esc_html__('Item Limit', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $this->end_controls_section();
    }

    // post_list_settings_controls
    protected function post_list_settings_controls(){
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__('Settings', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('Layout', 'generic-elements'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'list',
                'options' => [
                    'list' => [
                        'title' => esc_html__('List', 'generic-elements'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'inline' => [
                        'title' => esc_html__('Inline', 'generic-elements'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => esc_html__('Featured Image', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'generic-elements'),
                'label_off' => esc_html__('Hide', 'generic-elements'),
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
                'label' => esc_html__('List Icon', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'generic-elements'),
                'label_off' => esc_html__('Hide', 'generic-elements'),
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
                'label' => esc_html__('Icon', 'generic-elements'),
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
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'generic-elements'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'generic-elements'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'generic-elements'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'generic-elements'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'generic-elements'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'generic-elements'),
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
                'label'     => esc_html__( 'Alignment', 'generic-elements' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'generic-elements' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'generic-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'generic-elements' ),
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


    // register_style_controls
    protected function register_style_controls()
    {
        $this-> blog_list();
        $this-> blog_title();
        $this-> blog_meta();
        $this-> blog_author();
        $this-> blog_button();
    }

    public function blog_list() {
        $this->start_controls_section(
            '_section_post_list_style',
            [
                'label' => esc_html__('List', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_item_common',
            [
                'label' => esc_html__('Common', 'generic-elements'),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => esc_html__('Margin', 'generic-elements'),
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
                'label' => esc_html__('Padding', 'generic-elements'),
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
                'label' => esc_html__('Background', 'generic-elements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bd-blog-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => esc_html__('Box Shadow', 'generic-elements'),
                'selector' => '{{WRAPPER}} .bd-blog',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => esc_html__('Border', 'generic-elements'),
                'selector' => '{{WRAPPER}} .bd-blog',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bd-blog' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function blog_title() {
         //Title Style
         $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => esc_html__('Title', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .generic-el-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
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

    public function blog_meta() {
         //Blog Meta
         $this->start_controls_section(
            '_section_blog_meta_style',
            [
                'label' => esc_html__('Blog Meta', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_typography',
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .generic-el-blog-meta',
            ]
        );

        $this->start_controls_tabs('blog_meta_title_tabs');
        $this->start_controls_tab(
            'blog_meta_normal_tab',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__('Meta Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-blog-meta ul li, .bd-blog-meta ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'blog_meta_icon_color',
            [
                'label' => esc_html__('Meta Icon Color', 'generic-elements'),
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
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'blog_meta_hover_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
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

    public function blog_author() {
         //author Style
         $this->start_controls_section(
            '_section_post_list_author_style',
            [
                'label' => esc_html__('Author', 'generic-elements'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .bd-blog-author-info-title',
            ]
        );


        $this->add_control(
            'autor_name_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
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
                'label' => esc_html__('Icon & Feature Image', 'generic-elements'),
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
                'label' => esc_html__('Color', 'generic-elements'),
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
                'label' => esc_html__('Font Size', 'generic-elements'),
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
                'label' => esc_html__('Line Height', 'generic-elements'),
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
                'label' => esc_html__('Image Width', 'generic-elements'),
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
                'label' => esc_html__('Border', 'generic-elements'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-item a img',
                'condition' => [
                    'feature_image' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => esc_html__('Border Radius', 'generic-elements'),
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
                'label' => esc_html__('Margin Right', 'generic-elements'),
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
                'label' => esc_html__('Meta', 'generic-elements'),
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
                'label' => esc_html__('Typography', 'generic-elements'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-meta-wrap span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
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
                'label' => esc_html__('Space Between', 'generic-elements'),
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
                'label' => esc_html__('Margin', 'generic-elements'),
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
                'label' => esc_html__('Meta Icon', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__('Color', 'generic-elements'),
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
                'label' => esc_html__('Space Between', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function blog_button() {
        // Button style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Title', 'generic-elements' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'SEE MORE', 'generic-elements' ),
				'placeholder' => esc_html__( 'Type text here', 'generic-elements' ),
			]
		);

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .generic-el-btn'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .generic-el-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .generic-el-btn',
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
                'label' => esc_html__( 'Normal', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_service_button_hover',
            [
                'label' => esc_html__( 'Hover', 'generic-elements' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn a:hover, {{WRAPPER}} .generic-el-btn a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn a:hover, {{WRAPPER}} .generic-el-btn a:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    // Render Function
    protected function render() {
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

        $this->add_render_attribute('title', 'class', 'item_title');

        $this->add_render_attribute('title', 'class', 'bd-blog-title2 mb-40 generic-el-title');
        $title = wp_kses_post( $settings['title'] ?? '' );
        if (!empty($posts)): ?>

        <section class="bd-blog-area">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $inx => $post): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="bd-blog mb-30">
                                <?php if ( ('yes' === $feature_image ) && !empty(get_the_post_thumbnail_url($post->ID, 'full'))): ?>
                                    <div class="bd-blog-img">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><img src="<?php print get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt=""></a>
                                    </div>
                                <?php endif; ?>
                                <div class="bd-blog-text">
                                    <div class="bd-blog-meta mb-15">
                                        <ul>
                                            <li><i class="flaticon-calendar"></i><?php echo get_the_date("M d, Y"); ?></li>
                                            <li><a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><i class="flaticon-chat"></i><?php echo get_comments_number( $post->ID ); ?> Comments</a></li>
                                        </ul>
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
                                    <div class="bd-blog-author">
                                        <div class="bd-blog-author-info">
                                            <?php echo get_avatar( $post->post_author ); ?>
                                            <h6 class="bd-blog-author-info-title"><?php echo get_the_author_meta( 'nicename', $post->post_author );  ?></h6>
                                        </div>
                                        <div class="bd-blog-author-link">
                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php print esc_html( $button_text ?? '' ) ; ?> <i class="fal fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php
        else:
            printf('%1$s %2$s %3$s',
                esc_html__('No ', 'generic-elements'),
                esc_html($settings['post_type']),
                esc_html__('Found', 'generic-elements')
            );
        endif;
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
