<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class InfoBox extends GenericWidget {

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
	public function get_name()
	{
		return 'generic-info-box';
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
		return esc_html__('Info Box', 'generic-elements');
	}

	public function get_custom_help_url()
	{
		return 'http://elementor.bdevs.net/bdevselement/info-box/';
	}

	public function get_script_depends()
	{
		return ['bootstrap', 'generic-element-js'];
	}

	public function get_style_depends()
	{
		return ['bootstrap', 'fontawesome', 'generic-element-css'];
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
		return 'eicon-info-box gen-icon';
	}

	public function get_keywords()
	{
		return ['info', 'box', 'icon'];
	}
	public function get_categories()
	{
		return ['generic-elements'];
	}

	// register_content_controls
	protected function register_content_controls(){
		$this->icon_image_content_controls();
		$this->infobox_content_controls();
		$this->button_content_controls();
	}

	// icon_image_content_controls
	public function icon_image_content_controls(){
		$this->start_controls_section(
			'_section_media',
			[
				'label' => esc_html__('Icon / Image', 'generic-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'media_type',
			[
				'label'          => esc_html__('Media Type', 'generic-elements'),
				'type'           => \Elementor\Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [
					'icon'  => [
						'title' => esc_html__('Icon', 'generic-elements'),
						'icon'  => 'far fa-grin-wink',
					],
					'image' => [
						'title' => esc_html__('Image', 'generic-elements'),
						'icon'  => 'eicon-image',
					],
				],
				'default'        => 'icon',
				'toggle'         => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label'     => esc_html__('Image', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'media_type' => 'image'
				],
				'dynamic'   => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'medium_large',
				'separator' => 'none',
				'exclude'   => [
					'full',
					'custom',
					'large',
					'shop_catalog',
					'shop_single',
					'shop_thumbnail'
				],
				'condition' => [
					'media_type' => 'image'
				]
			]
		);

		$this->add_control(
			'icons',
			[
				'label'      => esc_html__('Icons', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::ICONS,
				'show_label' => true,
				'default'    => [
					'value'   => 'far fa-grin-wink',
					'library' => 'solid',
				],
				'condition'  => [
					'media_type' => 'icon',
				],

			]
		);

		$this->end_controls_section();
	}

	// InfoBox content controls
	public function infobox_content_controls(){
		$this->start_controls_section(
			'_section_infobox_content',
			[
				'label' => esc_html__('Content', 'generic-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Generic Title', 'generic-elements'),
				'placeholder' => esc_html__('Type Generic Title Here', 'generic-elements'),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_control(
			'description',
			[
				'label' => esc_html__('Description', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Generic Description', 'generic-elements'),
				'placeholder' => esc_html__('Type Generic Description Here', 'generic-elements'),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__('Title HTML Tag', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'separator' => 'before',
				'options' => [
					'h1'  => [
						'title' => esc_html__('H1', 'generic-elements'),
						'icon' => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => esc_html__('H2', 'generic-elements'),
						'icon' => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => esc_html__('H3', 'generic-elements'),
						'icon' => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => esc_html__('H4', 'generic-elements'),
						'icon' => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => esc_html__('H5', 'generic-elements'),
						'icon' => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => esc_html__('H6', 'generic-elements'),
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
				'label' => esc_html__('Alignment', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'generic-elements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'generic-elements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'generic-elements'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .generic-el-infobox-wrapper' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
	}

    // button_content_controls
    protected function button_content_controls(){

        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__('Button', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Text', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => esc_html__('Type button text here', 'generic-elements'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'generic-elements'),
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
                'label' => esc_html__('Full Width?', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => false,
                'return_value' => 'yes',
                'style_transfer' => true,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'display: -webkit-box; display: -ms-flexbox; display: flex; align-items: center;',
                ]
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'generic-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'generic-elements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => false,
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => '{{VALUE}}',
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
                'label' => esc_html__('Icon Position', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'before' => esc_html__('Before Text', 'generic-elements'),
                    'after' => esc_html__('After Text', 'generic-elements'),
                ],
                'default' => 'before',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn .generic-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .generic-el-btn .generic-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }


	// register_style_controls
	protected function register_style_controls(){
		$this->infobox_content_bg_color_style_controls();
		$this->icon_image_style_controls();
		$this->title_and_description_style_controls();
		$this->button_style_controls();
	}

	// infobox_content_bg_color_style_controls
	protected function infobox_content_bg_color_style_controls(){
		$this->start_controls_section(
			'_section_infobox_content_bg_color',
			[
				'label' => esc_html__('Infobox Content', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('_tabs_infobox_content');

		$this->start_controls_tab(
            '_tab_infobox_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

		$this->add_control(
			'infobox_content_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-infobox-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'generic-elements' ),
				'selector' => '{{WRAPPER}} .generic-el-infobox-wrapper',
			]
		);

		$this->add_responsive_control(
			'infobox_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'generic-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .generic-el-infobox-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadows',
				'exclude' => [
					'box_shadow_positions',
				],
				'selector' => '{{WRAPPER}} .generic-el-infobox-wrapper'
			]
		);

		$this->end_controls_tab();

		// Hover
        $this->start_controls_tab(
            '_tab_infobox_content_hover',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );
		$this->add_control(
			'infobox_content_hover_bg_color',
			[
				'label' => esc_html__('Content Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-infobox-wrapper:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'hover_border',
				'label' => esc_html__( 'Border', 'generic-elements' ),
				'selector' => '{{WRAPPER}} .generic-el-infobox-wrapper:hover',
			]
		);

		$this->add_responsive_control(
			'infobox_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'generic-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .generic-el-infobox-wrapper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_icon_shadows',
				'exclude' => [
					'box_shadow_positions',
				],
				'selector' => '{{WRAPPER}} .generic-el-infobox-wrapper:hover'
			]
		);

		$this->end_controls_tab();
        $this->end_controls_tabs();

		$this->end_controls_section();
	}

	// icon_style_controls
	protected function icon_image_style_controls(){

		$this->start_controls_section(
			'_section_style_icon',
			[
				'label' => esc_html__('Icon/Image', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__('Size', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-info-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .generic-info-box-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 150,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .generic-info-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .generic-info-box-icon'
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .generic-info-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .generic-info-box-icon'
			]
		);

		$this->start_controls_tabs('_tabs_icon');

		$this->start_controls_tab(
			'_tab_icon_normal',
			[
				'label' => esc_html__('Normal', 'generic-elements'),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-info-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'generic-elements'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .generic-info-box-icon',
			]
		);

		$this->add_control(
			'icon_bg_rotate',
			[
				'label' => esc_html__('Rotate Icon Box', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
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
					'{{WRAPPER}} .generic-info-box-icon' => '-webkit-transform: rotate({{SIZE}}{{UNIT}}); transform: rotate({{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .generic-info-box-icon > i' => '-webkit-transform: rotate(-{{SIZE}}{{UNIT}}); transform: rotate(-{{SIZE}}{{UNIT}});',
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
				'label' => esc_html__('Hover', 'generic-elements'),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .generic-info-box-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .generic-info-box-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .generic-info-box-icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_border_border!' => '',
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	// Title Control
	protected function title_and_description_style_controls(){
		$this->start_controls_section(
			'_section_style_title_and_desc',
			[
				'label' => esc_html__('Title & Description', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Title
		$this->add_control(
			'_heading_title',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'generic-elements' ),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_bottom_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .generic-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title',
				'selector' => '{{WRAPPER}} .generic-el-title',
			]
		);

		// Description
		$this->add_control(
			'_heading_description',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'generic-elements' ),
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc',
				'selector' => '{{WRAPPER}} .generic-el-desc',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Text Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_bottom_spacing',
			[
				'label' => esc_html__('Bottom Spacing', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .generic-el-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

    // Button style control
    protected function button_style_controls(){

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__('Button', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .generic-el-btn',
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
                'label' => esc_html__('Border Radius', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__('Normal', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'gen_button_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'generic-elements'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .generic-el-btn:hover' => 'border-color: {{VALUE}};',
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

		$this->add_inline_editing_attributes('title', 'basic');
		$this->add_render_attribute('title', 'class', 'generic-infobox-title generic-el-title');

		if (!empty($settings['button_link'])) {
			$this->add_render_attribute('button', 'class', 'generic-border-btn generic-el-btn');
			$this->add_link_attributes('button', $settings['button_link']);
		}

		?>
			<div class="generic-ifnobox generic-el-infobox-wrapper">
				<div class="generic-infobox-content generic-el-content">
					<div class="generic-infobox-icon generic-infobox-icon">
						<?php if (!empty($settings['icons']['value'])) : ?>
							<div class="generic-info-box-icon">
								<?php \Elementor\Icons_Manager::render_icon($settings['icons'], ['aria-hidden' => 'true']); ?>
							</div>
						<?php elseif ($settings['image']['url'] || $settings['image']['id']) : ?>
							<div class="generic-info-box-image">
								<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'); ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ($settings['title']) :
						printf(
							'<%1$s %2$s>%3$s</%1$s>',
							tag_escape($settings['title_tag']),
							$this->get_render_attribute_string('title'),
							wp_kses_post($settings['title'])
						);
					endif; ?>

					<?php if ($settings['description']) : ?>
						<p class="generic-el-desc"><?php echo wp_kses_post($settings['description']); ?></p>
					<?php endif; ?>

					<?php if (!empty($settings['button_text'])) : ?>
						<div class="generic-infobox-btn">
							<?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
								printf(
									'<a %1$s>%2$s</a>',
									$this->get_render_attribute_string('button'),
									esc_html($settings['button_text'])
								);
							elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
								<a <?php $this->print_render_attribute_string('button'); ?>><?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
								<?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
								if ($settings['button_icon_position'] === 'before') : ?>
									<a <?php $this->print_render_attribute_string('button'); ?>><?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'generic-btn-icon']); ?>
										<span><?php echo esc_html($settings['button_text']); ?></span></a>
								<?php
								else : ?>
									<a <?php $this->print_render_attribute_string('button'); ?>>
										<span><?php echo esc_html($settings['button_text']); ?></span>
										<?php generic_elements_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'generic-btn-icon']); ?>
									</a>
							<?php
								endif;
							endif; ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php
	}
}
