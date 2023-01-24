<?php
namespace Bdevs\Elementor;


defined( 'ABSPATH' ) || die();

class Slider extends \Generic\Elements\GenericWidget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.1
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'cust-slider';
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
        return __( 'Slider', 'bdevs-elementor' );
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net/bdevselementor/slider/';
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
    public function get_icon()
    {
        return 'eicon-header gen-icon';
    }

    public function get_keywords() {
        return [ 'slider', 'image', 'gallery', 'carousel' ];
    }

    public function get_categories()
    {
        return ['bdevs-elementor'];
    }


    protected function register_content_controls()
    {

        $this->design_style();
        $this->background_overlay();
        $this->slides();
        $this->features();
        $this->settings();
    }

    public function design_style(){
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

                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    public function background_overlay(){

        // Background Overlay
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => __( 'Background Overlay', 'elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2'],
                ], 
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'bdevs-elementor' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .single-slider::before,{{WRAPPER}} .slider__content-2::before',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => __( 'Opacity', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .single-slider::before,{{WRAPPER}} .slider__content-2::before' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function slides(){
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Slides', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-elementor' ),
                    'style_2' => __( 'Style 2', 'bdevs-elementor' ),

                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'bdevs-elementor' ),
                'condition' => [
                    'field_condition' => ['style_5'],
            ],
            ],
            
        );

        $repeater->add_control(
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

        $repeater->add_control(
            'image',
            [
                'type' => \Elementor\Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-elementor' ),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );     

        $repeater->add_control(
            'sub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Sub Title', 'bdevs-elementor' ),
                'default' => __( 'Subtitle', 'bdevs-elementor' ),
                'placeholder' => __( 'Type subtitle here', 'bdevs-elementor' ),
                'condition' => [
                    'field_condition' => ['style_5'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'sub_title2',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Sub Title 02', 'bdevs-elementor' ),
                'default' => __( 'Subtitle', 'bdevs-elementor' ),
                'placeholder' => __( 'Type subtitle here', 'bdevs-elementor' ),
                'condition' => [
                    'field_condition' => ['style_5'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Title', 'bdevs-elementor' ),
                'default' => __( 'Title Here', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title2',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title 02', 'bdevs-elementor' ),
                'default' => __( 'Web Developer', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_5'],
                ], 
            ]
        );       

        $repeater->add_control(
            'desc',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Description', 'bdevs-elementor' ),
                'default' => __( 'Hero Description', 'bdevs-elementor' ),
                'placeholder' => __( 'Type Hero Description Here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_4', 'style_5'],
                ], 
            ]
        );

        $repeater->add_control(
            'shape_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'shape Title', 'bdevs-elementor' ),
                'default' => __( 'shape Title', 'bdevs-elementor' ),
                'placeholder' => __( 'Type shape title here', 'bdevs-elementor' ),
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        //button one
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5', 'style_6'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'condition' => [
                    'field_condition' => ['style_1', 'style_2', 'style_3', 'style_4', 'style_5', 'style_6'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_icon',
            [
                'label' => __( 'Icon', 'bdevs-elementor' ),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-angle-right',
            ]
        );

        $repeater->add_control(
            'button_selected_icon',
            [
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'button_icon',
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'button_icon_position',
            [
                'label' => __( 'Icon Position', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevs-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevs-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn--icon-before .bdevs-el-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-el-btn--icon-after .bdevs-el-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

         $repeater->add_control(
            'button_text2',
            [
                'label' => __( 'Text Two', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link2',
            [
                'label' => __( 'Link', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'counter_title_one',
            [
                'label' => __( 'Counter Title 01', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Counter Title 01', 'bdevs-elementor' ),
                'default' => __( 'Title Here', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'counter_number_one',
            [
                'label' => __( 'Counter Number 01', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '20',
                'placeholder' => __( 'Counter Number Here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'counter_sign_one',
            [
                'label' => __( 'Counter Sign 01', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'K',
                'placeholder' => __( 'Counter Sign Here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

         $repeater->add_control(
            'counter_title_two',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Counter Title 02', 'bdevs-elementor' ),
                'default' => __( 'Title Here', 'bdevs-elementor' ),
                'placeholder' => __( 'Type title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'counter_number_two',
            [
                'label' => __( 'Counter Number 02', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '20',
                'placeholder' => __( 'Counter Number Here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'counter_sign_two',
            [
                'label' => __( 'Counter Sign 02', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'K',
                'placeholder' => __( 'Counter Sign Here', 'bdevs-elementor' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => __( 'Video URL', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'bdevs video url goes here', 'bdevs-elementor' ),
                'placeholder' => __( 'Set Video URL', 'bdevs-elementor' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'field_condition' => ['style_5', 'style_6'],
                ], 
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bdevs-elementor' ),
                'condition' => [
                    'field_condition' => ['style_5'],
                ], 
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-elementor' ),
                'label_off' => __( 'No', 'bdevs-elementor' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'social_title',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Social Title', 'bdevs-elementor' ),
                'default' => __( 'Follow', 'bdevs-elementor' ),
                'placeholder' => __( 'Type Social title here', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your profile link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your email link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your phone link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your facebook link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your twitter link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your instagram link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'bdevs-elementor' ),
                'default' => __( '#', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your youtube link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your flickr link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your hehance link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'bdevs-elementor' ),
                'placeholder' => __( 'Add your github link', 'bdevs-elementor' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

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
                    [
                        'image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();
    }

    public function features(){
        $this->start_controls_section(
            '_section_features_list',
            [
                'label' => __('Features List', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2', 'style_6'],
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'number',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Number', 'bdevs-elementor'),
                'placeholder' => __('Type Number here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'number_sign',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Number Sign', 'bdevs-elementor'),
                'placeholder' => __('Type Sign here', 'bdevs-elementor'),
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
                'label' => __('Title', 'bdevs-elementor'),
                'placeholder' => __('Type title here', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'slides2',
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

    public function settings(){
        // Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

       $this->add_control(
            'ts_slider_autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'bdevs-elementor' ),
                'label_off' => esc_html__( 'No', 'bdevs-elementor' ),
                'return_value' => 'yes',
                'default' => 'no'
            ]
        );

        $this->add_control(
            'ts_slider_speed',
            [
               'label' => esc_html__( 'Slider Speed', 'bdevs-elementor' ),
               'type' => \Elementor\Controls_Manager::NUMBER,
               'placeholder' => esc_html__( 'Enter Slider Speed', 'bdevs-elementor' ),
               'default' => '5000',
               // 'default' => 5000,
               'condition' => ["ts_slider_autoplay" => ['yes']],
            ]
          );

        $this->add_control(
        'ts_slider_nav_show',
            [
            'label' => esc_html__( 'Nav show', 'bdevs-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'bdevs-elementor' ),
            'label_off' => esc_html__( 'No', 'bdevs-elementor' ),
            'return_value' => 'yes',
            'default' => 'yes'
            ]
        );
        $this->add_control(
         'ts_slider_dot_nav_show',
             [
             'label' => esc_html__( 'Dot nav', 'bdevs-elementor' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'bdevs-elementor' ),
             'label_off' => esc_html__( 'No', 'bdevs-elementor' ),
             'return_value' => 'yes',
             'default' => 'yes'
             ]
         );

        $this->end_controls_section();
    }


    protected function register_style_controls(){
       
        $this->title_style_controls();
        $this->button_style_controls();

    }


    public function title_style_controls(){
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Title / Content', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Subtitle', 'bdevs-elementor' ),
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
                    '{{WRAPPER}} .bdevs-el-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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
                'label' => __( 'Description', 'bdevs-elementor' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-elementor' ),
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
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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

    protected function button_style_controls() {

        // Button 1 style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
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
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
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

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
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
                'label' => __( 'Background Color', 'bdevs-elementor' ),
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
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-elementor' ),
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

        // Navigation - Arrow
        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => __( 'Navigation - Arrow', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __( 'Position', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'bdevs-elementor' ),
                'label_on' => __( 'Custom', 'bdevs-elementor' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label' => __( 'Vertical', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_position_x',
            [
                'label' => __( 'Horizontal', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_arrow' );

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-prev:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_dots',
            [
                'label' => __( 'Navigation - Dots', 'bdevs-elementor' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label' => __( 'Vertical Position', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label' => __( 'Spacing', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label' => __( 'Alignment', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_dots' );
        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __( 'Normal', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'dots_nav_color',
            [
                'label' => __( 'Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_hover',
            [
                'label' => __( 'Hover', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'dots_nav_hover_color',
            [
                'label' => __( 'Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __( 'Active', 'bdevs-elementor' ),
            ]
        );

        $this->add_control(
            'dots_nav_active_color',
            [
                'label' => __( 'Color', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }



    protected function render() {
        $settings = $this->get_settings_for_display();

        // ================
        $show_navigation   =   $settings["ts_slider_nav_show"]=="yes"?true:false;
        $auto_nav_slide    =   $settings['ts_slider_autoplay'];
        $dot_nav_show      =   $settings['ts_slider_dot_nav_show'];
        $ts_slider_speed   =   $settings['ts_slider_speed'] ? $settings['ts_slider_speed'] : '5000';

        $slide_controls    = [
            'show_nav'=>$show_navigation, 
            'dot_nav_show'=>$dot_nav_show, 
            'auto_nav_slide'=>$auto_nav_slide, 
            'ts_slider_speed'=>$ts_slider_speed, 
        ];
   
        $slide_controls = \json_encode($slide_controls); 
        // ================

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'button_no_icon', 'class', 'custom_btn bg_default_orange btn-no-icon wow fadeInUp222' );

        ?>

        <?php if ( $settings['designs'] === 'design_4' ):

        $this->add_render_attribute( 'button', 'class', 'z-btn z-btn-border' );
        
        ?>

        <!-- slider area start here -->
        <section class="bd-slider-area">
            <div class="bd-custom-container">
                <div class="bd-slider-active swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ( $settings['slides'] as $key => $slide ) :
                            $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                            $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn bdevs-el-btn' );
                            $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                        ?>   
                        <div class="bd-single-slider bd-single-slider-overlay bd-slider-height d-flex align-items-center swiper-slide" data-swiper-autoplay="5000">
                            <div class="bd-slide-bg" data-background="<?php print esc_url($image); ?>"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="bd-slider bd-slider-four z-index text-center bdevs-el-content">
                                            <?php if ( !empty($slide['title']) ) : ?>
                                            <h1 class="bd-slider-title bd-slider-title-four mb-35 bdevs-el-title" data-animation="fadeInUp" data-delay=".3s">
                                                <?php echo wp_kses_post( $slide['title'] ); ?>
                                            </h1>
                                            <?php endif; ?>

                                            <?php if ( !empty($slide['desc']) ) : ?>
                                            <p class="mb-40" data-animation="fadeInUp" data-delay=".6s">
                                                <?php echo wp_kses_post( $slide['desc'] ); ?>
                                            </p>
                                            <?php endif; ?>

                                            <div class="bd-slider-btn" data-animation="fadeInUp" data-delay=".9s">
                                               <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                        printf( '<a %1$s>%2$s</a>',
                                                            $this->get_render_attribute_string( 'button_'. $key ),
                                                            esc_html( $slide['button_text'] )
                                                            );
                                                    elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                    <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                        if ( $slide['button_icon_position'] === 'before' ): ?>
                                                            <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                            <?php
                                                        else: ?>
                                                            <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                        <?php
                                                        endif;
                                                endif; ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- slider area end here -->  


         <?php elseif ($settings['designs'] === 'design_5'): ?>

        <!-- slider area start here -->
        <section class="bd-slider-area">
            <div class="bd-slider-actives swiper-container">
                <div class="swiper-wrappers">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn bdevs-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>  
                    <div class="bd-single-slider bd-slider-height d-flex align-items-center">
                        <div class="bd-slide-bg" data-background="<?php print esc_url($image); ?>"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bd-slider-five z-index">
                                        <?php if ( !empty($slide['sub_title']) ) : ?>
                                        <div class="bd-slider-five-hello mb-30 wow fadeInUp" data-wow-delay=".2s">
                                            <span class="bd-slider-five-hello-text"><?php echo wp_kses_post( $slide['sub_title'] ); ?></span>
                                            <span><?php echo wp_kses_post( $slide['sub_title2'] ); ?></span>
                                        </div>
                                        <?php endif; ?>

                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 class="bd-slider-five-title wow fadeInUp bdevs-el-title" data-wow-delay=".4s">
                                            <?php echo wp_kses_post( $slide['title'] ); ?>
                                        </h1>
                                        <?php endif; ?>  
                                        
                                        <?php if ( !empty($slide['title2']) ) : ?>             
                                        <h2 class="bd-slider-five-subtitle mb-30 wow fadeInUp" data-wow-delay=".6s"><?php echo wp_kses_post( $slide['title2'] ); ?></h2>
                                        <?php endif; ?>  

                                        <?php if ( !empty($slide['desc']) ) : ?>
                                        <p class="mb-40 wow fadeInUp" data-wow-delay=".8s"><?php echo wp_kses_post( $slide['desc'] ); ?></p>
                                        <?php endif; ?>

                                        <div class="bd-slider-five-btn wow fadeInUp" data-wow-delay="1s">
                                           <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>

                                        <?php if ( !empty($slide['video_url']) ) : ?>
                                        <div class="bd-slider-five-video">
                                            <div class="bd-slider-five-video-icon wow fadeInUp" data-wow-delay="1.2s">
                                                <a href="<?php echo esc_url( $slide['video_url'] ); ?>" class="play_btn popup-video"><i class="flaticon-play"></i></a>
                                            </div>
                                            <div class="bd-slider-five-video-text wow fadeInUp" data-wow-delay="1.4s">
                                                <span><?php print esc_html__( 'Watch', 'saja' );?></span>
                                                <h5><?php print esc_html__( 'How I work', 'saja' );?></h5>
                                            </div>
                                        </div>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if( !empty($slide['show_social'] ) ) : ?>
                        <div class="bd-slider-five-social">
                            <?php if ( !empty($slide['social_title']) ) : ?>
                            <span><?php echo wp_kses_post( $slide['social_title'] ); ?></span>
                            <?php endif; ?>
                            <ul>
                                <?php if( !empty($slide['web_title'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                        <i class="far fa-globe"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['email_title'] ) ) : ?>
                                <li>    
                                    <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                        <i class="fal fa-envelope"></i>
                                    </a>
                                </li>
                                <?php endif; ?>  

                                <?php if( !empty($slide['phone_title'] ) ) : ?>
                                <li>    
                                    <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </li>
                                <?php endif; ?>  

                                <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                <li>     
                                    <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                        <i class="fab fa-flickr"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                        <i class="fab fa-vimeo-v"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['behance_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                        <i class="fab fa-behance"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                        <i class="fab fa-dribbble"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                <li>    
                                    <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                <li>   
                                    <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                        <i class="fab fa-github"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <?php endif; ?> 
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- slider area end here -->


        <?php elseif ($settings['designs'] === 'design_6'): ?>

        <!-- slider area start here -->
        <section class="bd-slider-area fix">
            <div class="bd-slider-actives">
                <div class="swiper-wrappers">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );

                        $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn bdevs-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?> 
                    <div class="bd-single-slider gray-bg bd-slider-height pt-200 w-full position-relative">
                        <?php if (!empty($slide['shape_switch'])): ?>
                        <img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-5.png" class="bd-slider-six-img-shape5" alt="img not found">
                        <?php endif; ?>

                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-7">
                                    <div class="bd-slider-six">
                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 class="bd-slider-six-title mb-30 wow fadeInUp" data-wow-delay=".2s"><?php echo wp_kses_post( $slide['title'] ); ?></h1>
                                        <?php endif; ?>

                                        <div class="bd-slider-video-spacing mb-90">
                                            <div class="bd-slider-five-btn wow fadeInUp" data-wow-delay=".4s">
                                               <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                        printf( '<a %1$s>%2$s</a>',
                                                            $this->get_render_attribute_string( 'button_'. $key ),
                                                            esc_html( $slide['button_text'] )
                                                            );
                                                    elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                    <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                        if ( $slide['button_icon_position'] === 'before' ): ?>
                                                            <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                            <?php
                                                        else: ?>
                                                            <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                        <?php
                                                        endif;
                                                endif; ?> 
                                            </div>

                                            <?php if ( !empty($slide['video_url']) ) : ?>
                                            <div class="bd-slider-five-video">
                                                <div class="bd-slider-five-video-icon wow fadeInUp" data-wow-delay="1.2s">
                                                    <a href="<?php echo esc_url( $slide['video_url'] ); ?>" class="play_btn popup-video"><i class="flaticon-play"></i></a>
                                                </div>
                                                <div class="bd-slider-five-video-text wow fadeInUp" data-wow-delay="1.4s">
                                                    <span><?php print esc_html__( 'Watch', 'saja' );?></span>
                                                    <h5><?php print esc_html__( 'How I work', 'saja' );?></h5>
                                                </div>
                                            </div>
                                            <?php endif; ?> 

                                        </div>
                                        <div class="bd-slider-facts bd-slider-facts-six">
                                            <ul>
                                                <?php foreach ( $settings['slides2'] as $key => $slide ) : ?>
                                                <li>
                                                    <div class="bd-slider-fact wow fadeInUp" data-wow-delay="1s">
                                                        <h4 class="bd-slider-fact-title text-heading"><span class="odometer" data-count="<?php echo esc_attr( $slide['number'] ); ?>"></span><?php echo wp_kses_post( $slide['number_sign'] ); ?></h4>
                                                        <span class="bd-slider-fact-subtitle text-heading"><?php echo wp_kses_post( $slide['title'] ); ?></span>
                                                    </div>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="bd-slider-six-img">
                                        <?php if (!empty($image)): ?>
                                        <img src="<?php print esc_url($image); ?>" class="rounded-10" alt="img not found">
                                        <?php endif; ?>

                                        <img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-3.png" class="bd-slider-six-img-shape1" alt="img not found">
                                        <img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-4.png" class="bd-slider-six-img-shape2" alt="img not found">
                                        <img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-6.png" class="bd-slider-six-img-shape3" alt="img not found">
                                        <img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-7.png" class="bd-slider-six-img-shape4" alt="img not found">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- slider area end here -->


        <?php elseif ($settings['designs'] === 'design_3'):

        $this->add_render_attribute( 'button', 'class', 'z-btn z-btn-border  bdevs-el-btn' );
        
        ?>

        <section class="bd-slider-area">
            <div class="bd-slider-actives">
                <div class="swiper-wrappers">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn-black bdevs-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>   
                    <div class="bd-single-slider bd-slider-height bd-single-slider-overlay-invisible d-flex align-items-center">
                        <div class="bd-slide-bg" data-background="<?php print esc_url($image); ?>"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bd-slider z-index pt-125">
                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 class="bd-slider-title bdevs-el-title bd-slider-title-three mb-30 wow fadeInUp" data-wow-delay=".3s"><?php echo wp_kses_post( $slide['title'] ); ?></h1>
                                        <?php endif; ?>

                                        <div class="bd-slider-btn mb-95 wow fadeInUp" data-wow-delay=".6s">
                                           <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>

                                        <?php if( !empty($slide['show_social'] ) ) : ?>
                                        <div class="bd-slider-social-three wow fadeInUp" data-wow-delay=".9s">
                                            <?php if ( !empty($slide['social_title']) ) : ?>
                                            <h6><?php echo wp_kses_post( $slide['social_title'] ); ?></h6>
                                            <?php endif; ?>

                                            <ul>
                                                <?php if( !empty($slide['web_title'] ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                                        <i class="far fa-globe"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['email_title'] ) ) : ?>
                                                <li>    
                                                    <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                                        <i class="fal fa-envelope"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>  

                                                <?php if( !empty($slide['phone_title'] ) ) : ?>
                                                <li>    
                                                    <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                                        <i class="fas fa-phone"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>  

                                                <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                                <li>     
                                                    <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                                        <i class="fab fa-flickr"></i>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                                        <i class="fab fa-vimeo-v"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['behance_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                                        <i class="fab fa-behance"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                                        <i class="fab fa-dribbble"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                                <li>    
                                                    <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                                        <i class="fab fa-pinterest-p"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                                <li>   
                                                    <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                                        <i class="fab fa-github"></i>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php elseif ($settings['designs'] === 'design_2'):  ?>

        <section class="bd-slider-area">
            <div class="bd-slider-actives">
                <div class="swiper-wrappers">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        $this->add_render_attribute( 'button_'. $key, 'class', 'theme-btn theme-btn-rounded bdevs-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>    
                    <div class="bd-single-slider bd-slider-height bd-single-slider-overlay-invisible d-flex align-items-center swiper-slides">
                        <div class="bd-slide-bg" data-background="<?php print esc_url($image); ?>"></div>

                        <?php if (!empty($slide['shape_switch'])): ?>
                        <div class="bd-slide-shape"><img src="<?php print get_template_directory_uri(); ?>/assets/img/slider/slider-shape-1.png" alt="img not found"></div>
                        <?php endif; ?>

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="bd-slider-two z-index pt-120">
                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 class="bd-slider-title-two mb-25 wow fadeInUp" data-wow-delay=".2s"><?php echo wp_kses_post( $slide['title'] ); ?></h1>
                                        <?php endif; ?>

                                        <?php if ( !empty($slide['desc']) ) : ?>
                                        <h4 class="bd-slider-subtitle-two mb-45 wow fadeInUp" data-wow-delay=".4s">
                                            <?php echo wp_kses_post( $slide['desc'] ); ?>
                                        </h4>
                                        <?php endif; ?>

                                        <div class="bd-slider-btn mb-90 wow fadeInUp" data-wow-delay=".6s">
                                           <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>
                                        <div class="bd-slider-facts">
                                            <ul>
                                                <?php foreach ( $settings['slides2'] as $key => $slide ) : ?>
                                                <li>
                                                    <div class="bd-slider-fact wow fadeInUp" data-wow-delay=".8s">
                                                        <h4 class="bd-slider-fact-title text-white"><span class="odometer" data-count="<?php echo esc_attr( $slide['number'] ); ?>"></span><?php echo wp_kses_post( $slide['number_sign'] ); ?></h4>
                                                        <span class="bd-slider-fact-subtitle text-white"><?php echo wp_kses_post( $slide['title'] ); ?></span>
                                                    </div>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php else: 
        ?>

        <!-- Hero-area-start -->
          <div class="bd-hero__area p-relative">
             <div class="bd-hero__active swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        $this->add_render_attribute( 'button_'. $key, 'class', 'bdevs-el-btn' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>
                   <div class="swiper-slide">
                      <div class="bd-singel__hero bd-hero__height-1 d-flex align-items-center"
                         data-background="<?php print esc_url($image); ?>">
                         <div class="container">
                            <div class="row">
                               <div class="col-xxl-8 cl-xl-10 ">
                                  <div class="bd-hero__content">
                                     <div class="bd-section__title bdevs-el-content" data-animation="fadeInUp" data-delay=".3s">
                                        <?php if ( !empty($slide['shape_title']) ) : ?>
                                        <span class="bd-stroke__title-hero"><?php echo wp_kses_post( $slide['shape_title'] ); ?></span>
                                        <?php endif; ?>

                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h2 class="bd-hero__title bdevs-el-title mb-5"><?php echo wp_kses_post( $slide['title'] ); ?></h2>
                                        <?php endif; ?>
                                        <?php if ( !empty($slide['desc']) ) : ?>
                                        <p class="bd-hero__paraghrap mb-50" data-animation="fadeInUp" data-delay=".7s"><?php echo wp_kses_post( $slide['desc'] ); ?></p>
                                        <?php endif; ?>

                                     </div>
                                     <div class="hero__btn" data-animation="fadeInUp" data-delay="0.9s">

                                        <?php if ( !empty($slide['button_text']) ) : ?>
                                        <a class="bd-theme__btn-4 bdevs-el-btn" href="<?php echo esc_url( $slide['button_link']['url'] ); ?>"><?php echo esc_html($slide['button_text']); ?></a>
                                        <?php endif; ?>
                                        <?php if ( !empty($slide['button_text2']) ) : ?>
                                        <a class="bd-theme__btn-2" href="<?php echo esc_url( $slide['button_link2']['url'] ); ?>"><?php echo esc_html($slide['button_text2']); ?></a>
                                        <?php endif; ?>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                         <?php if ( !empty($slide['shape_switch']) ) : ?>
                         <div class="hero__shape  bd-hero__shape-1 d-none d-sm-block">
                            <strong></strong>
                            <?php if ( !empty($slide['counter_title_one']) ) : ?>
                            <h6><?php echo wp_kses_post( $slide['counter_title_one'] ); ?></h6>
                            <?php endif; ?>
                            <span class="counter"><?php echo wp_kses_post( $slide['counter_number_one'] ); ?></span><span><?php echo wp_kses_post( $slide['counter_sign_one'] ); ?></span>
                         </div>
                         <div class="hero__shape bd-hero__shape-2 d-none d-sm-block">
                            <strong></strong>
                            <?php if ( !empty($slide['counter_title_two']) ) : ?>
                            <h6><?php echo wp_kses_post( $slide['counter_title_two'] ); ?></h6>
                            <?php endif; ?>
                            <span class="counter"><?php echo wp_kses_post( $slide['counter_number_two'] ); ?></span><span><?php echo wp_kses_post( $slide['counter_sign_two'] ); ?></span>
                         </div>
                         <?php endif; ?>
                      </div>
                   </div>
                   <?php endforeach; ?>
                </div>
             </div>
             <!-- If we need pagination -->
             <div class="bd-hero__nav">
                <button class="bd-hero__pagination hero-button-prev">
                   <i class="fal fa-long-arrow-left"></i>
                </button>
                <button class="bd-hero__pagination hero-button-next">
                   <i class="fal fa-long-arrow-right"></i>
                </button>
             </div>
          </div>
        <!-- Hero-area-end -->

        <?php endif; ?>
    <?php
    }
}
