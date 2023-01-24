<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class EventList extends \Generic\Elements\GenericWidget {

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
        return 'cust-event-list';
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
        return __('Event List', 'bdevs-elementor');
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/event-list/';
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
        return 'eicon-filter';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'event-list', 'list', 'news'];
    }
    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public function get_post_types()
    {
        $post_types = get_post_types([], ['elementor_library', 'attachment']);
        return $post_types;
    }

    protected function register_content_controls()
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
                'label' => __('designs', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'design_1' => __('Design 1', 'bdevs-elementor'),
                    'design_2' => __('Design 2', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1']
                ]
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
                'condition' => [
                    'designs' => ['design_3']
                ]
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
                    'designs' => ['design_3']
                ]
            ]
        );

        $this->add_control(
            's_title_tag',
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
                'default' => 'h4',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            's_align',
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
                    '{{WRAPPER}} .section__title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1','design_2'],
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Get ticket', 'bdevs-elementor'),
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        $this->add_control(
            'show_post_by',
            [
                'label' => __('Show post by:', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent',
                'options' => [
                    'recent' => __('Recent Post', 'bdevs-elementor'),
                    'selected' => __('Selected Post', 'bdevs-elementor'),
                ],

            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Item Limit', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
                'condition' => [
                    'show_post_by' => ['recent']
                ]
            ]
        );

        $repeater = [];

        foreach ($this->get_post_types() as $key => $value) {

            $repeater[$key] = new \Elementor\Repeater();

            $repeater[$key]->add_control(
                'title',
                [
                    'label' => __('Title', 'bdevs-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __('Customize Title', 'bdevs-elementor'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_short_text',
                [
                    'label' => __('Short Content', 'bdevs-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'placeholder' => __('Short Content', 'bdevs-elementor'),
                    'rows' => 3,
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'list_btn_text',
                [
                    'label' => __('BTN Text', 'bdevs-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => __('Read More', 'bdevs-elementor'),
                    'placeholder' => __('Link Text', 'bdevs-elementor'),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $repeater[$key]->add_control(
                'post_id',
                [
                    'label' => __('Select ', 'bdevs-elementor') ,
                    'label_block' => true,
                    'multiple' => false,
                    'placeholder' => 'Search ',
                    'data_options' => [
                        'post_type' => $key,
                        'action' => 'bdevs_element_post_list_query'
                    ],
                ]
            );

            $this->add_control(
                'selected_list_' . $key,
                [
                    'label' => '',
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater[$key]->get_controls(),
                    'title_field' => '{{ title }}',
                    'condition' => [
                        'show_post_by' => 'selected',
                        'post_type' => $key
                    ],
                ]
            );
        }

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_post_list_style',
            [
                'label' => __('List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_common',
            [
                'label' => __('Common', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'list_item_margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .event-tour' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .event-tour' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'list_item_background',
                'label' => __('Background', 'bdevs-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .event-tour',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => __('Box Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list .bdevselement-post-list-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => __('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .event-tour',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .event-tour' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );


$this->end_controls_section();
        //Title Style
        $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
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
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        
        //List Meta Style
        $this->start_controls_section(
            '_section_list_meta_style',
            [
                'label' => __('Meta', 'bdevs-elementor'),
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
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-list-meta-wrap span',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
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
                'label' => __('Space Between', 'bdevs-elementor'),
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
                'label' => __('Margin', 'bdevs-elementor'),
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
                'label' => __('Meta Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
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
                'label' => __('Space Between', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-list-meta-wrap span i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

                // Button style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-btn',
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
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_service_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'border-color: {{VALUE}};',
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
        $ids = [];
        if ('selected' === $settings['show_post_by']) {
            $args['posts_per_page'] = -1;
            $lists = $settings['selected_list_' . $settings['post_type']];
            if (!empty($lists)) {
                foreach ($lists as $index => $value) {
                    $post_id = !empty($value['post_id']) ? $value['post_id'] : 0;
                    $ids[] = $post_id;
                    if ($value['title']) $customize_title[$post_id] = $value['title'];
                }
            }
            $args['post__in'] = (array)$ids;
            $args['orderby'] = 'post__in';
        }

        if ('selected' === $settings['show_post_by'] && empty($ids)) {
            $posts = [];
        } else {
            $posts = get_posts($args);
        }

        $this->add_render_attribute('title', 'class', 'item_title');
        
        if ( $settings['designs'] == 'design_2'): 
            $this->add_render_attribute('title', 'class', 'events__title bdevs-el-title');
        ?>

        <div class="event-ara">

        <?php foreach ($posts as $inx => $post):
           $date_text = function_exists('get_field') ? get_field('date_text',$post->ID) : '';
           $event_start_time = function_exists('get_field') ? get_field('event_start_time',$post->ID) : '';
           $address_text = function_exists('get_field') ? get_field('address_text',$post->ID) : '';
           $event_start_date = function_exists('get_field') ? get_field('event_start_date',$post->ID) : '';
           $audience_joined = function_exists('get_field') ? get_field('audience_joined',$post->ID) : '';
         ?>
          <div class="single-item mb-30">
            <div class="event_date f-left">
                <div class="event_date_inner">
                   <?php if (!empty($date_text)) : ?>
                   <h4><?php echo esc_html($date_text); ?></h4>
                   <?php endif; ?>
                   <?php if (!empty($event_start_date)) : ?>
                   <span><?php echo esc_html($event_start_date); ?></span>
                   <?php endif; ?>
                </div>
             </div>
             <div class="event_info">
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
                <div class="event-detalis d-flex align-items-center">
                    <?php if (!empty($event_start_time)) : ?>
                   <div class="event-time mr-30 d-flex align-items-center">
                      <i class="flaticon-clock-1"></i>
                      <span><?php echo esc_html($event_start_time); ?></span>
                   </div>
                   <?php endif; ?>
                   <?php if (!empty($address_text)) : ?>
                   <div class="event-location d-flex align-items-centere">
                      <i class="flaticon-pin"></i>
                      <span><?php echo esc_html($address_text); ?></span>
                   </div>
                   <?php endif; ?>
                </div>
                <div class="event-aduence d-flex align-items-center">
                   <div class="aduence-thumb">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/event/event-01.png" alt="event-thumb">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/event/event-02.png" alt="event-thumb">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/event/event-03.png" alt="event-thumb">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/event/event-04.png" alt="event-thumb">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/event/event-05.png" alt="event-thumb">
                   </div>
                   <?php if (!empty($audience_joined)) : ?>
                   <div class="adence-info">
                      <span><?php echo esc_html($audience_joined); ?></span>
                   </div>
                   <?php endif; ?>
                </div>
             </div>
             <?php if(!empty($settings['button_text'])): ?>
             <div class="get-ticket-btn">
                <a class="get-btn bdevs-btn" href="<?php echo esc_url(get_the_permalink($post->ID)); ?>"><?php echo wp_kses_post($settings['button_text']); ?></a>
             </div>
             <?php endif; ?>
          </div>
        <?php endforeach; ?>
        </div>

        <?php else:
            $this->add_render_attribute('title', 'class', 'events__title bdevs-el-title');
            $title = wp_kses_post( $settings['title'] );
            if (!empty($posts)): ?>


            <div class="event-areaa">
                <div class="event-shape-wrapper position-relative">
                </div>
                        <div class="section-title mb-50">
                            <?php if ($settings['title']): ?>
                            <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                            <?php endif; ?>
                        </div>

                         <?php foreach ($posts as $inx => $post):
                           $date_text = function_exists('get_field') ? get_field('date_text',$post->ID) : '';
                           $event_start_time = function_exists('get_field') ? get_field('event_start_time',$post->ID) : '';
                           $address_text = function_exists('get_field') ? get_field('address_text',$post->ID) : '';
                           $event_start_date = function_exists('get_field') ? get_field('event_start_date',$post->ID) : '';
                           $address_text = function_exists('get_field') ? get_field('address_text',$post->ID) : '';
                          ?>

                    <div class="current-event-box mb-15">
                        <div class="current-event-date d-flex position-relative">
                            <div class="event-date-wrapper">
                                <?php if (!empty($date_text)) : ?>
                                <span class="event-date"><?php echo esc_html($date_text); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($event_start_date)) : ?>
                                <span class="event-month"><?php echo esc_html($event_start_date); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="event-tour">
                                <div class="event-box-text">
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
                                    <?php if (!empty($event_start_time)) : ?>
                                    <span><i class="fal fa-clock"></i><?php echo esc_html($event_start_time); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($address_text)) : ?>
                                    <span><i class="flaticon-place"></i><?php echo esc_html($address_text); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($settings['button_text'])): ?>
                                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>" class="event-arrow bdevs-btn">
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                               <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>

            <?php
            else:
                printf('%1$s %2$s %3$s',
                    __('No ', 'bdevs-elementor'),
                    esc_html($settings['post_type']),
                    __('Found', 'bdevs-elementor')
                );
            endif;
            ?>
        <?php endif;
    }
}
