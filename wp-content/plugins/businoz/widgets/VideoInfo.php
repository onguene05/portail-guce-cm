<?php
namespace Bdevs\Elementor;

defined( 'ABSPATH' ) || die();

class VideoInfo extends \Generic\Elements\GenericWidget {

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
        return 'video-info';
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
        return __( 'Video Info', 'bdevs-elementor' );
    }
    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/video-info/';
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
        return 'eicon-video-camera';
    }

    public function get_keywords() {
        return [ 'info', 'video', 'box', 'text', 'content' ];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    /**
     * Register content related controls
     */
    protected function register_content_controls() {

        $this->design_style();
        $this->title_and_desc();
        $this->video_image();
        $this->shape_text();
        $this->button();
        $this->video_info();
        $this->video_button_gradient();
        $this->envalope_gradient();
        $this->checklist_gradient();
        
    }    


    public function design_style() { 
        $this->start_controls_section(
            '_section_design_title',
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
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    public function video_image() {
        // img
        $this->start_controls_section(
            '_section_bg_image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Image', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


          $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

    }

    public function video_info() {

    $this->start_controls_section(
            '_section_features_list',
            [
                'label' => __('Video Info List', 'bdevs-element'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();


        $repeater->add_control(
            'video_info_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'bdevs-element'),
                'default' => __('Title', 'bdevs-element'),
                'placeholder' => __('Type title here', 'bdevs-element'),
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
                'title_field' => '<# print(video_info_title || "Carousel Item"); #>',
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

 // Video Button color

    public function video_button_gradient(){

        // Phone Number Gradient
        $this->start_controls_section(
            '_section_button_overlay1',
            [
                'label' => __( 'Video Button Gradient Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1','design_3'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay' );

         $this->start_controls_tab(
            'tab_button_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_1','design_3'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background1',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-video__play__button a, .bd-about__play',
            ]
        );


        $this->end_controls_tab();


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }

       // envalope color

    public function envalope_gradient(){

        // Phone Number Gradient
        $this->start_controls_section(
            '_section_envalope_overlay',
            [
                'label' => __( 'Envalope Gradient Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay2' );

         $this->start_controls_tab(
            'tab_envalope_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-video__contact .icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }
     
public function checklist_gradient(){

        // Checklist Gradient
        $this->start_controls_section(
            '_section_checklist_overlay',
            [
                'label' => __( 'Checklist Color', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
                 
            ]
        );
        
        $this->start_controls_tabs( 'tabs_background_overlay3' );

         $this->start_controls_tab(
            'tab_checklist_overlay_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background3',
                'label' => esc_html__( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .bd-video__list ul li i',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

      }

    public function title_and_desc() {

        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => __('Back Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Back', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Back Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('bdevs Info Box Sub Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Sub Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('bdevs Info Box Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Title', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'bdevs info box description goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Type info box description', 'bdevs-elementor' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'email_title',
            [
                'label' => __('Email Title', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Email Title', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Email', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => __('Adress Email', 'bdevs-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('info@webmail.com', 'bdevs-elementor'),
                'placeholder' => __('Type Info Box Email', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'designs' => ['design_1', 'design_2'],
                ],
            ]
        ); 

        $this->add_control(
            'video_url',
            [
                'label' => __( 'Video URL', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'bdevs video url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Video URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
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
                'default' => 'h2',
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

    public function shape_text() {
        $this->start_controls_section(
            '_section_shape',
            [
                'label' => __( 'Shape', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape SWITCHER', 'bdevselement'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

    }
    public function button(){
        // Button 01
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

    /**
     * Register styles related controls
     */
    protected function register_style_controls() {
        $this->title_style_controls();
        $this->description_style_controls();
    }

       protected function title_style_controls() {

        $this->start_controls_section(
            '_section_title_style',
            [
                'label' => __( 'Title & Description', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Box Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'bdevs-elementor' ),
                'selector' => '{{WRAPPER}} .bdevs-el-title',
            ]
        );

    }

    protected function description_style_controls() {

        $this->add_control(
            'subtitle_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __( 'Sub title', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => __( 'Typography', 'bdevs-elementor' ),
                'selector' => '{{WRAPPER}} .bdevs-el-content',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

    ?>


    <?php if ($settings['designs'] === 'design_2'): 
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bdevs-el-title' );


        if ( !empty($settings['button_link']) ) {
            $this->add_render_attribute( 'button', 'class', 'bd-theme__btn-5 bdevs-el-btn' );
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

    ?>  

    <!-- video-area-start -->
    <section class="bd-video__area p-relative pt-155 pb-80  wow fadeInUp" data-wow-duration="1.5s"
         data-wow-delay=".3s">
            <div class="bd-video__btn">
                <a class="bd-video__play popup-video" href="<?php echo esc_url($settings['video_url']); ?>">
                    <i class="fas fa-play"></i></a>
            </div>
            <div class="container">
                <?php if (!empty($settings['shape_switch'])): ?>
                <div class="bd-thumb__wrapper d-none d-md-block p-relative">
                   <img class="bd-video__thumb-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/video/video-1.png" alt="video-1">
                   <img class="bd-video__thumb-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/video/video-2.png" alt="video-2">
                   <img class="bd-video__thumb-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/video/video-3.png" alt="video-3">
                   <div class="bd-shape__dot"></div>
                </div>
                <?php endif; ?>
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10">
                    <div class="bd-video__main__wrapper text-center mb-95">
                        <div class="bd-section__title p-relative z-index-11  mb-20">
                            <?php if ($settings['back_title']) : ?>
                            <span class="bd-stroke__title s-5"><?php echo wp_kses_post($settings['back_title']); ?></span>
                            <?php endif; ?>

                            <?php if ($settings['sub_title']) : ?>
                            <strong class="bd-small__title common"><?php echo wp_kses_post($settings['sub_title']); ?></strong>
                            <?php endif; ?>
                            
                            <?php if ($settings['title']) : ?>
                            <h2 class="bd-big__title bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                            <?php endif; ?>
                        </div>

                        <?php if ($settings['description']) : ?>
                        <p><?php echo wp_kses_post($settings['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="bd-video__quote">
                        <div class="quote__btn">
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

                        <?php if ($settings['email']) : ?>
                        <div class="bd-video__quote__text">
                            <div class="bd-email icon">
                               <i class="fal fa-envelope"></i>
                            </div>

                            <div class="bd-email__text">
                               <span><?php print esc_html__( 'Email address', 'businoz' );?></span>
                               <h4><a href="mailto:<?php echo esc_url($settings['email']); ?>"><?php echo wp_kses_post($settings['email']); ?></a></h4>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video-area-end -->


    <?php elseif ($settings['designs'] === 'design_3'): 

        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        ?>

        <!-- video-area-start -->
        <div class="bd-about__video__area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bd-about__wrap p-relative mb-30 m-top">
                            <?php if (!empty($image)): ?>
                            <div class="bd-about__thumb w-img">
                               <img src="<?php echo esc_url($image); ?>" alt="about-thumb">
                            </div>
                            <?php endif; ?>

                            <a class="bd-about__play popup-video" href="<?php echo esc_url($settings['video_url']); ?>"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- video-area-end -->


    <?php else:
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'bd-video-title bdevs-el-title' );


        if (!empty($settings['image']['id'])) {
            $image = wp_get_attachment_image_url($settings['image']['id'], $settings['thumbnail_size']);
        }

        $this->add_render_attribute('button', 'class', 'bd-theme__btn-5 bdevs-el-btn');

        if ( !empty( $settings['button_link'] ) ) {
            $this->add_link_attributes( 'button', $settings['button_link'] );
        }

        ?>


        <!-- Video-area-start -->
        <div class="bd-video__area video__height wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".3s">
             <div class="container">
                <div class="row align-items-center">
                   <div class="col-xl-5 col-lg-7 col-md-10">
                      <div class="bd-video__features-wrapper p-relative">
                         <div class="bd-video__festures-title">
                             <?php if ($settings['sub_title']) : ?>
                            <span class="bdevs-el-content"><?php echo wp_kses_post($settings['sub_title']); ?></span>
                             <?php endif; ?>
                             <?php if ($settings['title']) : ?>
                            <h2 class="bdevs-el-title"><?php echo wp_kses_post($settings['title']); ?></h2>
                            <?php endif; ?>
                         </div>



                         <div class="bd-video__list">
                            <ul>
                            <?php 
                                foreach ( $settings['slides'] as $key => $slide ):
                            ?>
                            <?php if (!empty($slide['video_info_title'])) : ?>
                               <li><?php echo wp_kses_post($slide['video_info_title']); ?><i class="far fa-check"></i></li>
                           <?php endif; ?>
                               <?php endforeach; ?>
                            </ul>
                         </div>

                      </div>
                      <div class="bd-video__contact mb-60">
                         <div class="title">
                            <?php if ($settings['email']) : ?>
                            <h3><?php echo wp_kses_post($settings['email']); ?></h3>
                            <?php endif; ?>
                            <?php if ($settings['email_title']) : ?>
                            <span><?php echo wp_kses_post($settings['email_title']); ?></span>
                            <?php endif; ?>
                         </div>
                         <div class="icon">
                            <i class="fas fa-envelope-open"></i>
                         </div>
                      </div>
                   </div>
                   <div class="col-xl-7 col-lg-5">
                      <div class="bd-video__play__button mb-60">
                         <a class="popup-video" href="<?php echo esc_url($settings['video_url']); ?>"><i class="fas fa-play"></i></a>
                      </div>
                   </div>
                </div>
             </div>
        </div>
        <!-- Video-area-end -->


    <?php endif; ?>
        <?php
    }
}