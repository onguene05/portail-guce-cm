<?php
namespace Elementor;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class Content_Box_Addon_Widget extends Widget_Base {
	
	public function get_name() {
		return 'cbae_content_box_addon';
	}

	public function get_title() {
		return esc_html__( 'Content Box', 'cbae-lang' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	protected function _register_controls() {
		
		// General Settings
		$this->start_controls_section(
			'cbae_general_settings',
			[
				'label' => esc_html__( 'Content Box Settings', 'cbae-lang' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'cbae_hover_style',
			[
			'label'       	=> esc_html__( 'Effects', 'cbae-lang' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'cbae-design-1',
				'options' 		=> [
					'cbae-design-1' 	=> esc_html__( 'Design 1', 'cbae-lang' ),
					'cbae-design-2' 	=> esc_html__( 'Design 2', 'cbae-lang' ),
					'cbae-design-3' 	=> esc_html__( 'Design 3', 'cbae-lang' ),
					'cbae-design-4' 	=> esc_html__( 'Design 4', 'cbae-lang' ),
					'cbae-design-5' 	=> esc_html__( 'Design 5', 'cbae-lang' ),
					'cbae-design-6' 	=> esc_html__( 'Design 6', 'cbae-lang' ),
					'cbae-design-7' 	=> esc_html__( 'Design 7', 'cbae-lang' ),
				],
			]
		);

		$this->add_responsive_control(
			'cbae_text_align',
			[
				'label' => esc_html__( 'Alignment', 'cbae-lang' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'cbae-left' => [
							'title' => esc_html__( 'Left', 'cbae-lang' ),
							'icon' => 'fa fa-align-left',
					],
					'cbae-center' => [
							'title' => esc_html__( 'Center', 'cbae-lang' ),
							'icon' => 'fa fa-align-center',
					],
					'cbae-right' => [
							'title' => esc_html__( 'Right', 'cbae-lang' ),
							'icon' => 'fa fa-align-right',
					]
				],
				'default' => 'cbae-center',
				'condition'    => [
					'cbae_hover_style!' => ['cbae-design-3']
				]
			]
		);

		$this->add_control(
			'cbae_tag',
			[
				'label' 	=> esc_html__( 'Tag', 'cbae-lang' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Tag', 'cbae-lang' ),
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-1','cbae-design-2']
				]
			]
		);

		$this->add_control(
			'cbae_title',
			[
				'label' 	=> esc_html__( 'Title', 'cbae-lang' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Title', 'cbae-lang' ),
			]
		);

		$this->add_control(
			'cbae_description',
			[
				'label' 	=> esc_html__( 'Description', 'cbae-lang' ),
				'type' 		=> Controls_Manager::TEXTAREA,
				'default' 	=> esc_html__( 'Description', 'cbae-lang' ),
			]
		);
		
        $this->add_control(
			'cbae_icon_switch',
			[
				'label'        => esc_html__( 'Show Icon/Image', 'cbae-lang' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => esc_html__( 'Icon', 'cbae-lang' ),
				'label_off'    => esc_html__( 'Image', 'cbae-lang' ),
				'return_value' => 'yes',
				'condition'    => [
					'cbae_hover_style!' => ['cbae-design-1','cbae-design-2','cbae-design-5']
				]
			]
		);

		$this->add_control(
			'cbae_icon',
			[
				'label' => esc_html__( 'Icon', 'cbae-lang' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-desktop',
				'condition'    => [
					'cbae_hover_style!' => ['cbae-design-1','cbae-design-2','cbae-design-5'],
					'cbae_icon_switch' => 'yes'
				]
			]
		);

		$this->add_control(
			'cbae_icon_image',
			[
				'label'			=> esc_html__( 'Icon Image', 'cbae-lang' ),
				'type'			=> Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> ''
				],
				'condition'    => [
					'cbae_hover_style!' => ['cbae-design-1','cbae-design-2','cbae-design-5'],
					'cbae_icon_switch!' => 'yes'
				],
				'show_external'	=> true
			]
		);

		$this->add_control(
			'cbae_image',
			[
				'label'			=> esc_html__( 'Banner Image', 'cbae-lang' ),
				'type'			=> Controls_Manager::MEDIA,
				'default'		=> [
					'url'		=> Utils::get_placeholder_image_src()
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-1']
				],
				'show_external'	=> true
			]
		);

		$this->add_control(
			'cbae_button_text',
			[
				'label' 	=> esc_html__( 'Button', 'cbae-lang' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Read More', 'cbae-lang' ),
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);

		$this->add_control(
			'cbae_button_url',
			[
				'label' 	=> esc_html__( 'Buton URL', 'cbae-lang' ),
				'type' 		=> Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default' => [
					'url' => '',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
		$this->end_controls_section();
		$this->start_controls_section(
			'cbae_grid_style', 
			[
				'label'         => esc_html__('Style', 'cbae-lang' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'titlestyle',
			[
				'label' => __( 'Title', 'cbae-lang' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
        );
        
        $this->add_control(
			'cbae_title_color',
			[
				'label'         => esc_html__('Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-box h4'  => 'color: {{VALUE}};',
				]
			]
		);
		
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'cbae_title_typo',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .cbae-box h4',
			]
		);
		
		$this->add_responsive_control(
			'cbae_title_line_border_bottom',
			[
				'label' => esc_html__( 'Line Width (%)', 'cbae-lang' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 25,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cbae-columns .cbae-box hr' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
                    'cbae_hover_style' => 'cbae-design-5',
                ],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cbae_title_line_border',
				'label' => esc_html__( 'Border', 'cbae-lang' ),
				'selector' => '{{WRAPPER}} .cbae-columns .cbae-box hr',
				'default'     => '1px',
				'condition' => [
                    'cbae_hover_style' => 'cbae-design-5',
                ],
			]
		);
        
        $this->add_control(
			'descstyle',
			[
				'label' => __( 'Description', 'cbae-lang' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
        $this->add_control(
			'cbae_desc_color',
			[
				'label'         => esc_html__('Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-box p'  => 'color: {{VALUE}};',
				]
			]
		);
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'cbae_desc_typo',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .cbae-box p',
			]
		);
        
        $this->add_control(
			'cbae_tag_color',
			[
				'label'         => esc_html__('Tag Text Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-tag'  => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-1','cbae-design-2']
				]
			]
		);
        
        $this->add_control(
			'iconstyle',
			[
				'label' => __( 'Icon', 'cbae-lang' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cbae_icon_font_size',
			[
				'label' => esc_html__( 'Icon Size', 'cbae-lang' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '40'
				],
				'selectors' => [
					'{{WRAPPER}} .cbae-columns .cbae-box-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cbae-container .cbae-columns .cbae-box-icon' => 'padding: calc( {{SIZE}}{{UNIT}} / 2 ); width: calc( {{SIZE}}{{UNIT}} * 2 ); height: calc( {{SIZE}}{{UNIT}} * 2 );',
				],
				'condition' => [
					'cbae_icon_switch' => 'yes',
				]
			]
		);
		
        $this->add_control(
			'cbae_icon_color',
			[
				'label'         => esc_html__('Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-box-icon'  => 'color: {{VALUE}};',
				]
			]
		);
        
        $this->add_control(
			'cbae_icon_bg',
			[
				'label' => esc_html__( 'Background Color', 'cbae-lang' ),
				'type' => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-box-icon'  => 'background-color: {{VALUE}};',
				]
			]
		);
        
        $this->add_control(
			'btnstyle',
			[
				'label' => __( 'Button', 'cbae-lang' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'          => 'cbae_button_typo',
				'scheme'        => Scheme_Typography::TYPOGRAPHY_1,
				'selector'      => '{{WRAPPER}} .cbae-info .cbae-button a',
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
		$this->add_control(
			'cbae_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cbae-lang' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cbae-info .cbae-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);

		$this->add_control(
			'cbae_box_padding',
			[
				'label' => esc_html__( 'Padding', 'cbae-lang' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cbae-info .cbae-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				],
			]
		);
		
		$this->add_control(
			'cbae_box_margin',
			[
				'label' => esc_html__( 'Margin', 'cbae-lang' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cbae-info .cbae-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
		$this->start_controls_tabs( 'cbae_button_tab_style' );
		$this->start_controls_tab(
			'cbae_tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'cbae-lang' ),
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
        
        $this->add_control(
			'cbae_button_color',
			[
				'label'         => esc_html__('Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-info .cbae-button a'  => 'color: {{VALUE}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
        $this->add_control(
			'cbae_button_bg',
			[
				'label' => esc_html__( 'Background Color', 'cbae-lang' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cbae-info .cbae-button a'  => 'background-color: {{VALUE}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'cbae_tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'cbae-lang' ),
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
        
        $this->add_control(
			'cbae_button_color_hover',
			[
				'label'         => esc_html__('Color', 'cbae-lang' ),
				'type'          => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-info .cbae-button a:hover'  => 'color: {{VALUE}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
        $this->add_control(
			'cbae_button_bg_hover',
			[
				'label' => esc_html__( 'Background Color', 'cbae-lang' ),
				'type' => Controls_Manager::COLOR,
				'selectors'     => [
					'{{WRAPPER}} .cbae-info .cbae-button a:hover'  => 'background-color: {{VALUE}};',
				],
				'condition'    => [
					'cbae_hover_style' => ['cbae-design-2']
				]
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
        $this->end_controls_section();
		$this->start_controls_section(
			'cbae_box_style', 
			[
				'label'         => esc_html__('Box', 'cbae-lang' ),
				'tab'           => Controls_Manager::TAB_STYLE,
			]
		);
		
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'cbae_box_bg',
				'label' => esc_html__( 'Background', 'cbae-lang' ),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .cbae-box',
			]
		);

		$this->add_control(
			'cbae_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'cbae-lang' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cbae-box, {{WRAPPER}} .cbae-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="cbae-container <?php echo $settings['cbae_hover_style'] . ' ' . $settings['cbae_text_align']; ?>" data-hover="<?php echo $settings['cbae_hover_style']; ?>">
			<div class="cbae-columns">
				<div class="cbae-box">
					<?php
					if(($settings['cbae_hover_style'] == 'cbae-design-1') || ($settings['cbae_hover_style'] == 'cbae-design-2')){
						if($settings['cbae_hover_style'] == 'cbae-design-1' && $settings['cbae_image']['url'] != ''){ ?>
							<img src="<?php echo $settings['cbae_image']['url']; ?>" />
						<?php } ?>
						<div class="cbae-info">
							<?php if($settings['cbae_tag'] != ''){ ?><div class="cbae-tag"><?php echo $settings['cbae_tag']; ?></div><?php } ?>
							<?php if($settings['cbae_title'] != ''){ ?><h4><?php echo $settings['cbae_title']; ?> </h4><?php } ?>
							<?php if($settings['cbae_description'] != ''){ ?><p><?php echo $settings['cbae_description']; ?></p><?php } ?>
							<?php if(($settings['cbae_hover_style'] == 'cbae-design-2') && $settings['cbae_button_text'] != ''){ ?>
								<div class="cbae-button">
									<a href="<?php echo $settings['cbae_button_url']['url']; ?>" <?php if(!empty($settings['cbae_button_url']['is_external'])) : ?>target="_blank"<?php endif; ?> <?php if(!empty($settings['cbae_button_url']['nofollow'])) : ?>rel="nofollow"<?php endif; ?>><?php echo $settings['cbae_button_text']; ?></a>
								</div>
							<?php } ?>
						</div>
					<?php } else {
						if($settings['cbae_hover_style'] != 'cbae-design-5'){ ?>
							<div class="cbae-box-left">
							<?php if($settings['cbae_icon_switch'] == 'yes'){ 
								if($settings['cbae_icon'] != ''){ ?><i class="cbae-box-icon <?php echo $settings['cbae_icon']; ?>"></i><?php } ?>
							<?php } else {
								if($settings['cbae_icon_image']['url'] != ''){ ?><img class="cbae-box-icon" src="<?php echo $settings['cbae_icon_image']['url']; ?>" /><?php } ?>
							<?php } ?>
							</div>
						<?php } ?>
						<div class="cbae-box-right">
							<?php
							if($settings['cbae_title'] != ''){ ?><h4><?php echo $settings['cbae_title']; ?> </h4><?php }
							if($settings['cbae_hover_style'] == 'cbae-design-5'){ echo '<hr />'; }
							if($settings['cbae_description'] != ''){ ?><p><?php echo $settings['cbae_description']; ?></p><?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
		?>
		<div class="cbae-container {{{ settings.cbae_hover_style }}} {{{ settings.cbae_text_align }}}" data-hover="{{{ settings.cbae_hover_style }}}">
			<div class="cbae-columns">
				<div class="cbae-box">
					<#
					if((settings.cbae_hover_style == 'cbae-design-1') || (settings.cbae_hover_style == 'cbae-design-2')){
						if((settings.cbae_hover_style == 'cbae-design-1') && settings.cbae_image.url != ''){ #>
							<img src="{{{ settings.cbae_image.url }}}" />
						<# } #>
						<div class="cbae-info">
							<# if(settings.cbae_tag != ''){ #><div class="cbae-tag">{{{ settings.cbae_tag }}}</div><# } #>
							<# if(settings.cbae_title != ''){ #><h4>{{{ settings.cbae_title }}}</h4><# } #>
							<# if(settings.cbae_description != ''){ #><p>{{{ settings.cbae_description }}}</p><# } #>
							<# if((settings.cbae_hover_style == 'cbae-design-2') && settings.cbae_button_text != ''){ #>
								<div class="cbae-button">
									<a href="{{{ settings.cbae_button_url.url }}}" <# if(settings.cbae_button_url.is_external != ''){ #>target="_blank"<# } #> <# if(settings.cbae_button_url.nofollow != ''){ #>rel="nofollow" <# } #>>{{{ settings.cbae_button_text }}}</a>
								</div>
							<# } #>
						</div>
					<# } else {
						if(settings.cbae_hover_style != 'cbae-design-5') { #>
							<div class="cbae-box-left">
								<# if(settings.cbae_icon_switch == 'yes'){ 
									if(settings.cbae_icon != ''){ #><i class="cbae-box-icon {{{settings.cbae_icon}}}"></i><# } #>
								<# } else {
									if(settings.cbae_icon_image.url != ''){ #><img class="cbae-box-icon" src="{{{ settings.cbae_icon_image.url }}}" /><# } #>
								<# } #>
							</div>
						<# } #>
						<div class="cbae-box-right">
							<#
							if(settings.cbae_title != ''){ #><h4>{{{ settings.cbae_title }}}</h4><# }
							if(settings.cbae_hover_style == 'cbae-design-5') { #> <hr> <# }
							if(settings.cbae_description != ''){ #><p>{{{ settings.cbae_description }}}</p><# } #>
						</div>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Content_Box_Addon_Widget() );