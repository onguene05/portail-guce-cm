<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class CourseList extends \Generic\Elements\GenericWidget
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
        return 'course-list';
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
        return __('Course List', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/course-list/';
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
        return ['events', 'event', 'course-list', 'list', 'event'];
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




    protected function register_content_controls() {

        $this->design_style();
        $this->settings();
        $this->button();
        $this->course_list();

    }    


    public function design_style()
    {
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
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'tp_tutor_pagination',
            [
                'label' => esc_html__( 'Pagination', 'tpcore' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tpcore' ),
                'label_off' => esc_html__( 'Hide', 'tpcore' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
    }


    public function course_list() {

        $this->start_controls_section(
            '_section_post_list',
            [
                'label' => __('Course List', 'bdevs-elementor'),
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
                'post_id',
                [
                    'label' => __('Select ', 'bdevs-elementor') . $value,
                    'label_block' => true,
                    'multiple' => false,
                    'placeholder' => 'Search ' . $value,
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

    }

     public function settings() { 

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
            'feature_image',
            [
                'label' => __('Featured Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'couse_shape',
            [
                'label' => __('Shape Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => __('Content Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'content_limit',
            [
                'label' => __('Content Limit', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'author_switch',
            [
                'label' => __('Author Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        ); 

        $this->add_control(
            'button_switch',
            [
                'label' => __('Button Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        ); 

        $this->add_control(
            'lession_switch',
            [
                'label' => __('Lession Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );        

        $this->add_control(
            'rating_switch',
            [
                'label' => __('Rating Switch', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'course_button_text',
            [
                'label' => __('Button Text', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-elementor'),
                'placeholder' => __('Button Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );       

        $this->end_controls_section();

    }

     public function button() { 


        // Button 
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
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

    }

    protected function register_style_controls() {

        $this->title_style_controls();
       $this->button_style_controls();

    }    

       protected function title_style_controls() {
        
        $this->start_controls_section(
            '_section_post_list_title_style',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
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

        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Description', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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

    protected function button_style_controls() {

         $this->add_control(
            '_content_button',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Button', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-elementor' ),
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
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
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
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
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
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); 

        $this->end_controls_section();

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding2',
            [
                'label' => __( 'Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography2',
                'selector' => '{{WRAPPER}} .bdevs-el-edu',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border2',
                'selector' => '{{WRAPPER}} .bdevs-el-edu',
            ]
        );

        $this->add_control(
            'button_border_radius2',
            [
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow2',
                'selector' => '{{WRAPPER}} .bdevs-el-edu',
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button2' );

        $this->start_controls_tab(
            '_tab_button_normal2',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_color2',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color2',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover2',
            [
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color2',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu:hover, {{WRAPPER}} .bdevs-el-edu:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color2',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu:hover, {{WRAPPER}} .bdevs-el-edu:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color2',
            [
                'label' => __( 'Border Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-edu:hover, {{WRAPPER}} .bdevs-el-edu:focus' => 'border-color: {{VALUE}};',
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
            $posts = new \WP_Query($args);
        }

        ?>

        <?php if ( $settings['designs'] == 'design_3' ): ?>



            <!-- course-content-start -->
            <section class="course-content-area pb-80">
                <div class="container">
                    <div class="row mb-10">
                       <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
                          <div class="row">
                            <?php
                            global $authordata;
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();
                                $feature_image = function_exists('get_field') ? get_field('feature_image') : '';
                                $terms = get_the_terms(get_the_ID(), 'course-category');
                                $profile_url = tutor_utils()->profile_url($authordata->ID);
                                $course_rating = tutor_utils()->get_course_rating();
                                $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                $tutor_course_duration = get_tutor_course_duration_context(get_the_ID()); 
                            ?>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                              <div class="eduman-course-main-wrapper mb-30">
                                <div class="course-cart">
                                    <div class="course-info-wrapper">
                                       <div class="cart-info-body">
                                            <span class="category-color category-color-1">
                                                <?php foreach ($terms as $term) : ?>
                                                <a href="<?php echo get_term_link($term->slug, 'course-category'); ?>"><?php echo $term->name; ?></a>
                                                <?php endforeach; ?>
                                            </span>

                                          <a href="<?php the_permalink(); ?>">
                                             <h3><?php the_title(); ?></h3>
                                          </a>

                                            <div class="cart-lavel">
                                                <h5><?php print esc_html__('Level : ', 'eduman'); ?> <span><?php echo get_tutor_course_level(); ?></span></h5>

                                                <?php the_excerpt(); ?>
                                            </div>

                                            <div class="course-action">
                                                <a href="<?php the_permalink(); ?>" class="view-details-btn"><?php print esc_html__('View Details ', 'eduman'); ?></a>

                                                <?php
                                                    $course_id = get_the_ID();
                                                    $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );
                                                    
                                                    $action_class = '';
                                                    if ( is_user_logged_in() ) {
                                                        $action_class = apply_filters('tutor_wishlist_btn_class', 'wishlist-btn');
                                                    } else {
                                                        $action_class = apply_filters('tutor_popup_login_class', 'cart-required-login');
                                                    }
                                                    
                                                    echo '<button class="'. esc_attr( $action_class ) .' " data-course-id="'. esc_attr( $course_id ) .'" role="button">
                                                        <i class="' . ( $is_wish_listed ? 'flaticon-like' : 'flaticon-like') . '"></i>
                                                    </button>';
                                                ?>

                                                <div class="etlms-course-share">
                                                    <a data-tutor-modal-target="tutor-course-share-opener" href="#" class="tutor-btn tutor-btn-ghost etlms-course-share-btn">
                                                        <span class="etlms-course-share-icon">
                                                            <span class="c-share-btn" area-hidden="true"><i class="flaticon-previous"></i></span>
                                                        </span>
                                                    </a>
                                                </div>

                                            </div>
                                       </div>
                                    </div>
                                </div>

                                <?php if ('yes' === $settings['feature_image']): ?>
                                <div class="eduman-course-thumb w-img">
                                    <a href="<?php print get_the_permalink() ?>">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
                                    </a>
                                </div>
                                <?php endif; ?>


                                <div class="eduman-course-wraper">
                                    <div class="eduman-course-heading">
                                        <?php foreach ($terms as $term) : ?>
                                        <a href="<?php echo get_term_link($term->slug, 'course-category'); ?>" class="course-link-color-1"><?php echo $term->name; ?></a>
                                        <?php endforeach; ?>
                                        <span class="couse-star">
                                        <?php
                                            if ($course_rating->rating_avg >= 0) {
                                                echo '<i class="icon_star"></i>' . apply_filters('tutor_course_rating_average', $course_rating->rating_avg) . '';

                                                echo '<span class="rating-count-gap">(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ')</span>';
                                            }
                                        ?>
                                        </span>
                                    </div>
                                    <div class="eduman-course-text">
                                       <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                       </h3>
                                    </div>
                                    <div class="eduman-course-meta">
                                       <div class="eduman-course-price">
                                            <?php
                                                $course_id = get_the_ID();
                                                $default_price = apply_filters('tutor-loop-default-price', __('Free', 'micourse'));
                                                $price_html = '<span class="price-now"> ' . $default_price . '</span>';
                                                if (tutor_utils()->is_course_purchasable()) {

                                                    $product_id = tutor_utils()->get_course_product_id($course_id);
                                                    $product = wc_get_product($product_id);

                                                    if ($product) {
                                                        $price_html = '<span class="price-now"> ' . $product->get_price_html() . ' </span>';
                                                    }
                                                }
                                                echo $price_html;
                                            ?>
                                       </div>

                                       <?php if ( !empty($settings['author_switch']) ) : ?>
                                       <div class="eduman-course-tutor"><?php echo get_avatar(get_the_author_meta('ID'), 50) ?>
                                            <a href="<?php echo $profile_url; ?>">
                                                <span>
                                                <?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?>
                                                </span>
                                            </a>
                                       </div>
                                       <?php endif; ?>
                                        
                                    </div>
                                </div>
                                <div class="eduman-course-footer">
                                    <?php if ( !empty($settings['lession_switch']) ) : ?>
                                    <div class="course-lessson-svg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                          viewBox="0 0 16.471 16.471">
                                          <g id="blackboar09" transform="translate(-0.008)">
                                             <path id="Path_01" data-name="Path 101"
                                                d="M16,1.222H8.726V.483a.483.483,0,1,0-.965,0v.74H.491A.483.483,0,0,0,.008,1.7V13.517A.483.483,0,0,0,.491,14H5.24L4.23,15.748a.483.483,0,1,0,.836.483L6.354,14H7.761v1.99a.483.483,0,0,0,.965,0V14h1.407l1.288,2.231a.483.483,0,1,0,.836-.483L11.247,14H16a.483.483,0,0,0,.483-.483V1.7A.483.483,0,0,0,16,1.222Zm-.483.965v8.905H.973V2.187Zm0,10.847H.973v-.976H15.514Z"
                                                fill="#575757" />
                                          </g>
                                        </svg>
                                       <span class="ms-2">
                                            <?php echo $tutor_lesson_count; ?>
                                            <?php print esc_html__('lessons', 'bdevs-elementor'); ?>
                                        </span>
                                    </div>
                                    <?php endif; ?>

                                    <div class="course-deteals-btn">
                                       <a href="<?php the_permalink(); ?>"><span class="me-2"><?php print esc_html__('View Details ', 'eduman'); ?></span><i class="far fa-arrow-right"></i></a>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                          </div>

                        <?php if($settings['tp_tutor_pagination'] == 'yes' && '-1' != $settings['posts_per_page'] ) : ?>
                          <div class="row">
                             <div class="edu-pagination mt-30 mb-20">
                                <?php
                                $big = 999999999; // need an unlikely integer

                                if (get_query_var('paged')) {
                                    $paged = get_query_var('paged');
                                } else if (get_query_var('page')) {
                                    $paged = get_query_var('page');
                                } else {
                                    $paged = 1;
                                }
                                echo paginate_links( array(
                                    'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                    'format'     => '?paged=%#%',
                                    'current'    => $paged,
                                    'total'      => $posts->max_num_pages,
                                    'type'       =>'list',
                                    'prev_text'  =>'<i class="far fa-angle-left"></i>',
                                    'next_text'  =>'<i class="far fa-angle-right"></i>',
                                    'show_all'   => false,
                                    'end_size'   => 1,
                                    'mid_size'   => 4,
                                ) );
                                ?>
                             </div>
                          </div>
                        <?php endif; ?>
                       </div>
                    </div>
                </div>
            </section>
            <!-- course-content-end -->

            <div id="tutor-course-share-opener" class="tutor-modal etlms-course-share-modal course-social-share-popup">
                    <span class="tutor-modal-overlay"></span>
                    <div class="tutor-modal-window">
                        <div class="tutor-modal-content tutor-modal-content-white">
                            <button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
                                <span class="tutor-icon-times" area-hidden="true"></span>
                            </button>
                            <div class="tutor-modal-body">
                                
                                <div class="etlms-course-share-modal-title tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-16">
                                    
                                </div>
                                
                                <div class="etlms-course-share-modal-sub-title tutor-fs-7 tutor-color-secondary tutor-mb-12">
                                    <?php _e('Page Link', 'tutor-lms-elementor-addons') ?>
                                </div>
                                <div class="tutor-mb-32">
                                    <input class="tutor-form-control" value="<?php echo get_permalink( get_the_ID() ); ?>" />
                                </div>
                                <div>
                                   
                                <div class="etlms-course-share-modal-link tutor-color-black tutor-fs-6 tutor-fw-medium tutor-mb-16">
                                     <h3><?php _e('Share on social media','eduman'); ?></h3>
                                </div>
                                    
                                <div class="tutor-social-share-wrap" data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
                                    <?php foreach ($tutor_social_share_icons as $icon) : ?>
                                                <button class="tutor-social-share-button <?php echo esc_html( $icon['share_class'] ); ?> ' elementor-animation-<?php echo esc_html( $settings['course_share_hover_animation'] ); ?>" style="background: <?php echo esc_html( $icon['color'] ); ?>">
                                                    <?php echo $icon['icon_html']; ?>
                                                    &nbsp;<?php echo esc_html( $icon['text'] ); ?>
                                            </button>
                                    <?php endforeach; ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        <?php elseif ( $settings['designs'] == 'design_4'):  ?>

        <!-- course-content-start -->
        <div class="course-content-area">
            <div class="container">
                <div class="row mb-10">
                   <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <?php
                            global $authordata;
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();
                                $terms = get_the_terms(get_the_ID(), 'course-category');
                                $profile_url = tutor_utils()->profile_url($authordata->ID);
                                $course_rating = tutor_utils()->get_course_rating();
                                $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                $tutor_course_duration = get_tutor_course_duration_context(get_the_ID()); 
                            ?>
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="academic-box mb-30">
                                    <div class="academic-thumb">
                                      <a href="<?php the_permalink(); ?>">
                                        <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
                                      </a>
                                    </div>
                                    <div class="academic-content">
                                      <div class="academic-content-header">
                                        <a href="<?php the_permalink(); ?>">
                                            <h3><?php the_title(); ?></h3>  
                                        </a>
                                      </div>

                                      <div class="academic-body">
                                        <?php if (!empty($settings['author_switch'])): ?>
                                        <div class="academic-tutor d-flex align-items-center">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 50) ?>
                                            <a href="<?php echo $profile_url; ?>">
                                                <?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?>
                                            </a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['content'])):
                                            $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                            ?>
                                            <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $content_limit, ''); ?></p>
                                        <?php endif; ?>
                                      </div>

                                        <div class="academic-footer">
                                            <?php if ( !empty($settings['lession_switch']) ) : ?>
                                            <div class="course-lessson-svg2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                                  viewBox="0 0 16.471 16.471">
                                                  <g id="blackboar09" transform="translate(-0.008)">
                                                     <path id="Path_01" data-name="Path 101"
                                                        d="M16,1.222H8.726V.483a.483.483,0,1,0-.965,0v.74H.491A.483.483,0,0,0,.008,1.7V13.517A.483.483,0,0,0,.491,14H5.24L4.23,15.748a.483.483,0,1,0,.836.483L6.354,14H7.761v1.99a.483.483,0,0,0,.965,0V14h1.407l1.288,2.231a.483.483,0,1,0,.836-.483L11.247,14H16a.483.483,0,0,0,.483-.483V1.7A.483.483,0,0,0,16,1.222Zm-.483.965v8.905H.973V2.187Zm0,10.847H.973v-.976H15.514Z"
                                                        fill="#575757" />
                                                  </g>
                                                </svg>
                                               <span class="ms-2">
                                                    <?php echo $tutor_lesson_count; ?>
                                                    <?php print esc_html__('lessons', 'bdevs-elementor'); ?>
                                                </span>
                                            </div>
                                            <?php endif; ?>

                                            <?php if ( !empty($settings['button_switch']) ) : ?>
                                            <a class="edo-course-sec-btn" href="<?php the_permalink(); ?>">
                                                <?php echo wp_kses_post($settings['course_button_text']); ?>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                endwhile;
                                wp_reset_query();
                            endif;
                            ?>
                        </div>

                        <?php if($settings['tp_tutor_pagination'] == 'yes' && '-1' != $settings['posts_per_page'] ) : ?>
                        <div class="row">
                            <div class="edu-pagination mt-30 mb-20">
                                <?php
                                $big = 999999999; // need an unlikely integer

                                if (get_query_var('paged')) {
                                    $paged = get_query_var('paged');
                                } else if (get_query_var('page')) {
                                    $paged = get_query_var('page');
                                } else {
                                    $paged = 1;
                                }
                                echo paginate_links( array(
                                    'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                    'format'     => '?paged=%#%',
                                    'current'    => $paged,
                                    'total'      => $posts->max_num_pages,
                                    'type'       =>'list',
                                    'prev_text'  =>'<i class="far fa-angle-left"></i>',
                                    'next_text'  =>'<i class="far fa-angle-right"></i>',
                                    'show_all'   => false,
                                    'end_size'   => 1,
                                    'mid_size'   => 4,
                                ) );
                                ?>
                            </div>
                        </div>
                        <?php endif; ?>
                   </div>
                </div>
            </div>
        </div>
        <!-- course-content-end -->


        <?php elseif ( $settings['designs'] == 'design_2'):  ?>

        <!-- course-content-start -->
        <section class="course-content-area">
            <div class="container">
                <div class="row mb-10">
                   <div class="col-xl-12 col-lg-12 col-md-12">
                      <div class="row">
                        <?php
                        global $authordata;
                        if ($posts->have_posts()):
                            while ($posts->have_posts()) : $posts->the_post();
                            $terms = get_the_terms(get_the_ID(), 'course-category');
                            $profile_url = tutor_utils()->profile_url($authordata->ID);
                            $course_rating = tutor_utils()->get_course_rating();
                            $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                            $tutor_course_duration = get_tutor_course_duration_context(get_the_ID()); 
                        ?>

                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="protfolio-course-2-wrapper mb-30">
                               <div class="student-course-img">
                                  <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
                                  </a>
                               </div>
                               <div class="course-cart">
                                  <div class="course-info-wrapper">
                                     <div class="cart-info-body">
                                        <span class="category-color category-color-1">
                                            <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo get_term_link($term->slug, 'course-category'); ?>"><?php echo $term->name; ?>
                                            </a>
                                            <?php endforeach; ?>
                                        </span>
                                    
                                        
                                        <h3><a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>   
                                            </a>
                                        </h3>
                                        

                                        <div class="cart-lavel">
                                            <h5><?php print esc_html__('Level : ', 'eduman'); ?> <span><?php echo get_tutor_course_level(); ?></span></h5>

                                            <?php the_excerpt(); ?>
                                        </div>

                                        <div class="course-action">
                                            <a href="<?php the_permalink(); ?>" class="view-details-btn"><?php print esc_html__('View Details ', 'eduman'); ?></a>

                                            <?php
                                                $course_id = get_the_ID();
                                                $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );
                                                
                                                $action_class = '';
                                                if ( is_user_logged_in() ) {
                                                    $action_class = apply_filters('tutor_wishlist_btn_class', 'wishlist-btn');
                                                } else {
                                                    $action_class = apply_filters('tutor_popup_login_class', 'cart-required-login');
                                                }
                                                
                                                echo '<button class="'. esc_attr( $action_class ) .' " data-course-id="'. esc_attr( $course_id ) .'" role="button">
                                                    <i class="' . ( $is_wish_listed ? 'flaticon-like' : 'flaticon-like') . '"></i>
                                                </button>';
                                            ?>

                                            <div class="etlms-course-share">
                                                <a data-tutor-modal-target="tutor-course-share-opener" href="#" class="tutor-btn tutor-btn-ghost etlms-course-share-btn">
                                                    <span class="etlms-course-share-icon">
                                                        <span class="c-share-btn" area-hidden="true"><i class="flaticon-previous"></i></span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                               <div class="portfolio-course-2-content">
                                  <div class="portfolio-course-wrapper">
                                     <div class="portfolio-price">
                                        <?php
                                            $course_id = get_the_ID();
                                            $default_price = apply_filters('tutor-loop-default-price', __('Free', 'micourse'));
                                            $price_html = '<span class="price-now"> ' . $default_price . '</span>';
                                            if (tutor_utils()->is_course_purchasable()) {

                                                $product_id = tutor_utils()->get_course_product_id($course_id);
                                                $product = wc_get_product($product_id);

                                                if ($product) {
                                                    $price_html = '<span class="price-now"> ' . $product->get_price_html() . ' </span>';
                                                }
                                            }
                                            echo $price_html;
                                        ?>
                                     </div>
                                     <div class="portfolio-course-2">
                                        <a href="<?php the_permalink(); ?>">
                                            <h3 class="bdevs-el-title"><?php the_title(); ?></h3>
                                        </a>
                                     </div>
                                     <div class="course-icon">
                                        <?php
                                            if ($course_rating->rating_avg >= 0) {
                                                echo '<i class="icon_star"></i>' . apply_filters('tutor_course_rating_average', $course_rating->rating_avg) . '';

                                                echo '<span class="rating-count-gap">(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ')</span>';
                                            }
                                        ?>
                                     </div>
                                  </div>
                               </div>
                               <div class="course-2-footer">
                                   <div class="eduman-course-tutor"><?php echo get_avatar(get_the_author_meta('ID'), 50) ?>
                                        <a href="<?php echo $profile_url; ?>">
                                            <span>
                                            <?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?>
                                            </span>
                                        </a>
                                   </div>
                                    <?php if ( !empty($settings['button_switch']) ) : ?>
                                    <div class="academic-footer">
                                        <a class="edo-course-sec-btn bdevs-el-btn" href="<?php the_permalink(); ?>"><?php echo wp_kses_post($settings['course_button_text']); ?></a>
                                    </div>
                                    <?php endif; ?>
                               </div>
                            </div>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_query();
                        endif;
                        ?>
                      </div>

                    <?php if($settings['tp_tutor_pagination'] == 'yes' && '-1' != $settings['posts_per_page'] ) : ?>
                      <div class="row">
                         <div class="edu-pagination mt-30 mb-20">
                            <?php
                            $big = 999999999; // need an unlikely integer

                            if (get_query_var('paged')) {
                                $paged = get_query_var('paged');
                            } else if (get_query_var('page')) {
                                $paged = get_query_var('page');
                            } else {
                                $paged = 1;
                            }
                            echo paginate_links( array(
                                'base'       => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                                'format'     => '?paged=%#%',
                                'current'    => $paged,
                                'total'      => $posts->max_num_pages,
                                'type'       =>'list',
                                'prev_text'  =>'<i class="far fa-angle-left"></i>',
                                'next_text'  =>'<i class="far fa-angle-right"></i>',
                                'show_all'   => false,
                                'end_size'   => 1,
                                'mid_size'   => 4,
                            ) );
                            ?>
                         </div>
                      </div>
                    <?php endif; ?>
                   </div>
                </div>
            </div>
        </section>
        <!-- course-content-end -->

        <div id="tutor-course-share-opener" class="tutor-modal etlms-course-share-modal course-social-share-popup">
                <span class="tutor-modal-overlay"></span>
                <div class="tutor-modal-window">
                    <div class="tutor-modal-content tutor-modal-content-white">
                        <button class="tutor-iconic-btn tutor-modal-close-o" data-tutor-modal-close>
                            <span class="tutor-icon-times" area-hidden="true"></span>
                        </button>
                        <div class="tutor-modal-body">
                            
                            <div class="etlms-course-share-modal-title tutor-fs-5 tutor-fw-medium tutor-color-black tutor-mb-16">
                                
                            </div>
                            
                            <div class="etlms-course-share-modal-sub-title tutor-fs-7 tutor-color-secondary tutor-mb-12">
                                <?php _e('Page Link', 'tutor-lms-elementor-addons') ?>
                            </div>
                            <div class="tutor-mb-32">
                                <input class="tutor-form-control" value="<?php echo get_permalink( get_the_ID() ); ?>" />
                            </div>
                            <div>
                               
                            <div class="etlms-course-share-modal-link tutor-color-black tutor-fs-6 tutor-fw-medium tutor-mb-16">
                                 <h3><?php _e('Share on social media','eduman'); ?></h3>
                            </div>
                                
                            <div class="tutor-social-share-wrap" data-social-share-config="<?php echo esc_attr(wp_json_encode($share_config)); ?>">
                                <?php foreach ($tutor_social_share_icons as $icon) : ?>
                                            <button class="tutor-social-share-button <?php echo esc_html( $icon['share_class'] ); ?> ' elementor-animation-<?php echo esc_html( $settings['course_share_hover_animation'] ); ?>" style="background: <?php echo esc_html( $icon['color'] ); ?>">
                                                <?php echo $icon['icon_html']; ?>
                                                &nbsp;<?php echo esc_html( $icon['text'] ); ?>
                                        </button>
                                <?php endforeach; ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <?php else:
            if ( !empty($posts) ):
                $this->add_render_attribute('title', 'class', 'mb-15'); 

                if ( !empty($settings['button_link']) ) {
                $this->add_render_attribute( 'button', 'class', 'edo-theme-btn mt-30 bdevs-el-edu' );
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }
        ?>

            <div class="academic-courses-area p-relative">
                <?php if (!empty($settings['couse_shape'])): ?>
                <img class="academic-shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/shape/acadenic-shape-2.png" alt="shape">
                <?php endif; ?>
                <div class="container">

                    <div class="row">
                        <?php
                            global $authordata;
                            if ($posts->have_posts()):
                                while ($posts->have_posts()) : $posts->the_post();
                                $terms = get_the_terms(get_the_ID(), 'course-category');
                                $profile_url = tutor_utils()->profile_url($authordata->ID);
                                $course_rating = tutor_utils()->get_course_rating();
                                $tutor_lesson_count = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                                $tutor_course_duration = get_tutor_course_duration_context(get_the_ID()); ?>       
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="academic-box position-relative mb-30">
                                <div class="academic-thumb">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), $settings['post_image_size']); ?>
                                </div>
                                <div class="academic-content">
                                    <div class="academic-content-header">
                                        <a href="<?php the_permalink(); ?>">
                                            <h3 class="bdevs-el-title"><?php the_title(); ?></h3>
                                        </a>
                                    </div>
                                    <div class="academic-body bdevs-el-content">
                                        <?php if (!empty($settings['author_switch'])): ?>
                                        <div class="academic-tutor d-flex align-items-center">
                                            <?php echo get_avatar(get_the_author_meta('ID'), 50) ?>
                                            <a href="<?php echo $profile_url; ?>"><?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?></a>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['content'])):
                                            $content_limit = (!empty($settings['content_limit'])) ? $settings['content_limit'] : '';
                                            ?>
                                            <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $content_limit, ''); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ( !empty($settings['button_switch']) ) : ?>
                                    <div class="academic-footer">
                                        <a class="edo-course-sec-btn bdevs-el-btn" href="<?php the_permalink(); ?>"><?php echo wp_kses_post($settings['course_button_text']); ?></a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                          <?php
                            endwhile;
                            wp_reset_query();
                        endif;
                        ?>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-3 text-center">
                            <div class="academic-bottom-btn ">
                                <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
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

            <?php
            else:
                printf('%1$s %2$s %3$s',
                    __('No ', 'bdevs-elementor'),
                    esc_html($settings['post_type']),
                    __('Found', 'bdevs-elementor')
                );
            endif;
            ?>
        <?php
        endif;


    }
}