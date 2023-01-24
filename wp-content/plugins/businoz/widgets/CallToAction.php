<?php
namespace Bdevs\Elementor;

defined( 'ABSPATH' ) || die();

class CallToAction extends \Generic\Elements\GenericWidget 
{

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
        return 'cust-cta';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'CallToAction', 'bdevs-elementor' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/widgets/gradient-heading/';
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
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_keywords() {
        return [ 'gradient', 'advanced', 'heading', 'title', 'colorful' ];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    protected function register_content_controls()
    {
        $this->design_style();
        $this->title_and_desc();
        $this->cta_images();
        $this->section_slide();
        $this->button();
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
                    // 'design_2' => __('Design 2', 'bdevs-elementor'),
                    // 'design_3' => __('Design 3', 'bdevs-elementor'),
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
        //desc
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Desccription', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Sub Title', 'bdevs-elementor' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __( 'Heading Sub Text', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ], 
            ]
        );  

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-elementor' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );     

        $this->add_control(
            'number',
            [
                'label' => __( 'Number', 'bdevs-elementor' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '$5',
                'placeholder' => __( 'Number Here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ], 
            ]
        ); 

        $this->add_control(
            'description',
            [
                'label'       => __('Description', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
                'default'     => __('Hero description goes here', 'bdevs-elementor'),
                'placeholder' => __('Enter Hero description', 'bdevs-elementor'),
                'rows'        => 5,
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_20'],
                ], 
            ]
        );

        $this->add_control(
            'placehorder',
            [
                'label'       => __('Placeholder', 'bdevs-elementor'),
                'label_block' => true,
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Search courses....', 'bdevs-elementor'),
                'placeholder' => __('Enter Placeholder', 'bdevs-elementor'),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __( 'Email', 'bdevs-elementor' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'info@webmail.com',
                'placeholder' => __( 'Email Here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_20'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
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

    public function cta_images(){
        // image
        $this->start_controls_section(
            '_section_image',
            [
                'label' => __( 'Image', 'bdevselementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'cta_bg',
            [
                'label' => __( 'BG Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevselementor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_10', 'design_3'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'bg_thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();
    }

    public function section_slide()
    {
        //listview with icon
        $this->start_controls_section(
            '_section_list',
            [
                'label' => __( 'Items List', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_20']
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'items_list',
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

    public function button()
    {
        // Button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}}' => 'display: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => __('Text', 'bdevs-elementor'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Button Text',
                'placeholder' => __('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls(){
       
        $this->title_style_controls();
        $this->button_style_controls();

    }



    protected function title_style_controls() {

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
                'separator' => 'before'
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
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .bdevs-el-subtitle',
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


        // Icons Text
        $this->add_control(
            '_heading_iconstext',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Icons Text', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'icontext_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-icontext' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icontext_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-icontext' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icontext',
                'selector' => '{{WRAPPER}} .bdevs-el-icontext',
            ]
        );


        // Image Text
        $this->add_control(
            '_heading_imgtext',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('Icons Text', 'bdevs-elementor'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'imgtext_spacing',
            [
                'label' => __('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-imgtext' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'imgtext_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-imgtext' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'imgtext',
                'selector' => '{{WRAPPER}} .bdevs-el-imgtext',
            ]
        );

        $this->end_controls_section(); 
    }


    protected function button_style_controls() {
        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __('Button', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
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
                'label' => __('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
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

        $this->start_controls_tabs('_tabs_button');

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
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
                'label' => __('Background Color', 'bdevs-elementor'),
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
                'label' => __('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_before_bg_color',
            [
                'label' => __('Hover Before BG Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn.s-btn.bdevs-el-btn:hover:before, {{WRAPPER}} .btn.s-btn.bdevs-el-btn:focus:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'bdevs-elementor'),
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
    }


    protected function render() {

        $settings = $this->get_settings_for_display();

                     
        ?>


        <?php if ( $settings['designs'] === 'design_4' ):

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'z-title  big_title mb-0 text-white' );

        $this->add_render_attribute( 'button', 'class', 'custom_btn bg_default_yellow wow fadeInUp22' );
        $this->add_render_attribute( 'button', 'data-wow-delay', '.3s' );
        if (!empty($settings['button_link'])) {
            $this->add_link_attributes( 'button', $settings['button_link'] );
        } 

        if ( !empty($image) ) {
            $image = $settings['image']['url'];
        }

        ?>

        <!-- skill-area-start -->
        <div class="skill-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="skill-background-img skill-wrapper" data-background="<?php echo get_template_directory_uri(); ?>/assets/img/bg/skill.jpg">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="skill-content">
                                        <span>Keep Your Skills</span>
                                        <h3>Transform Your life <br>
                                            Through Exclusive Education</h3>
                                        <a class="edu-four-btn" href="https://bdevs.net/wp/eduman/course/">Browse all courses</a>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12">
                                    <div class="skill-thumb position-relative">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bg/skill-laptop.png" alt="image not found">
                                        <div class="course-price-start">
                                            Only <span class="course-price">$5</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- skill-area-end -->


        <?php elseif ($settings['designs'] === 'design_3'):

        $this->add_inline_editing_attributes( 'title', 'basic' );

        if ( !empty($settings['image']['id']) ) {
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['bg_thumbnail_size'] );
        }
        
        ?>

        <!-- baner-area-start -->
        <div class="banner-area faq position-relative">
            <?php if ( !empty($image) ) : ?>
            <div class="banner-img">
                <img src="<?php print esc_url($image); ?>" alt="image not found">
            </div>
            <?php endif; ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="banner-tiitle-wrapper text-center">
                            <div class="banner-tittle">
                                <?php if ($settings['title']) : ?>
                                <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                                <?php endif; ?>
                            </div>
                            <div class="banner-search-box">
                                <form action="<?php print esc_url(home_url('/')); ?>">
                                   <div class="slider-faq-search">
                                      <input type="text" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php echo wp_kses_post($settings['placehorder']); ?>">
                                      <button type="submit"><i class="fal fa-search"></i></button>
                                   </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner-arera-end -->


        <?php elseif ($settings['designs'] === 'design_2'):

            $this->add_inline_editing_attributes( 'title', 'basic' );

            if (!empty($settings['button_link'])) {
                $this->add_render_attribute('button', 'class', 'edu-btn bdevs-el-btn');
                $this->add_link_attributes('button', $settings['button_link']);
            }

        ?>

        <div class="become-intructor-areaa">
            <div class="container">
                <div class="row justify-content-center text-center">
                   <div class="col-xl-6 col-md-8">
                      <div class="become-intructor-text">
                        <?php if ($settings['title']) : ?>
                        <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                        <?php endif; ?>

                        <?php if ($settings['description']) : ?>
                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                        <?php endif; ?>

                        <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>>
                                        <span><?php echo esc_html($settings['button_text']); ?></span>
                                        <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    </a>
                                <?php
                                endif;
                        endif; ?>
                      </div>
                   </div>
                </div>
            </div>
        </div>
      
        <?php else: 

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'lv-section-title text-white mb-45 bdevs-el-title' );

            $this->add_render_attribute('button', 'class', 'lv-transparent-btn bdevs-el-btn');

            if ( !empty( $settings['button_link'] ) ) {
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }
        ?>

        <div class="cta-area bg-default pt-110 pb-120 lv-bg-opacity lv-opacity-5">
            <div class="container">
               <div class="lv-section-title-wrap text-center">
                    <?php
                    if ($settings['title']) :
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['title_tag']),
                            $this->get_render_attribute_string('title'),
                            wp_kses_post($settings['title'])
                        );
                    endif;
                    ?>

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
                                <span class="lv-theme-horizontal-line"></span>
                                <span class="lv-theme-vertical-line"></span>
                                <span><?php echo esc_html($settings['button_text']); ?></span></span></a>
                        <?php
                        else: ?>
                            <a <?php $this->print_render_attribute_string('button'); ?>>
                                <span class="lv-theme-horizontal-line"></span>
                                <span class="lv-theme-vertical-line"></span>
                                <span><?php echo esc_html($settings['button_text']); ?></span>

                                <?php bdevs_elementor_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                            </a>
                        <?php
                        endif;
                    endif; ?>
                </div>
            </div>
        </div>

            <?php endif; ?>
        <?php
    }
}
