<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class FunFactor extends GenericWidget {

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
		return 'generic-fun-factor';
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
		return esc_html__('Fun Factor', 'generic-elements');
	}

	public function get_custom_help_url()
	{
		return 'http://elementor.bdevs.net/bdevselement/fun-factor/';
	}

	public function get_script_depends()
	{
		return ['bootstrap', 'waypoints-js', 'counterup-js', 'generic-element-js'];
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
		return 'eicon-counter gen-icon';
	}

	public function get_keywords()
	{
		return ['fact', 'image', 'counter', 'fun', 'factor'];
	}

	public function get_categories()
	{
		return ['generic-elements'];
	}


	/**
	 * Register widget content controls
	 */
	protected function register_content_controls()
	{
		$this->fun_factor_content_controls();
		$this->fun_factor_settings_controls();
	}

	// fun_factor_content_controls
	protected function fun_factor_content_controls()
	{

		// Fact List
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => esc_html__( 'Fact List', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__('Media Type', 'generic-elements-pro'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'generic-elements-pro'),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'generic-elements-pro'),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'generic-elements-pro'),
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

        $repeater->add_group_control(
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

        $repeater->add_control(
            'selected_icon',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-smile-wink',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );


        $repeater->add_control(
            'fact_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fc4d93',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}} {{CURRENT_ITEM}}.counter__icon svg' => 'fill: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

		$repeater->add_control(
            'fun_factor_number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__( 'Number', 'generic-elements' ),
                'default' => esc_html__( '75', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type Number here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'fun_factor_number_sign',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__( 'Number Sign', 'generic-elements' ),
                'default' => esc_html__( '+', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type Number Sign here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'fun_factor_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__( 'Title', 'generic-elements' ),
                'placeholder' => esc_html__( 'Type title here', 'generic-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(fun_factor_number || "Carousel Item"); #>',
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

	protected function fun_factor_settings_controls(){
        $this->start_controls_section(
            '_section_funfactor_settings',
            [
                'label' => esc_html__('Settings', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'generic-elements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'generic-elements'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .generic-funfact-content' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
	}


	/**
	 * Register widget style controls
	 */
	protected function register_style_controls(){
		$this->fun_factor_content_style_controls();
		$this->fun_factor_icon_image_style_controls();
		$this->fun_factor_number_title_style_controls();
	}

	// fun_factor_content_style_controls
	protected function fun_factor_content_style_controls()
	{
		$this->start_controls_section(
			'_funfact_content_style_controls',
			[
				'label' => esc_html__('Content', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'funfactor_content_padding',
			[
				'label'      => esc_html__('Padding', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'generic-elements'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .generic-funfact-content',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__('Border', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-funfact-content',
			]
		);

		$this->add_responsive_control(
			'funfactor_content_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'funfactor_content_shadow',
				'selector' => '{{WRAPPER}} .generic-funfact-content',
			]
		);

		$this->end_controls_section();
	}

	// fun_factor_icon_image_style_controls
	protected function fun_factor_icon_image_style_controls()
	{

		$this->start_controls_section(
			'_section_style_icon_image',
			[
				'label' => esc_html__('Icon / Image', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label'      => esc_html__('Width', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'media_type' => 'image',
				]
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label'      => esc_html__('Height', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'media_type' => 'image',
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'           => esc_html__('Size', 'generic-elements'),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'size_units'      => ['px'],
				'range'           => [
					'px' => [
						'min'  => 6,
						'max'  => 300,
					],
				],
				'selectors'       => [
					'{{WRAPPER}} .generic-funfact-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'       => [
					'media_type' => 'icon',
				],
				'render_type'     => 'template',
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__('Icon Color', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-funfact-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'media_type' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'media_padding',
			[
				'label'      => esc_html__('Padding', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'media_border',
				'selector'  => '{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image img',
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'media_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'media_box_shadow',
				'selector' => '{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image img',
			]
		);

		$this->add_responsive_control(
			'icon_image_bottom_spacing',
			[
				'label'     => esc_html__('Bottom Spacing', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__('Background Color', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-funfact-icon i, {{WRAPPER}} .generic-funfact-image img' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'media_type' => 'icon'
				]
			]
		);
		$this->end_controls_section();
	}

	// fun_factor_number_title_style_controls
	protected function fun_factor_number_title_style_controls()
	{

		$this->start_controls_section(
			'_section_style_number_title',
			[
				'label' => esc_html__('Number & Title', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'fun_factor_number_heading',
			[
				'label' => esc_html__('Number', 'generic-elements'),
				'type'  => \Elementor\Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'fun_factor_number_bottom_spacing',
			[
				'label'      => esc_html__('Bottom Spacing', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-number' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'fun_factor_number_color',
			[
				'label'     => esc_html__('Color', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-funfact-number' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'label'    => esc_html__('Typography', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-funfact-number',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'fun_factor_number_shadow',
				'label'    => esc_html__('Text Shadow', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-funfact-number',
			]
		);

		// funfactor title style
		$this->add_control(
			'content_title_heading_style',
			[
				'label'     => esc_html__('Title', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'fun_factor_content_bottom_spacing',
			[
				'label'      => esc_html__('Bottom Spacing', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .generic-funfact-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'fun_factor_content_color',
			[
				'label'     => esc_html__('Color', 'generic-elements'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-funfact-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__('Typography', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-funfact-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'fun_factor_content_shadow',
				'label'    => esc_html__('Text Shadow', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-funfact-title',
			]
		);

		$this->end_controls_section();
	}

	// Render Function
	protected function render(){
		$settings = $this->get_settings_for_display();
		?>
			<section class="generic-funfact-area">
				<div class="container">
					<div class="row">
						<?php foreach ($settings['slides'] as $slide) :
							if (!empty($slide['image']['id'])) {
								$image = wp_get_attachment_image_url($slide['image']['id'], $slide['thumbnail_size']);
							}
						?>
						<div class="col-xl-3">
							<div class="generic-el-funfact-wrapper">
								<div class="generic-funfact-content">
									<?php if (!empty($slide['selected_icon'])) : ?>
										<div class="generic-funfact-icon">
											<?php generic_elements_render_icon($slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon']); ?>
										</div>
									<?php else : ?>
										<div class="generic-funfact-image">
											<img src="<?php echo esc_url($image); ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($image), '_wp_attachment_image_alt', true); ?>" />
										</div>
									<?php endif; ?>

									<?php if (!empty($slide['fun_factor_number'])) : ?>
										<h2 class="generic-funfact-number"><span class="counter"> <?php echo wp_kses_post($slide['fun_factor_number']); ?> </span><?php echo wp_kses_post($slide['fun_factor_number_sign']); ?></h2>
									<?php endif; ?>

									<?php if (!empty($slide['fun_factor_title'])) : ?>
										<span class="generic-funfact-title"> <?php echo wp_kses_post($slide['fun_factor_title']); ?> </span>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php
	}
}
