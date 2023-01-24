<?php
namespace MasterImageHoverEffects\Addon;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\REPEATER;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;

/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 6/28/2020
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Master_Image_Hover_Effects_Addon extends Widget_Base {

    public static $ma_el_image_hover_effects;


    public function get_name() {
        return 'ma-image-hover-effects';
    }

    public function get_title() {
        return esc_html__( 'Image Hover Effects', MAIHEEL_TD );
    }

    public function get_icon() {
        return 'ma-el-icon eicon-image-rollover';
    }

    public function get_categories() {
        return [ 'general', 'master-addons' ];
    }

    public function get_keywords() {
        return [ 'hover', 'image', 'effects', 'image hover', 'banner', 'banner image' ];
    }

    public function get_custom_help_url(){
        return 'https://master-addons.com/demos/image-hover-effects/';
    }

    public function get_style_depends(){
        return [
            'font-awesome-5-all',
            'font-awesome-4-shim',
            'master-image-hover-effects'
        ];
    }

    public function get_script_depends(){
        return [
            'imagesloaded',
            'font-awesome-4-shim'
        ];
    }

    public static function ma_el_image_hover_effects() {

        return self::$ma_el_image_hover_effects =
            [
                'lily'                      => __( 'Lily', MAIHEEL_TD ),
                'sadie'                     => __( 'Sadie', MAIHEEL_TD ),
                'roxy'                      => __( 'Roxy', MAIHEEL_TD ),
                'bubba'                     => __( 'Bubba', MAIHEEL_TD ),
                'romeo'                     => __( 'Romeo', MAIHEEL_TD ),
                'layla'                     => __( 'Layla', MAIHEEL_TD ),
                'honey'                     => __( 'Honey', MAIHEEL_TD ),
                'oscar'                     => __( 'Oscar', MAIHEEL_TD ),

                'ma-el-img-hover1'          => __( 'Marley (Pro)',MAIHEEL_TD ),
                'ma-el-img-hover2'          => __( 'Ruby (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover3'          => __( 'Milo (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover4'          => __( 'Dexter (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover5'          => __( 'Sarah (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover6'          => __( 'Zoe (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover7'          => __( 'Chico (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover8'          => __( 'Julia (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover9'          => __( 'Goliath (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover10'         => __( 'Hera (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover11'         => __( 'Winston (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover12'         => __( 'Selena (Pro)',MAIHEEL_TD ),
                'ma-el-img-hover13'         => __( 'Terry (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover14'         => __( 'Phoebe (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover15'         => __( 'Apollo (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover16'         => __( 'Kira (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover17'         => __( 'Steve (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover18'         => __( 'Moses (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover19'         => __( 'Jazz (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover20'         => __( 'Ming (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover21'         => __( 'Lexi (Pro)', MAIHEEL_TD ),
                'ma-el-img-hover22'         => __( 'Duke (Pro)', MAIHEEL_TD ),
            ];
    }

    protected function _register_controls() {



        /*
        * Master Addons: Effects Controls & Image Hover Effects Section Start
        */

        $this->start_controls_section(
            'ma-image-hover-effect-section',
            [
                'label' => __( 'Effects & Image', MAIHEEL_TD ),
            ]
        );



        $this->add_control(
            'ma_el_main_image_effect',
            [
                'label'       => esc_html__( 'Hover Effect', MAIHEEL_TD ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'sadie',
                'options'     => self::ma_el_image_hover_effects()
            ]
        );



        $this->add_control('ma_el_main_image',
            [
                'label'         => __( 'Upload Image', MAIHEEL_TD ),
                'description'   => __( 'Select an Image', MAIHEEL_TD ),
                'type'          => Controls_Manager::MEDIA,
                'default'       => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_thumbnail_size',
                'default' => 'full',
                'condition' => [
                    'ma_el_main_image[url]!' => '',
                ],
            ]
        );


        $this->add_control('ma_el_image_hover_link_type',
            [
                'label'        => esc_html__( 'Links or Popup?', MAIHEEL_TD ),
                'type'         => Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', MAIHEEL_TD ),
                        'icon' => 'eicon-close-circle',
                    ],
                    'popup' => [
                        'title' => esc_html__( 'Popup', MAIHEEL_TD ),
                        'icon' => 'eicon-search',
                    ],
                    'links' => [
                        'title' => esc_html__( 'External Links', MAIHEEL_TD ),
                        'icon' => 'eicon-editor-external-link',
                    ],
                ],
                'default' => 'none'
            ]
        );


        $this->add_control(
            'ma_el_main_image_more_link_url',
            [
                'label'       => esc_html__( 'Link URL', MAIHEEL_TD ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => '',
                ],
                'condition'     => [
                    'ma_el_image_hover_link_type'    => 'links'
                ],
                'show_external' => true,
            ]
        );



        $this->add_control(
            'ma_el_image_popup_type',
            [
                'label'                 => esc_html__( 'Content Type', MAIHEEL_TD ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'options' => [
                    'image_pro'     => esc_html__( 'Image (Pro)', MAIHEEL_TD ),
                    'content_pro'   => esc_html__( 'Content (Pro)', MAIHEEL_TD ),
                    'section_pro'   => esc_html__( 'Saved Section (Pro)', MAIHEEL_TD ),
                    'widget_pro'    => esc_html__( 'Saved Widget (Pro)', MAIHEEL_TD ),
                    'template_pro'  => esc_html__( 'Saved Page Template (Pro)', MAIHEEL_TD ),
                ],
                'default'               => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this feature.</span>',
                'condition'             => [
                    'ma_el_image_hover_link_type'   => 'popup'
                ]
            ]
        );



        $this->add_control('ma_el_main_image_height',
            [
                'label'         => __( 'Height', MAIHEEL_TD ),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'default'       => __('Default', MAIHEEL_TD),
                    'custom'        => __('Custom', MAIHEEL_TD)
                ],
                'default'       => 'default',
                'description'   => __( 'Choose if you want to set a custom height for the banner or keep it as it is', MAIHEEL_TD )
            ]
        );

        $this->add_responsive_control('ma_el_main_image_custom_height',
            [
                'label'         => __( 'Min Height', MAIHEEL_TD ),
                'type'          => Controls_Manager::NUMBER,
                'description'   => __( 'Set a minimum height value in pixels', MAIHEEL_TD ),
                'condition'     => [
                    'ma_el_main_image_height' => 'custom'
                ],
                'selectors'     => [
                    '{{WRAPPER}} .ma-el-image-hover-effect' => 'height: {{VALUE}}px;'
                ]
            ]
        );

        $this->add_responsive_control('ma_el_main_image_vertical_align',
            [
                'label'         => __( 'Vertical Align', MAIHEEL_TD ),
                'type'          => Controls_Manager::SELECT,
                'condition'     => [
                    'ma_el_main_image_height' => 'custom'
                ],
                'options'       => [
                    'flex-start'    => __('Top', MAIHEEL_TD),
                    'center'        => __('Middle', MAIHEEL_TD),
                    'flex-end'      => __('Bottom', MAIHEEL_TD),
                    'inherit'       => __('Full', MAIHEEL_TD)
                ],
                'default'       => 'flex-start',
                'selectors'     => [
                    '{{WRAPPER}} .ma-el-image-hover-effect figure' => 'align-items: {{VALUE}}; -webkit-align-items: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();




        /*
         *  Master Addons: Style Controls
         */
        $this->start_controls_section(
            'ma_el_main_image_content_heading_section',
            [
                'label' => esc_html__( 'Heading', MAIHEEL_TD )
            ]
        );

        $this->add_control('ma_el_main_image_title',
            [
                'label'         => __( 'Title', MAIHEEL_TD ),
                'placeholder'   => __( 'Title for this Image', MAIHEEL_TD ),
                'type'          => Controls_Manager::TEXT,
                'dynamic'       => [ 'active' => true ],
                'default'       => __( 'Master <span>Addons</span>', MAIHEEL_TD ),
                'label_block'   => false
            ]
        );


        $this->add_control(
            'title_html_tag',
            [
                'label'   => __( 'HTML Tag', MAIHEEL_TD ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => esc_html__( 'H1', MAIHEEL_TD ),
                    'h2'   => esc_html__( 'H2', MAIHEEL_TD ),
                    'h3'   => esc_html__( 'H3', MAIHEEL_TD ),
                    'h4'   => esc_html__( 'H4', MAIHEEL_TD ),
                    'h5'   => esc_html__( 'H5', MAIHEEL_TD ),
                    'h6'   => esc_html__( 'H6', MAIHEEL_TD ),
                    'div'  => esc_html__( 'div', MAIHEEL_TD ),
                    'span' => esc_html__( 'span', MAIHEEL_TD ),
                    'p'    => esc_html__( 'p', MAIHEEL_TD ),                    
                ],
                'default' => 'h2',
            ]
        );

        $this->end_controls_section();



        /*
         *  Master Addons: Sub Heading
         */
        $this->start_controls_section(
            'ma_el_main_image_content_subheading_section',
            [
                'label' => __( 'Sub Heading', MAIHEEL_TD ),
                'condition'     => [
                    "ma_el_main_image_effect"   => [
                        "honey",
                    ]
                ]
            ]
        );

        $this->add_control('ma_el_main_image_sub_title',
            [
                'label'         => __( 'Sub Title', MAIHEEL_TD ),
                'placeholder'   => __( 'Sub Title for this Image', MAIHEEL_TD ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Elementor', MAIHEEL_TD ),
                'label_block'   => false
            ]
        );


        $this->end_controls_section();



        /*
         *  Master Addons: Image Descriptions
         */
        $this->start_controls_section(
            'ma_el_main_image_desc_section',
            [
                'label'         => __( 'Description', MAIHEEL_TD ),
                'type'          => Controls_Manager::HEADING,
                'condition'     => [
                    "ma_el_main_image_effect"   => [
                            "lily",
                            "zoe",
                            "sadie",
                            "layla",
                            "oscar",
                            "marley",
                            "dexter",
                            "sarah",
                            "chico",
                            "kira",
                            "apollo",
                            "steve",
                            "moses",
                            "jazz",
                            "ming",
                            "lexi",
                            "duke",
                            "milo",
                            "bubba",
                            "goliath",
                            "selena",
                            "roxy",
                            "bubba",
                            "romeo",
                            "ruby"
                    ]
                ]
            ]
        );

        $this->add_control('ma_el_main_image_desc',
            [
                'label'         => __( 'Description', MAIHEEL_TD ),
                'description'   => __( 'Give the description to this banner', MAIHEEL_TD ),
                'type'          => Controls_Manager::TEXTAREA,
                'dynamic'       => [ 'active' => true ],
                'default'       => __( 'Master Addons gives your website a vibrant and lively style, you would love.', MAIHEEL_TD ),
                'label_block'   => true,
                'condition'     => [
                    'ma_el_main_image_effect!'   => ['julia']
                ]

            ]
        );


        $this->end_controls_section();


        /*
         *  Master Addons: Set 2 Image Descriptions
         */
        $this->start_controls_section(
            'ma_el_main_image_desc_set2_heading',
            [
                'label'         => __( 'Description', MAIHEEL_TD ),
                'type'          => Controls_Manager::HEADING,
                'description'   => __('Write Description Each line', MAIHEEL_TD),
                'condition'     => [
                    'ma_el_main_image_effect'   => ['julia']
                ]
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control('ma_el_main_image_desc_set2',
            [
                'label'         => __('Read More Text',MAIHEEL_TD),
                'type'          => Controls_Manager::TEXTAREA,
                'dynamic'       => [ 'active' => true ],
                'default'       => 'Julia dances in the deep dark',
            ]
        );


        $this->add_control(
            'ma_el_main_image_desc_set2_tabs',
            [
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [ 'ma_el_main_image_desc_set2' => 'Julia dances in the deep dark' ],
                    [ 'ma_el_main_image_desc_set2' => 'She loves the smell of the ocean' ],
                    [ 'ma_el_main_image_desc_set2' => 'And dives into the morning light' ]
                ],
                'fields'                => array_values( $repeater->get_controls() ),
                'title_field'           => '{{ma_el_main_image_desc_set2}}'
            ]
        );


        $this->end_controls_section();


        /*
         *  Master Addons: Image Hover Social Links
         */
        $this->start_controls_section(
            'ma_el_main_image_social_link_section',
            [
                'label' => esc_html__( 'Social Links', MAIHEEL_TD ),
                'condition'     => [
                    'ma_el_main_image_effect' => ['zoe','hera','winston','terry','phoebe','kira']
                ]
            ]
        );


        /* Icons Dependencies for Styles */

        $this->add_control('ma_el_main_image_icon_heading',
            [
                'label'         => __( 'Social Icons', MAIHEEL_TD ),
                'type'          => Controls_Manager::HEADING,
                'description'   => __('Select Social Icons', MAIHEEL_TD)
            ]
        );
        $repeater = new Repeater();


        $repeater->add_control(
            'ma_el_main_image_icon',
            [
                'label'     => __( 'Icon', MAIHEEL_TD ),
                'type'      => Controls_Manager::ICON,
                'default'   => 'fa fa-wordpress'
            ]
        );

        $repeater->add_control(
            'ma_el_main_image_icon_link',
            [
                'label' => __( 'Icon Link', MAIHEEL_TD ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://master-addons.com', MAIHEEL_TD ),
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                ]
            ]
        );

        $this->add_control(
            'ma_el_main_image_icon_tabs',
            [
                'type'                  => Controls_Manager::REPEATER,
                'default'               => [
                    [ 'ma_el_main_image_icon' => 'fa fa-wordpress' ],
                    [ 'ma_el_main_image_icon' => 'fa fa-facebook' ],
                    [ 'ma_el_main_image_icon' => 'fa fa-twitter' ],
                    [ 'ma_el_main_image_icon' => 'fa fa-instagram' ],
                ],
                'fields'                => array_values( $repeater->get_controls() ),
                'title_field'           => '{{ma_el_main_image_icon}}'
            ]
        );


        $this->end_controls_section();




        /*
         * Image Hover Style Section
         */
        $this->start_controls_section('ma_el_main_image_hover_style_section',
            [
                'label'         => __( 'Image', MAIHEEL_TD ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('ma_el_main_image_bg_color',
            [
                'label'         => __( 'Background Color', MAIHEEL_TD ),
                'type'          => Controls_Manager::COLOR,
                'default'       => '',
                'selectors'     => [
                    '{{WRAPPER}} .ma-el-image-hover-effect figure' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('ma_el_main_image_opacity',
            [
                'label' => __( 'Image Opacity', MAIHEEL_TD ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .8
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect figure img' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control('ma_el_main_image_hover_opacity',
            [
                'label' => __( 'Hover Opacity', MAIHEEL_TD ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect figure:hover img' => 'opacity: {{SIZE}};'
                ]
            ]
        );


        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_filters',
                'label'     => __('Image Filter', MAIHEEL_TD),
                'selector' => '{{WRAPPER}} .ma-el-image-hover-effect figure img',
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'      => 'hover_image_filters',
                'label'     => __('Hover Image Filter', MAIHEEL_TD),
                'selector'  => '{{WRAPPER}} .ma-el-image-hover-effect figure:hover img'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'          => 'ma_el_main_image_border',
                'selector'      => '{{WRAPPER}} .ma-el-image-hover-effect figure'
            ]
        );


        $this->add_responsive_control(
            'ma_el_main_image_border_radius',
            [
                'label' => __( 'Border Radius', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );


        $this->add_responsive_control(
            'ma_el_main_image_pading',
            [
                'label'         => __( 'Padding', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );



        $this->add_responsive_control(
            'ma_el_main_image_margin',
            [
                'label'         => __( 'Margin', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'label'             => __('Box Shadow',MAIHEEL_TD),
                'name'              => 'ma_el_main_image_shadow',
                'selector'          => '{{WRAPPER}} .ma-el-image-hover-effect figure'
            ]
        );
        $this->end_controls_section();





        /*
         * Title Color
         */
        $this->start_controls_section('ma_el_main_image_title_style',
            [
                'label'         => __( 'Title', MAIHEEL_TD ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('ma_el_main_image_title_color',
            [
                'label' => __( 'Color', MAIHEEL_TD ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1
                ],
                'default' => "#fff",
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect .ma-el-image-hover-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control('jltma_main_image_border_color',
            [
                'label'         => __( 'Border Color', MAIHEEL_TD ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .ma-el-image-hover-effect figcaption::before'    => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .ma-el-image-hover-effect figcaption::after'    => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ma_el_main_image_title_typography',
                'selector' => '{{WRAPPER}} .ma-el-image-hover-effect .ma-el-image-hover-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'             => __('Box Shadow',MAIHEEL_TD),
                'name'              => 'ma_el_main_image_title_shadow',
                'selector'          => '{{WRAPPER}} .ma-el-image-hover-title'
            ]
        );



        $this->add_responsive_control(
            'ma_el_main_image_title_pading',
            [
                'label'         => __( 'Padding', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );



        $this->add_responsive_control(
            'ma_el_main_image_title_margin',
            [
                'label'         => __( 'Margin', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );


        $this->end_controls_section();




        /*
         * Description Style
         */


        $this->start_controls_section('ma_el_main_image_desc_style_section',
            [
                'label'         => __( 'Description', MAIHEEL_TD ),
                'tab'           => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('ma_el_main_image_desc_color',
            [
                'label' => __( 'Color', MAIHEEL_TD ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3
                ],
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect p' => 'color: {{VALUE}};'
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'ma_el_main_image_desc_typography',
                'selector'      => '{{WRAPPER}} .ma-el-image-hover-effect p',
                'scheme'        => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'             => __('Text Shadow',MAIHEEL_TD),
                'name'              => 'ma_el_main_image_desc_text_shadow',
                'selector'          => '{{WRAPPER}} .ma-el-image-hover-effect p',
            ]
        );


        $this->add_responsive_control(
            'ma_el_main_image_desc_pading',
            [
                'label'         => __( 'Padding', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );



        $this->add_responsive_control(
            'ma_el_main_image_desc_margin',
            [
                'label'         => __( 'Margin', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> unlock this Option.</span>'
            ]
        );


        $this->end_controls_section();





        /*
         * Social Icons Style
         */

        $this->start_controls_section('ma_el_main_image_icon_hover_style_section',
            [
                'label'         => __( 'Social Icons', MAIHEEL_TD ),
                'tab'           => Controls_Manager::TAB_STYLE,
                'condition'     => [
                    'ma_el_main_image_effect' => ['zoe','hera']
                ]
            ]
        );

        $this->start_controls_tabs( 'ma_el_main_image_icon_style_tabs' );

        $this->start_controls_tab( 'ma_el_main_image_icon_style_tab_normal',
            [ 'label' => esc_html__( 'Normal', MAIHEEL_TD )
            ] );

        $this->add_control('ma_el_main_image_icon_color',
            [
                'label' => __( 'Color', MAIHEEL_TD ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2
                ],
//                  'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect .icon-links a' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'ma_el_main_image_icon_style_tab_hover',
            [ 'label' => esc_html__( 'Hover', MAIHEEL_TD )
        ] );

        $this->add_control('ma_el_main_image_icon_hover_color',
            [
                'label' => __( 'Color', MAIHEEL_TD ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3
                ],
//                  'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ma-el-image-hover-effect .icon-links a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'ma_el_section_pro_style_section',
            [
                'label' => esc_html__( 'Upgrade to Pro', MAIHEEL_TD ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ma_el_control_get_pro_style_tab',
            [
                'label' => esc_html__( 'Unlock more possibilities', MAIHEEL_TD ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => esc_html__( '', MAIHEEL_TD ),
                        'icon' => 'fa fa-unlock-alt',
                    ],
                ],
                'default' => '1',
                'description' => '<span class="pro-feature"> Upgrade to  <a href="' . esc_url('https://master-addons.com/pricing') . '" target="_blank">Pro Version</a> for more Elements with Customization Options.</span>'
            ]
        );

        $this->end_controls_section();



    }


    private function render_image( $image_id, $settings ) {
        $image_thumbnail_size = $settings['image_thumbnail_size_size'];
        if ( 'custom_size' === $image_thumbnail_size ) {
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, $image_thumbnail_size, $settings );
        } else {
            $image_src = wp_get_attachment_image_src( $image_id, $image_thumbnail_size );
            $image_src = $image_src[0];
        }

        return sprintf( '<img src="%s"  class="circled" alt="%s" />', esc_url($image_src), esc_html( get_post_meta( $image_id, '_wp_attachment_image_alt', true) ) );
    }



    protected function render() {

        $settings = $this->get_settings_for_display();

        // First 15 Effects
        foreach( array_slice(self::ma_el_image_hover_effects(), 0, 15) as $key=>$ma_el_image_hover_value ){
            $ma_el_image_hover_sets = "one";
        }

        // Last 15 Effects
        foreach( array_slice(self::ma_el_image_hover_effects(), 15, 30) as $key=>$ma_el_image_hover_value ){
            $ma_el_image_hover_sets = "two";
        }


        $this->add_render_attribute( 'ma_el_image_hover_effect_wrapper', [
            'class' => [
                'ma-el-image-hover-effect',
                'ma-el-image-hover-effect-' . $ma_el_image_hover_sets,
                'ma-el-image-hover-effect-' . esc_attr($settings['ma_el_main_image_effect'] )
            ],
            'id' => 'ma-el-image-hover-effect-' . $this->get_id()
        ]);


        $this->add_render_attribute( 'ma_el_image_hover_effect_heading', ['class'   => 'ma-el-image-hover-title']);


        $ma_el_main_image = $this->get_settings_for_display( 'ma_el_main_image' );

        $ma_el_main_image_effect = $settings['ma_el_main_image_effect'];
        $ma_el_main_image_alt = Control_Media::get_image_alt( $settings['ma_el_main_image'] );


        // Image Link
        if( $settings['ma_el_image_hover_link_type'] =="links"){
            $this->add_render_attribute( 'ma_el_image_hover_link', [
                'class' => [ 'ma-image-hover-read-more' ],
                'href'  => esc_url($settings['ma_el_main_image_more_link_url']['url'] ),
            ]);

            if( $settings['ma_el_main_image_more_link_url']['is_external'] ) {
                $this->add_render_attribute( 'ma_el_image_hover_link', 'target', '_blank' );
            }

            if( $settings['ma_el_main_image_more_link_url']['nofollow'] ) {
                $this->add_render_attribute( 'ma_el_image_hover_link', 'rel', 'nofollow' );
            }
        } ?>

            <div <?php echo $this->get_render_attribute_string( 'ma_el_image_hover_effect_wrapper' ); ?>>


                <figure class="effect-<?php echo esc_attr( $settings['ma_el_main_image_effect'] );?>">

                    <?php echo $this->render_image( $settings['ma_el_main_image']['id'], $settings );?>

                    <figcaption>
                        <div class="ma-image-hover-content">
                            <<?php echo $settings['title_html_tag'];?> <?php echo $this->get_render_attribute_string( 'ma_el_image_hover_effect_heading' ); ?>>

                                <?php echo $this->parse_text_editor($settings['ma_el_main_image_title']); ?>

                                <?php $ma_el_main_image_sub_title = array( "honey");
                                    if (in_array($ma_el_main_image_effect, $ma_el_main_image_sub_title)) { ?>
                                     <i><?php echo $settings['ma_el_main_image_sub_title']; ?></i>
                                <?php } ?>

                            </<?php echo $settings['title_html_tag'];?>>


                            <?php
                                // Social Icons Sets
                                $ma_el_main_image_socials_array = array( "hera","zoe","winston","terry","phoebe","kira");
                                if (in_array($ma_el_main_image_effect, $ma_el_main_image_socials_array)) { ?>
                                <p class="icon-links">
                                    <?php foreach( $settings['ma_el_main_image_icon_tabs'] as $index => $tab ) { ?>
                                        <a href="<?php echo esc_url_raw( $tab['ma_el_main_image_icon_link']['url'] );?>">
                                            <span class="<?php echo $tab['ma_el_main_image_icon']; ?>"></span>
                                        </a>
                                    <?php } ?>
                                </p>
                            <?php } ?>

                            <?php if(isset($settings['ma_el_main_image_desc_set2_tabs'])){
                                foreach( $settings['ma_el_main_image_desc_set2_tabs'] as $index => $tab ) {
                                $ma_el_main_image_effect_one_array=array( "julia" );
                                if (in_array($ma_el_main_image_effect,$ma_el_main_image_effect_one_array)) {
                            ?>
                                <p class="ma-el-image-hover-desc"><?php echo $tab['ma_el_main_image_desc_set2'];?></p>
                            <?php } } }


                            // Design Specific Descriptions for Set 1
                            $ma_el_main_image_effect_array=array( "zoe","goliath","selena","apollo","steve","moses","jazz","ming","lexi","duke",
                                "lily","sadie","oscar","layla","marley","dexter","sarah","chico","hera","kira","milo","roxy","bubba","romeo","ruby");
                            if (in_array($ma_el_main_image_effect,$ma_el_main_image_effect_array)) { ?>
                                <p class="ma-el-image-hover-desc">
                                    <?php echo htmlspecialchars_decode( $settings['ma_el_main_image_desc'] ); ?>
                                </p>
                            <?php } ?>

                        </div>

                        <?php if( $settings['ma_el_image_hover_link_type'] =="links" && $settings['ma_el_main_image_more_link_url']['url'] !=""){ ?>

                            <a <?php echo $this->get_render_attribute_string( 'ma_el_image_hover_link' ); ?>></a>

                        <?php } ?>


                    </figcaption>

                </figure>



            </div>
    <?php
    }

    protected function _content_template() {}

}

