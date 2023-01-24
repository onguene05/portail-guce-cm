<?php

namespace Bdevs\Elementor;
defined('ABSPATH') || die();

class Iconbox extends \Generic\Elements\GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Generic Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'iconbox';
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
        return __('Iconbox', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/iconbox/';
    }

    public function get_script_depends()
    {
        return ['bootstrap', 'magnific-popup', 'genwow', 'bdevs-elementor-js'];
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'magnific-popup', 'fontawesome', 'bdevs-elementor-css', 'bdevs-elementor-flaticon', 'gen-editor-pro'];
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-icon-box gen-icon';
    }

    public function get_keywords() {
        return [ 'info', 'box', 'icon' ];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {
        $this->design_style();
        $this->icon_image();
        $this->iconbox_content();
        $this->button_content_controls();
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
                    'design_5' => __('Design 5', 'bdevs-elementor'),
                    'design_6' => __('Design 6', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();
    }


    public function icon_image()
    {
        $this->start_controls_section(
            '_section_media',
            [
                'label' => __( 'Icon / Image', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2','design_3','design_4', 'design_5'],
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => __( 'Media Type', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', 'bdevs-elementor' ),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'bdevs-elementor' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

        $this->end_controls_section();
    }

    // Iconbox Content
    public function iconbox_content()
    {
        $this->start_controls_section(
            '_section_iconbox_content',
            [
                'label' => __( 'Content', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __( 'Number', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Number', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );


        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'Icon Box', 'bdevs-elementor' ),
                'placeholder' => __( 'Type Icon Box Title', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );


        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'Icon Description', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_3', 'design_5'],
                ],
            ]
        );


        $this->add_control(
            'icon_box_link',
            [
                'label' => __( 'Icon Box Link', 'bdevselement' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '#', 'bdevselement' ),
                'placeholder' => __( 'Type Icon Box Link Here', 'bdevselement' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_5', 'design_6'],
                ],
            ]
        );

        $this->add_control(
            'svg_icon',
            [
                'label' => __( 'SVG', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'Icon Description', 'bdevs-elementor' ),
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
                'label' => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'separator' => 'before',
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
                'default' => 'h3',
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
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justify', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-justify',
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



    protected function button_content_controls() {

		$this->start_controls_section(
			'_section_button',
			[
				'label' => __( 'Button', 'bdevs-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_10'],
                ],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Button Text',
				'placeholder' => __( 'Type button text here', 'bdevs-elementor' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'button_link',
			[
				'label' => __( 'Link', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'button_fullwidth',
			[
				'label' => __( 'Full Width?', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => false,
				'return_value' => 'yes',
				'style_transfer' => true,
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-btn' => 'display: -webkit-box; display: -ms-flexbox; display: flex; align-items: center;',
				]
			]
		);

		$this->add_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
					'stretch' => [
						'title' => __( 'Stretch', 'bdevs-elementor' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'toggle' => false,
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-btn' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;',
					'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;',
					'right' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;',
					'stretch' => '-webkit-box-pack: justify; -ms-flex-pack: justify; justify-content: space-between;',
				],
				'condition' => [
					'button_fullwidth' => 'yes',
				],
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
				'label' => __( 'Icon Position', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'before' => __( 'Before Text', 'bdevs-elementor' ),
					'after' => __( 'After Text', 'bdevs-elementor' ),
				],
				'default' => 'before',
				'toggle' => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-btn .gen-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdevs-el-btn .gen-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

    protected function register_style_controls() {
		$this->icon_style_controls();
		$this->title_style_controls();
		$this->description_style_controls();
		$this->button_style_controls();
	}

    protected function icon_style_controls() {

		$this->start_controls_section(
			'_section_style_icon',
			[
				'label' => __( 'Icon/Image', 'bdevs-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'offset_toggle',
			[
				'label' => __( 'Offset', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'None', 'bdevs-elementor' ),
				'label_on' => __( 'Custom', 'bdevs-elementor' ),
				'return_value' => 'yes',
			]
		);
        $this->start_popover();

		$this->add_responsive_control(
			'media_offset_x',
			[
				'label' => __( 'Offset Left', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ha-infobox-media-offset-x: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'media_offset_y',
			[
				'label' => __( 'Offset Top', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'condition' => [
					'offset_toggle' => 'yes'
				],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ha-infobox-media-offset-y: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_popover();

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 150,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .gen-icon-box-icon'
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .gen-icon-box-icon'
			]
		);

		$this->start_controls_tabs( '_tabs_icon' );

		$this->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => __( 'Normal', 'bdevs-elementor' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'bdevs-elementor' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .gen-icon-box-icon',
			]
		);

		// $this->add_control(
		// 	'icon_bg_color',
		// 	[
		// 		'label' => __( 'Background Color', 'bdevs-elementor' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .gen-icon-box-icon' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );

		$this->add_control(
			'icon_bg_rotate',
			[
				'label' => __( 'Rotate Icon Box', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gen-icon-box-icon' => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .gen-icon-box-icon > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'icon_bg_color!' => '',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_gen_button_hover',
			[
				'label' => __( 'Hover', 'bdevs-elementor' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .gen-icon-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color',
			[
				'label' => __( 'Background Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .gen-icon-box-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label' => __( 'Border Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .gen-icon-box-icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_border_border!' => '',
				]
			]
		);

		$this->add_control(
			'icon_hover_bg_rotate',
			[
				'label' => __( 'Rotate Icon Box', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .gen-icon-box-icon' => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}}:hover .gen-icon-box-icon > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
				],
				'condition' => [
					'icon_bg_color!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    // Title Control
    protected function title_style_controls() {

		$this->start_controls_section(
			'_section_style_title',
			[
				'label' => __( 'Title', 'bdevs-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .bdevs-el-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .bdevs-el-title',
			]
		);

        $this->add_responsive_control(
            'title_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->start_controls_tabs( '_tabs_title' );

		$this->start_controls_tab(
			'_tab_title_normal',
			[
				'label' => __( 'Normal', 'bdevs-elementor' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_title_hover',
			[
				'label' => __( 'Hover', 'bdevs-elementor' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Text Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .bdevs-el-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    // Description Control
    protected function description_style_controls() {

		$this->start_controls_section(
			'_section_style_description',
			[
				'label' => __( 'Description', 'bdevs-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc',
				'selector' => '{{WRAPPER}} .bdevs-el-desc',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-desc' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
            'desc_bottom_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();
	}

    // Button style control
    protected function button_style_controls() {

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

        $this->add_control(
			'gen_button_border_color',
			[
				'label' => __( 'Border Color', 'bdevs-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-btn' => 'border-color: {{VALUE}};',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdevs-el-btn:hover' => 'border-color: {{VALUE}};',
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
    ?>

        <?php if ($settings['designs'] === 'design_6'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

        <div class="faq-wrapper mb-10">
            <div class="faq-question-item">
                <?php if ($settings['title']) : ?>
                <div class="faq-queastion-text">
                    <a href="<?php echo esc_url( $settings['icon_box_link'] ); ?>"><?php echo wp_kses_post($settings['title']); ?></a>
                </div>
                <?php endif; ?>

                <div class="faqicon-arrow">
                    <a href="<?php echo esc_url( $settings['icon_box_link'] ); ?>"><i class="far fa-chevron-right"></i></a>
                </div>
            </div>
        </div>

        <?php elseif ($settings['designs'] === 'design_5'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

	    <div class="topic-wrapper text-center mb-20">
	        <div class="topic-items">
	            <div class="topic-svg mb-30">
                    <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                        <figure>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        </figure>
                        <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                        <figure>
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </figure>
                    <?php endif; ?>
	            </div>
	            <div class="topic-content">
	            	<?php if ($settings['title']) : ?>
	                <h4><a href="<?php echo esc_url( $settings['icon_box_link'] ); ?>">
	                	<?php echo wp_kses_post($settings['title']); ?>
	                </a></h4>
	            	<?php endif; ?>

		            <?php if ($settings['description']) : ?>
		            <p class="bdevs-el-desc"><?php echo wp_kses_post($settings['description']); ?></p>
		            <?php endif; ?>
	            </div>
	        </div>
	    </div>

        <?php elseif ($settings['designs'] === 'design_4'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

      	<div class="features-wrapper d-flex align-items-center mb-30">
	        <div class="features-icon">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
	        </div>
	        <div class="features-content">
                <?php if ( $settings['title' ] ) :
                    printf( '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape( $settings['title_tag'] ),
                        $this->get_render_attribute_string( 'title' ),
                        wp_kses_post( $settings['title' ] )
                        );
                endif; ?>
	        </div>
      	</div>


        <?php elseif ($settings['designs'] === 'design_3'):

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

	    <div class="features-box text-center mb-30">
	        <div class="features-svg">
	            <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                    $this->get_render_attribute_string( 'image' );
                    $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                    ?>
                    <figure>
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                    </figure>
                    <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                    <figure>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </figure>
                <?php endif; ?>
	         </div>
	         <div class="features-text">
	         	<?php if ($settings['title']) : ?>
	            <h4 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h4>
	            <?php endif; ?>

	            <?php if ($settings['description']) : ?>
	            <p class="bdevs-el-desc"><?php echo wp_kses_post($settings['description']); ?></p>
	            <?php endif; ?>
	        </div>
	    </div>

        <?php elseif ($settings['designs'] === 'design_2'):

            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>


        <div class="counter-wrapper text-center mb-30">
            <div class="counter-icon">
                <div class="svgicon">
                	<?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
                        $this->get_render_attribute_string( 'image' );
                        $settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                        ?>
                        <figure>
                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                        </figure>
                        <?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
                        <figure>
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </figure>
                    <?php endif; ?>
                </div>

                <div class="count-number">
                	<?php if ($settings['number']) : ?>
                    <span class="counter"><?php echo wp_kses_post($settings['number']); ?></span>
                    <?php endif; ?>

                    <?php if ($settings['title']) : ?>
                    <p class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <?php else:

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'bdevs-el-title');

        ?>

        <a  href="<?php echo esc_url( $settings['icon_box_link'] ); ?>">
            <div class="catagory-wrapper">
            	<?php if ($settings['svg_icon']) : ?>
                <div class="catagory-thumb">
                   <?php echo $settings['svg_icon']; ?>
                </div>
                <?php endif; ?>
                <div class="catagory-content">

	                <?php if ( $settings['title' ] ) :
	                    printf( '<%1$s %2$s>%3$s</%1$s>',
	                        tag_escape( $settings['title_tag'] ),
	                        $this->get_render_attribute_string( 'title' ),
	                        wp_kses_post( $settings['title' ] )
	                        );
	                endif; ?>

                	<?php if ($settings['description']) : ?>
                    <span class="bdevs-el-desc"><?php echo wp_kses_post($settings['description']); ?></span>
                	<?php endif; ?>
                </div>
            </div>
        </a>


 


        <?php endif; ?>
    <?php
    }
}
