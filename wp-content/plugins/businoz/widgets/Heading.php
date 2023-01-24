<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Heading  extends \Generic\Elements\GenericWidget
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
        return 'cust_heading';
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
        return __('Heading', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/heading/';
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
        return 'eicon-header gen-icon';
    }

    public function get_keywords()
    {
        return ['hero', 'blurb', 'infobox', 'content', 'block', 'heading', 'box'];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {

        $this->design_style();
        $this->title_and_desc();
    }

    public function design_style()
    {

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Presets', 'bdevs-elementor'),
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
                    'design_7' => __('Design 7', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
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
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Back Title',
                'placeholder' => __('Heading Back Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2', 'design_3', 'design_4', 'design_5', 'design_6', 'design_7'],
                ],
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
            'description',
            [
                'label' => __('Description', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_4'],
                ],
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


    protected function register_style_controls()
    {

        $this->title_style_controls();
        $this->description_style_controls();
    }

    protected function title_style_controls()
    {

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Title / Content', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Title', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

        // Subtitle    
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Subtitle', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_2', 'design_7'],
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'designs' => ['design_2', 'design_7'],
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'designs' => ['design_2', 'design_7'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
                'condition' => [
                    'designs' => ['design_2', 'design_7'],
                ],
            ]
        );
    }

    // Description Control
    protected function description_style_controls()
    {

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Description', 'bdevs-elementor'),
                'separator' => 'before',
                'condition' => [
                    'designs' => ['design_10'],
                ],

            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],

            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content p' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]

        );


        $this->end_controls_section();
    }


    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'section-title bdevs-el-title  bdevs-el-btn');

        $this->add_inline_editing_attributes('button_text', 'none');
        $this->add_render_attribute('button_text', 'class', '');
        $this->add_render_attribute('button', 'class', 'z-btn z-btn-border ');

        if (!empty($settings['button_link'])) {
            $this->add_link_attributes('button', $settings['button_link']);
        }


?>
        <?php if ($settings['designs'] === 'design_7') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-5 bdevs-el-title');
        ?>

            <div class="bd-section__title-5">
                <?php if ($settings['sub_title']) : ?>
                    <h5 class="bd-smaill__title-5 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h5>
                <?php endif; ?>
                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
            </div>

        <?php elseif ($settings['designs'] === 'design_6') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-5 bdevs-el-title');
        ?>

            <div class="bd-section__title-5">
                <?php if ($settings['sub_title']) : ?>
                    <h5 class="bd-smaill__title-5 d-1 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h5>
                <?php endif; ?>

                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
            </div>


        <?php elseif ($settings['designs'] === 'design_5') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-3 medium bdevs-el-title');
        ?>


            <div class="bd-section__title-3">
                <?php if ($settings['sub_title']) : ?>
                    <h6 class="bd-small__title-3 bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                <?php endif; ?>

                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
            </div>

        <?php elseif ($settings['designs'] === 'design_4') :

            $this->add_render_attribute('title', 'class', 'bd-big__title-4 bdevs-el-title');
        ?>

            <div class="bd-section-title-4 text-center bdevs-el-content">
                <?php if ($settings['sub_title']) : ?>
                    <h6 class="bd-small__title-4 mb-10"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                <?php endif; ?>
                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
                <?php if ($settings['description']) : ?>
                    <p class="bd-paragraph-title faq"><?php echo wp_kses_post($settings['description']); ?></p>
                <?php endif; ?>
            </div>

        <?php elseif ($settings['designs'] === 'design_3') :

            $this->add_render_attribute('title', 'class', 'wow fadeInUp2 bd-big__title mb-15 bdevs-el-title');
            $this->add_render_attribute('title', 'data-wow-delay', '.2s');
        ?>

            <div class="bd-section-title-4">
                <?php if ($settings['sub_title']) : ?>
                    <h6 class="bdevs-el-subtitle bd-small__title-4 mb-15"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                <?php endif; ?>
                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
            </div>

        <?php elseif ($settings['designs'] === 'design_2') :
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bdevs-el-title');
        ?>


            <div class="bd-section__title-two common mb-45">
                <?php if ($settings['sub_title']) : ?>
                    <h6 class="bdevs-el-subtitle"><?php echo wp_kses_post($settings['sub_title']); ?></h6>
                <?php endif; ?>
                <?php if ($settings['title']) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['title_tag']),
                        $this->get_render_attribute_string('title'),
                        wp_kses_post($settings['title'])
                    );
                endif; ?>
            </div>


        <?php else :
            $this->add_inline_editing_attributes('title', 'basic');
            $this->add_render_attribute('title', 'class', 'bd-big__title bdevs-el-title');
        ?>
            <?php if ($settings['title']) : ?>
                <div class="bd-section__title common  p-relative z-index-11">
                    <?php if ($settings['back_title']) : ?>
                        <span class="bd-stroke__title"><?php echo wp_kses_post($settings['back_title']); ?></span>
                    <?php endif; ?>

                    <?php if ($settings['sub_title']) : ?>
                        <strong class="bd-small__title common"><?php echo wp_kses_post($settings['sub_title']); ?></strong>
                    <?php endif; ?>

                    <?php if ($settings['title']) :
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            wp_kses_post($settings['title'])
                        );
                    endif; ?>
                </div>
            <?php endif; ?>

        <?php endif; ?>

<?php
    }
}
