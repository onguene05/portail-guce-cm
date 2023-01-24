<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class ContactForm7 extends GenericWidget{

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
		return 'generic-contact-from-7';
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
		return esc_html__('Contact Form 7', 'generic-elements');
	}

	public function get_custom_help_url()
	{
		return 'http://elementor.bdevs.net/bdevselement/contact-from-7/';
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
		return 'eicon-form-horizontal gen-icon';
	}

	public function get_keywords()
	{
		return ['cf7', 'contact', 'form', 'contact form', 'block', 'box'];
	}

	public function get_categories()
	{
		return ['generic-elements'];
	}

	public function get_generic_el_contact_form()
	{
		if (!class_exists('WPCF7')) {
			return;
		}
		$generic_cfa         = array();
		$generic_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
		$generic_forms       = get_posts($generic_cf_args);
		$generic_cfa         = ['0' => esc_html__('Select Form', 'generic-elements')];
		if ($generic_forms) {
			foreach ($generic_forms as $generic_form) {
				$generic_cfa[$generic_form->ID] = $generic_form->post_title;
			}
		} else {
			$generic_cfa[esc_html__('No contact form found', 'generic-elements')] = 0;
		}
		return $generic_cfa;
	}


    // register_content_controls
	protected function register_content_controls(){
        $this->contact_form_content_control();
    }

    // contact_form_content_control
    protected function contact_form_content_control(){
		$this->start_controls_section(
			'generic_contact',
			[
				'label' => esc_html__('Contact Form', 'generic-elements'),
			]
		);

		$this->add_control(
			'generic_el_select_contact_form',
			[
				'label'   => esc_html__('Select Form', 'generic-elements'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_generic_el_contact_form(),
			]
		);

		$this->end_controls_section();
    }


	// register_style_controls
	protected function register_style_controls()
	{
		$this->form_content_style_controls();
		$this->input_label_style_controls();
		$this->input_fields_style_controls();
		$this->input_fields_button_style_controls();
	}

    // form_content_style_controls
	protected function form_content_style_controls()
	{
		$this->start_controls_section(
			'_form_content_style_controls',
			[
				'label' => esc_html__('Content', 'generic-elements'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'form_content_padding',
			[
				'label'      => esc_html__('Padding', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .generic-contact-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'form_background',
				'label' => esc_html__('Background', 'generic-elements'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .generic-contact-form',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__('Border', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-contact-form',
			]
		);

		$this->add_responsive_control(
			'form_content_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'generic-elements'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .generic-contact-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'form_content_shadow',
				'selector' => '{{WRAPPER}} .generic-contact-form',
			]
		);

		$this->end_controls_section();
	}

    // input_label_style_controls
	protected function input_label_style_controls()
	{
		$this->start_controls_section(
			'_section_fields_label_style',
			[
				'label' => esc_html__('Form Label', 'generic-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'field_label_padding',
			[
				'label' => esc_html__('Padding', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'field_label_typography',
				'label' => esc_html__('Typography', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-single-input label',
			]
		);
		$this->add_responsive_control(
			'field_label_margin',
			[
				'label' => esc_html__('Spacing Bottom', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'field_label_color',
			[
				'label' => esc_html__('Text Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-single-input label' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_section();
	}

    // input_fields_style_controls
	protected function input_fields_style_controls()
	{

		$this->start_controls_section(
			'_section_fields_style',
			[
				'label' => esc_html__('Form Input Fields', 'generic-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'field_width',
			[
				'label' => esc_html__('Width', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['%', 'px'],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_margin',
			[
				'label' => esc_html__('Spacing Bottom', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input, {{WRAPPER}} .generic-single-input textarea' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_padding',
			[
				'label' => esc_html__('Padding', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'field_border_radius',
			[
				'label' => esc_html__('Border Radius', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'field_typography',
				'label' => esc_html__('Typography', 'generic-elements'),
				'selector' => '{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea',
			]
		);

		$this->add_control(
			'field_color',
			[
				'label' => esc_html__('Text Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea' => 'color: {{VALUE}}',
				],
			]
		);

		$this->start_controls_tabs('tabs_field_state');

		$this->start_controls_tab(
			'tab_field_normal',
			[
				'label' => esc_html__('Normal', 'generic-elements'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'field_border',
				'selector' => '{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'field_box_shadow',
				'selector' => '{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea',
			]
		);

		$this->add_control(
			'field_bg_color',
			[
				'label' => esc_html__('Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input, {{WRAPPER}} .generic-single-input textarea' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_field_focus',
			[
				'label' => esc_html__('Focus', 'generic-elements'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'field_focus_border',
				'selector' => '{{WRAPPER}} .generic-single-input input:focus, {{WRAPPER}} .generic-single-input textarea:focus',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'field_focus_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .generic-single-input input:focus, {{WRAPPER}} .generic-single-input textarea:focus',
			]
		);

		$this->add_control(
			'field_focus_bg_color',
			[
				'label' => esc_html__('Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-single-input input:focus, {{WRAPPER}} .generic-single-input textarea:focus' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

    // input_fields_button_style_controls
	protected function input_fields_button_style_controls()
	{
		// button style
		$this->start_controls_section(
			'_section_form_button_style',
			[
				'label' => esc_html__('Form Button', 'generic-elements'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'form_button_padding',
			[
				'label' => esc_html__('Padding', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'form_button_height',
			[
				'label' => esc_html__('Height', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_button_line_height',
			[
				'label' => esc_html__('Line Height', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 400,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
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
			'form_btn_border_radius',
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
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs('_tabs_button');

		$this->start_controls_tab(
			'_tab_form_button_normal',
			[
				'label' => esc_html__('Normal', 'generic-elements'),
			]
		);

		$this->add_control(
			'form_button_text_color',
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
			'form_button_bg_color',
			[
				'label' => esc_html__('Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'generic-elements'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .generic-el-btn',
			],
		);

		$this->add_control(
			'form_button_border_color',
			[
				'label' => esc_html__('Border Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'_tab_form_button_hover_style',
			[
				'label' => esc_html__('Hover', 'generic-elements'),
			]
		);

		$this->add_control(
			'form_button_hover_text_color',
			[
				'label' => esc_html__('Text Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_button_hover_bg_color',
			[
				'label' => esc_html__('Background Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn:hover,{{WRAPPER}} .generic-el-btn:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'backgrounds',
				'label' => esc_html__('Background', 'generic-elements'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .generic-grad-normal-btn::before',
			]
		);

		$this->add_control(
			'form_button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn:hover, {{WRAPPER}} .generic-el-btn:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'form_button_hover_icon_translate',
			[
				'label' => esc_html__('Icon Translate X', 'generic-elements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .generic-el-btn:hover' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
					'{{WRAPPER}} .generic-el-btn:hover' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	// Render Function
	protected function render(){
		$settings = $this->get_settings_for_display();
		extract($settings);
		?>
			<section class="generic-contact-form-area">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="generic-el-contact-form-wrapper">
								<div class="generic-contact-form">
									<!-- Start Contact Form -->
									<?php if (!empty($settings['generic_el_select_contact_form'])) : ?>
										<div class="form-wrapper">
											<?php echo do_shortcode('[contact-form-7  id="' . $settings['generic_el_select_contact_form'] . '"]'); ?>
										</div>
									<?php else : ?>
										<?php echo '<div class="alert alert-info"><p class="m-0">' . esc_html__('Please Select contact form.', 'generic-elements') . '</p></div>'; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php
	}
}
