<?php

namespace Generic\Elements;

defined('ABSPATH') || die();

class Skill extends GenericWidget {

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
        return 'generic-skill';
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
        return esc_html__('Skill', 'generic-elements');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/skill/';
    }
    public function get_script_depends()
    {
        return ['bootstrap', 'wow-js', 'magnific-popup', 'generic-element-js'];
    }

    public function get_style_depends()
    {
        return ['bootstrap', 'fontawesome', 'animate-css', 'magnific-popup', 'generic-element-css'];
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
        return 'eicon-skill-bar gen-icon';
    }

    public function get_keywords()
    {
        return ['fact', 'image', 'counter', 'skill'];
    }
    public function get_categories()
    {
        return ['generic-elements'];
    }


    // register_content_controls
    protected function register_content_controls(){
        $this->skill_content_controls();
    }

    // skill_content_controls
    protected function skill_content_controls(){
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => esc_html__('Fact List', 'generic-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Skill Number', 'generic-elements'),
                'default' => esc_html__('70%', 'generic-elements'),
                'placeholder' => esc_html__('Type Number here', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Title', 'generic-elements'),
                'default' => esc_html__('Generic Title', 'generic-elements'),
                'placeholder' => esc_html__('Type title here', 'generic-elements'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
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


    // register_style_controls
    protected function register_style_controls(){
        $this->skill_bars_style_controls();
        $this->skill_content_style_controls();
    }

    // skill_bars_style_controls
    protected function skill_bars_style_controls() {
		$this->start_controls_section(
            '_section_style_bars',
            [
                'label' => esc_html__( 'Skill Bars', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress.generic-el-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .progress.generic-el-progress' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'spacing',
            [
                'label' => esc_html__( 'Spacing Between', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 25,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-wrapper .generic-el-skill-single:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .progress.generic-el-progress, {{WRAPPER}} .progress-bar.generic-el-progress-bar ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .generic-el-skill-wrapper .progress'
            ]
        );

        $this->end_controls_section();
	}

    // skill_content_style_controls
    protected function skill_content_style_controls() {

        $this->start_controls_section(
            '_section_content',
            [
                'label' => esc_html__( 'Content', 'generic-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Label Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_bottom_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'generic-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .generic-el-skill-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'label_text_shadow',
                'selector' => '{{WRAPPER}} .generic-el-skill-title',
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Percent Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-title-wrap span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'percent_typography',
                'selector' => '{{WRAPPER}} .generic-el-skill-title-wrap span',
            ]
        );

        $this->add_control(
            'level_color',
            [
                'label' => esc_html__( 'Progress Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-wrapper .progress .progress-bar' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'base_color',
            [
                'label' => esc_html__( 'Progress Base Color', 'generic-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .generic-el-skill-wrapper .progress' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();
    }


    // Render Function
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'generic-el-title');
        if (empty($settings['slides'])) {
            return;
        }

        ?>
            <section class="generic-skil-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="generic-el-skill-wrapper">
                                <?php foreach ($settings['slides'] as $slide) : ?>
                                    <div class="generic-el-skill-single">
                                        <div class="generic-el-skill-title-wrap">
                                            <?php if (!empty($slide['title'])) : ?>
                                                <h5 class="generic-el-skill-title"><?php echo wp_kses_post($slide['title']); ?></h5>
                                            <?php endif; ?>

                                            <span data-left="<?php echo esc_html($slide['number']); ?>"><?php echo wp_kses_post($slide['number']); ?></span>

                                        </div>
                                        <div class="progress generic-el-progress">
                                            <div class="progress-bar generic-el-progress-bar wow slideInLeft" data-wow-duration="5s" data-wow-delay="0.5s" role="progressbar" data-width="<?php echo esc_html($slide['number']); ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
}
