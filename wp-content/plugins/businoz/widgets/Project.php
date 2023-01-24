<?php
namespace Bdevs\Elementor;

defined( 'ABSPATH' ) || die();

class Project extends \Generic\Elements\GenericWidget {

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
        return 'cust-project';
    }

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title () {
		return __( 'Project', 'bdevselement' );
	}

	public function get_custom_help_url () {
		return 'http://elementor.bdevs.net//widgets/project/';
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon () {
		return 'eicon-single-post';
	}

	public function get_keywords () {
		return [ 'poject', 'tab', 'gallery', 'news' ];
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

    /**
     * Get a list of Taxonomy
     *
     * @return array
     */
    public function get_taxonomies($post_type = '')
    {
        $list = [];
        if ($post_type) {
            $taxonomies = get_taxonomies(['public' => true, "object_type" => [$post_type]], 'object', true);
            $list[$post_type] = count($taxonomies) !== 0 ? $taxonomies : '';
        } else {
            $list = get_taxonomies(['public' => true], 'object', true);
        }
        return $list;
    }


    protected function register_content_controls()
    {
        $this->design_style();
        $this->title_and_desc();
        $this->course_query();
        $this->button();
        $this->course_settings();

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

    public function title_and_desc()
    {
        // Title & Description
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                ]
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

    public function course_query()
    {
        // Query
        $this->start_controls_section(
            '_section_post_tab_query',
            [
                'label' => __('Query', 'bdevs-elementor'),
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

        foreach (self::get_post_types() as $key => $value) {
            $taxonomy = self::get_taxonomies($key);
            if (!$taxonomy[$key]) {
                continue;
            }

            $this->add_control(
                'tax_type_' . $key,
                [
                    'label' => __('Taxonomies', 'bdevs-elementor'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key,
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'bdevs-elementor') . $tax_value,
                        'label_block' => true,
                        'type' => 'bdevselement-select2',
                        'multiple' => true,
                        'placeholder' => 'Search ' . $tax_value,
                        'data_options' => [
                            'tax_id' => $tax_key,
                            'action' => 'bdevs_element_post_tab_select_query',
                        ],
                        'condition' => [
                            'post_type' => $key,
                            'tax_type_' . $key => $tax_key,
                        ],
                        'render_type' => 'template',
                    ]
                );
            }
        }

        $this->add_control(
            'item_limit',
            [
                'label' => __('Item Limit', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();
    }

    public function button()
    {
        // Button 
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
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

    public function course_settings()
    {
        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => __('Column', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => __('1 Column', 'bdevs-elementor'),
                    '2' => __('2 Column', 'bdevs-elementor'),
                    '3' => __('3 Column', 'bdevs-elementor'),
                    '4' => __('4 Column', 'bdevs-elementor'),
                    '5' => __('5 Column', 'bdevs-elementor'),
                    '6' => __('6 Column', 'bdevs-elementor'),
                ],
                'render_type' => 'template',
                'default' => '3',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'label' => __('Show Excerpt', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-elementor'),
                'label_off' => __('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'read_more',
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
            'read_more_text',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Button Text', 'bdevs-elementor'),
                'default' => __('Know Details', 'bdevs-elementor'),
                'placeholder' => __('Type text here', 'bdevs-elementor'),
                'condition' => [
                    'read_more' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'read_more_icon',
            [
                'label' => __('Read More Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-arrow-right',
                    'library' => 'reguler',
                ],
                'condition' => [
                    'read_more' => 'yes'
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
            'content',
            [
                'label' => __('Content', 'bdevs-elementor'),
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
                'condition' => [
                    'content' => 'yes'
                ]
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

        $this->end_controls_section();
    }


    protected function register_style_controls(){

        $this->title_style_controls();

    }

    protected function title_style_controls()
    {

        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __('Title & Desccription', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .section-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title',
                'label' => __('Text Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .section-title',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_heading_color',
            [
                'label' => __('Back Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-border-title1' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __('Blend Mode', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => __('Normal', 'bdevs-elementor'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .section-title' => 'mix-blend-mode: {{VALUE}};',
                ],
                'separator' => 'none',
            ]
        );

        // subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Sub Title', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subtitle',
                'label' => __('Text Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_control(
            'heading_subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        // content

        $this->add_control(
            '_heading_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Content', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_desc_margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_desc_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desccription',
                'selector' => '{{WRAPPER}} .section-heading p',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'desccription',
                'label' => __('Text Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .section-heading p',
            ]
        );

        $this->add_control(
            'heading_desc_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_post_tab_filter',
            [
                'label' => __('Tab', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_line_color',
            [
                'label' => __('Tab Line BG', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box::before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_box_color',
            [
                'label' => __('Tab Box BG', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_pos' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_shadow',
                'label' => __('Box Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .project-filter-box',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'label' => __('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .project-filter-box',
            ]
        );

        $this->add_responsive_control(
            'tab_item',
            [
                'label' => __('Tab Item', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_item_margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_item_tabs');
        $this->start_controls_tab(
            'tab_item_normal_tab',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'tab_item_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_background',
                'label' => __('Background', 'bdevs-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover_tab',
            [
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'tab_item_hvr_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .project-filter-box button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_hvr_background',
                'label' => __('Background', 'bdevs-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .project-filter-box button.active,{{WRAPPER}} .project-filter-box button:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab_item_typography',
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_item_border',
                'label' => __('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .project-filter-box button',
            ]
        );

        $this->add_responsive_control(
            'tab_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-filter-box button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Column
        $this->start_controls_section(
            '_section_post_tab_column',
            [
                'label' => __('Column', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_space',
            [
                'label' => __('Space Between', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'post_item_background',
                'label' => __('Background', 'bdevs-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_item_box_shadow',
                'label' => __('Box Shadow', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'post_item_border',
                'label' => __('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_responsive_control(
            'post_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Content Style
        $this->start_controls_section(
            '_section_post_tab_content',
            [
                'label' => __('Content', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_content_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_item_content_img_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_title',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'post_content_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title',
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
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'post_content_meta',
            [
                'label' => __('Meta', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span',
            ]
        );

        $this->start_controls_tabs('meta_tabs');
        $this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'meta_hover_tab',
            [
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'meta_hvr_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'meta__margin',
            [
                'label' => __('Margin', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_excerpt',
            [
                'label' => __('Excerpt', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => __('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin_top',
            [
                'label' => __('Margin Top', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        if (!$settings['post_type']) {
            return;
        }

        if ( !empty($settings['post_type']) ) {
            $terms_ids = get_taxonomies(['public' => true, "object_type" => [$settings['post_type']]]);
        }

        $taxonomy = !empty($terms_ids) ? current($terms_ids) : '';

        if ( !empty($terms_ids) ) {
            $terms_args = [
                'taxonomy' => $taxonomy,
                'hide_empty' => true,
                'orderby' => 'term_id',
            ];

            $post_args = [
                'post_status' => 'publish',
                'post_type' => $settings['post_type'],
                'posts_per_page' => $settings['item_limit'],
                // 'tax_query' => [
                //     [
                //         'taxonomy' => $taxonomy,
                //         'field' => 'term_id',
                //         'terms' => $terms_ids ? [51, 52] : '',
                //     ],
                // ],
            ];
        }

        $posts = query_posts($post_args);
        $filter_list = get_terms($terms_args);

        //              echo "<pre>";
        // print_r($posts); 
        // print_r($filter_list);
        // die;

        $query_settings = [
            'post_type' => $settings['post_type'],
            'taxonomy' => $taxonomy,
            'item_limit' => $settings['item_limit'],
            'excerpt' => $settings['excerpt'] ? $settings['excerpt'] : 'no',
        ];
        $query_settings = json_encode($query_settings, true);
        
        ?>



        <?php if ( $settings['designs'] == 'design_2'): 

        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'edu-sec-btn bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        $this->add_render_attribute('project-filter', 'class', ['portfolio-menu text-center mb-50']);
        $this->add_render_attribute('project-body', 'class', ['row filter-grid']);
        $this->add_render_attribute( 'title', 'class', 'section__title' );
        $title = wp_kses_post($settings['title']);
        $i = 1;

        ?>

        <!-- student-course-area-start -->
        <div class="student-course-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <?php if ($settings['title']) : ?>
                        <div class="section-title mb-50">
                            <?php printf('<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['title_tag']),
                                $this->get_render_attribute_string('title'),
                                $title
                            ); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-xl-8 col-lg-7">
                        <div class="portfolio-button mt-65">
                            <?php foreach ($filter_list as $list): ?>
                                <?php if ($i === 1): $i++; ?>
                            <button class="active" data-filter="*"><?php echo esc_html('See All'); ?></button>
                            <button data-filter=".<?php echo esc_attr($list->slug); ?>"><?php echo esc_html($list->name); ?></button>
                            <?php else: ?>

                            <button data-filter=".<?php echo esc_attr($list->slug); ?>"><?php echo esc_html($list->name); ?></button>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="row grid">
                    <?php
                    global $authordata;
                    if (have_posts()): while (have_posts()): the_post();
                    $cases_author_name = function_exists('get_field') ? get_field('cases_author_name') : '';
                    $feature_image = function_exists('get_field') ? get_field('feature_image') : '';
                    $item_classes = '';
                    $item_cat_names = '';
                    $item_cats = get_the_terms(get_the_id(), $taxonomy);
                    if (!empty($item_cats)):
                        $count = count($item_cats) - 1;
                        foreach ($item_cats as $key => $item_cat) {
                            $item_classes .= $item_cat->slug . ' ';
                            $item_cat_names .= ($count > $key) ? $item_cat->name . ', ' : $item_cat->name;
                        }
                    endif;


                    $feature_img = '';
                    if ('yes' === $settings['feature_image']) {
                        $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    }
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6  grid-item <?php echo $item_classes; ?>">
                        <div class="course-wrapper-2 mb-30">
                            <?php if ('yes' === $settings['feature_image']): ?>
                            <div class="student-course-img">
                                <a href="<?php print get_the_permalink() ?>"><img src="<?php echo esc_url($feature_img); ?>" alt="course-img"></a>
                            </div>
                            <?php endif; ?>

                            <div class="student-course-footer">
                                <div class="student-course-linkter">
                                    <?php if ( !empty($settings['lession_switch']) ) : ?>
                                    <div class="course-lessons">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.471" height="16.471"
                                            viewBox="0 0 16.471 16.471">
                                            <g id="blackboard-8" transform="translate(-0.008)">
                                                <path id="Path_106" data-name="Path 101"
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

                                </div>
                                <div class="student-course-text">
                                   <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                   </h3>
                                </div>
                                <div class="portfolio-user">
                                    <?php if ( !empty($settings['author_switch']) ) : ?>
                                    <div class="user-icon">
                                        <a href="<?php echo $profile_url; ?>"><i class="fas fa-user"></i><?php echo get_the_author_meta('display_name', get_the_author_meta('ID')); ?></a>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ( !empty($settings['rating_switch']) ) : ?>
                                    <div class="course-icon">
                                        <?php
                                            if ($course_rating->rating_avg >= 0) {
                                                echo '<i class="icon_star"></i>' . apply_filters('tutor_course_rating_average', $course_rating->rating_avg) . '';

                                                echo '<span class="rating-count-gap">(' . apply_filters('tutor_course_rating_count', $course_rating->rating_count) . ')</span>';
                                            }
                                        ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif;
                    ?>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-3">
                        <div class="portfolio-brn mt-20 text-center">
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
        <!-- student-course-area-end -->



        <?php else:

        $this->add_render_attribute('project-filter', 'class', ['portfolio-menu text-center mb-50']);
        $this->add_render_attribute('project-body', 'class', ['row filter-grid']);
        $this->add_render_attribute( 'title', 'class', 'lv-featured-gallery-content-title-2 bdevs-el-title' );
        $title = wp_kses_post($settings['title']);
        $i = 1;

        if ( count($posts) !== 0): ?>

        <section class="featured-gallery-area">
            <div class="container">
            	<div class="lv-featured-gallery-2 gallery-grid project-gall">
                <div class="row">
                    <?php
                    global $authordata;
                    if (have_posts()): while (have_posts()): the_post();
                    $categories = get_the_terms( get_the_id(), 'project-categories' );
                    $cases_author_name = function_exists('get_field') ? get_field('cases_author_name') : '';
                    $feature_image = function_exists('get_field') ? get_field('feature_image') : '';
                    $item_classes = '';
                    $item_cat_names = '';
                    $item_cats = get_the_terms(get_the_id(), $taxonomy);
                    if (!empty($item_cats)):
                        $count = count($item_cats) - 1;
                        foreach ($item_cats as $key => $item_cat) {
                            $item_classes .= $item_cat->slug . ' ';
                            $item_cat_names .= ($count > $key) ? $item_cat->name . ', ' : $item_cat->name;
                        }
                    endif;


                    $feature_img = '';
                    if ('yes' === $settings['feature_image']) {
                        $feature_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    }
                    ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 grid-item <?php echo $item_classes; ?>">
                      <div class="lv-featured-gallery-item-single-2 mb-30 p-rel bg-default lv-featured-gallery-height-1">
                      	<div class="lv-featured-gallery-thumb">
                      		<?php the_post_thumbnail(); ?>
                      	</div>
                        <div class="lv-featured-gallery-item-height-2">
	                         <div class="lv-featured-gallery-content-2-wrap bg-white p-rel">
	                            <div class="lv-featured-gallery-content-2-inner">
	                               <div class="lv-featured-gallery-paths-2">
	                                  <span></span>
	                                  <span></span>
	                                  <span></span>
	                                  <span></span>
	                               </div>
	                               <p class="lv-featured-gallery-content-subtitle-2">
	                               	<?php foreach ( $categories as $category ) : ?>
	                               	<a href="<?php echo esc_url( get_category_link( $category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
	                               	<?php endforeach; ?>
	                               </p>
	                               <h4 class="lv-featured-gallery-content-title-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	                            </div>
	                         </div>
                        </div>
                      </div>
                    </div>
                    <?php endwhile;
                        wp_reset_query();
                    endif;
                    ?>
                 </div>
                </div>
            </div>
        </section>


        <?php else:
            printf('%1$s',
                __('No  Posts  Found', 'bdevs-elementor')
            );
        endif; ?>
        <?php endif;
    }
}