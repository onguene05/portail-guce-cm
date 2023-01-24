<?php

namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class Accordion extends \Generic\Elements\GenericWidget
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
        return 'accordion-pro';
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
        return __('Accordion', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/accordion/';
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
        return 'eicon-plug gen-icon';
    }

    public function get_keywords()
    {
        return ['accordion', 'services', 'tab'];
    }
    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
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
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // Faq List
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __('Faq List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Tab Title', 'bdevs-elementor'),
                'default' => __('Tab Title', 'bdevs-elementor'),
                'placeholder' => __('Type title here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'tab_content_info',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => false,
                'default' => __('Content Here', 'bdevs-elementor'),
                'placeholder' => __('Type subtitle here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(tab_title || "Carousel Item"); #>',
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
    protected function register_style_controls()
    {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __('Accordion Content', 'bdevs-elementor'),
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
                    '{{WRAPPER}} .bdevs-el-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .bdevs-el-content',
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
                    '{{WRAPPER}} .bd-faqs .accordion-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_bg_color',
            [
                'label' => __('Text BG Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bd-faqs .accordion-button' => 'background-color: {{VALUE}}',
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

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Description', 'bdevs-elementor'),
                'separator' => 'before'
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
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .bdevs-el-content p',
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ( $settings['designs'] === 'design_3' ):

            $this->add_render_attribute('title', 'class', 'big_title text-white mb-0');
            $title = wp_kses_post($settings['title'] ?? '');

            if (empty($settings['slides'])) {
                return;
            }
        ?>

        <section class="">
            <div class="container">
                <h1>This is Fact Style 03</h1>
            </div>
        </section>


        <!-- style 2 -->
        <?php elseif ( $settings['designs'] === 'design_2' ):
            $this->add_render_attribute('title', 'class', 'big_title text-white mb-0');
            $title = wp_kses_post($settings['title'] ?? '');

            if (empty($settings['slides'])) {
                return;
            }

        ?>

        <section class="">
            <div class="container">
                <h1>This is Fact Style 02</h1>
            </div>
        </section>


        <?php else:

        $this->add_render_attribute('title', 'class', 'big_title text-white mb-0');
        $title = wp_kses_post($settings['title'] ?? '');

        if (empty($settings['slides'])) {
            return;
        }

        ?>

        <section class="">
            <div class="container">
                <h1>This is Fact Style 02</h1>
            </div>
        </section>

        <section class="bd-faq-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="bd-faqs">
                            <div class="accordion" id="accordionExample">
                                <?php foreach ($settings['slides'] as $id => $slide) :
                                    // active class
                                    $collapsed_tab = ($id == 0) ? '' : 'collapsed';
                                    $area_expanded = ($id == 0) ? 'true' : 'false';
                                    $active_show_tab = ($id == 0) ? 'show' : '';
                                ?>
                                    <div class="accordion-item bdevs-el-content">
                                        <h2 class="accordion-header" id="headingOne_<?php echo esc_attr($id); ?>">
                                            <button class="accordion-button <?php echo esc_attr($collapsed_tab); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne_<?php echo esc_attr($id); ?>" aria-expanded="<?php echo esc_attr($area_expanded); ?>" aria-controls="collapseOne_<?php echo esc_attr($id); ?>">
                                                <?php echo wp_kses_post($slide['tab_title']); ?>
                                            </button>
                                        </h2>
                                        <div id="collapseOne_<?php echo esc_attr($id); ?>" class="accordion-collapse collapse  <?php echo esc_attr($active_show_tab); ?>" aria-labelledby="headingOne_<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p><?php echo wp_kses_post($slide['tab_content_info']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
    <?php

    }
}
