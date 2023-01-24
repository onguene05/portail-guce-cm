<?php
namespace Bdevs\Elementor;

defined('ABSPATH') || die();

class PricingTable extends \Generic\Elements\GenericWidget
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
        return 'cust-pricingtable';
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
        return esc_html__('Pricing Table', 'bdevs-elementor');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/pricing-table/';
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
        return 'eicon-table-of-contents gen-icon';
    }

    public function get_keywords()
    {
        return ['pricing', 'price', 'table', 'package', 'product', 'plan'];
    }
    public function get_categories()
    {
        return ['bdevs-elementor'];
    }

    // register_content_controls
    protected function register_content_controls(){
        $this->design_style_control();
        $this->icon_image_control();
        $this->pricing_heading_control();
        $this->pricing_badge_control();
        $this->pricing_currency_control();
        $this->pricing_features_control();
        $this->pricing_footer_control();
    }

    protected function design_style_control(){
        $this->start_controls_section(
            '_section_design',
            [
                'label' => esc_html__( 'Presets', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'designs',
            [
                'label' => esc_html__('Designs', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'design_1' => esc_html__('Design 1', 'bdevs-elementor'),
                    'design_2' => esc_html__('Design 2', 'bdevs-elementor'),
                    'design_3' => esc_html__('Design 3', 'bdevs-elementor'),
                ],
                'default' => 'design_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'active_price',
            [
                'label' => esc_html__('Active Price', 'bdevs-element'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => false,
                'style_transfer' => true,
            ]
        );
        $this->end_controls_section();
    }

    public function icon_image_control()
    {
        $this->start_controls_section(
            '_section_media',
            [
                'label' => esc_html__( 'Icon / Image', 'bdevs-elementor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Media Type', 'bdevs-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'bdevs-elementor' ),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'bdevs-elementor' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'bdevs-elementor' ),
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

        $this->add_group_control(
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

        $this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);

        $this->end_controls_section();
    }

    protected function pricing_heading_control(){
        // Header
        $this->start_controls_section(
            '_section_header',
            [
                'label' => esc_html__('Header', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'plan_name',
            [
                'label' => esc_html__('Pricing Plan Name', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Business Plan', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'plan_desc',
            [
                'label' => esc_html__('Pricing Plan Desc', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__('Jira Service Management™ Adds Visibility & Velocity to Your....', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_badge_control(){
        $this->start_controls_section(
            '_section_badge',
            [
                'label' => esc_html__('Badge', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => esc_html__('Show', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'false',
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Popular', 'bdevs-elementor'),
                'placeholder' => esc_html__('Type badge text', 'bdevs-elementor'),
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_currency_control(){
        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => esc_html__('Pricing', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => esc_html__('None', 'bdevs-elementor'),
                    'baht' => '&#3647; ' . _x('Baht', 'Currency Symbol', 'bdevs-elementor'),
                    'bdt' => '&#2547; ' . _x('BD Taka', 'Currency Symbol', 'bdevs-elementor'),
                    'dollar' => '&#36; ' . _x('Dollar', 'Currency Symbol', 'bdevs-elementor'),
                    'euro' => '&#128; ' . _x('Euro', 'Currency Symbol', 'bdevs-elementor'),
                    'franc' => '&#8355; ' . _x('Franc', 'Currency Symbol', 'bdevs-elementor'),
                    'guilder' => '&fnof; ' . _x('Guilder', 'Currency Symbol', 'bdevs-elementor'),
                    'krona' => 'kr ' . _x('Krona', 'Currency Symbol', 'bdevs-elementor'),
                    'lira' => '&#8356; ' . _x('Lira', 'Currency Symbol', 'bdevs-elementor'),
                    'peseta' => '&#8359 ' . _x('Peseta', 'Currency Symbol', 'bdevs-elementor'),
                    'peso' => '&#8369; ' . _x('Peso', 'Currency Symbol', 'bdevs-elementor'),
                    'pound' => '&#163; ' . _x('Pound Sterling', 'Currency Symbol', 'bdevs-elementor'),
                    'real' => 'R$ ' . _x('Real', 'Currency Symbol', 'bdevs-elementor'),
                    'ruble' => '&#8381; ' . _x('Ruble', 'Currency Symbol', 'bdevs-elementor'),
                    'rupee' => '&#8360; ' . _x('Rupee', 'Currency Symbol', 'bdevs-elementor'),
                    'indian_rupee' => '&#8377; ' . _x('Rupee (Indian)', 'Currency Symbol', 'bdevs-elementor'),
                    'shekel' => '&#8362; ' . _x('Shekel', 'Currency Symbol', 'bdevs-elementor'),
                    'won' => '&#8361; ' . _x('Won', 'Currency Symbol', 'bdevs-elementor'),
                    'yen' => '&#165; ' . _x('Yen/Yuan', 'Currency Symbol', 'bdevs-elementor'),
                    'custom' => esc_html__('Custom', 'bdevs-elementor'),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__('Custom Symbol', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'price_text',
            [
                'label' => esc_html__('Price Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Pay once, own it forever',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '59',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'price_text2',
            [
                'label' => esc_html__('Price Text Bottom', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Cancel anytime around 7 days',
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__('Period/Point', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('.99', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_features_control(){
        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__('Features', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__('Title', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Features', 'bdevs-elementor'),
                'separator' => 'after',
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $this->add_control(
            'features_switch',
            [
                'label' => esc_html__('Show', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'bdevs-elementor'),
                'label_off' => esc_html__('Hide', 'bdevs-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Exciting Feature', 'bdevs-elementor'),
                'dynamic' => [
                    'active' => true
                ]
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICON,
                'label_block' => false,
                'default' => 'fa fa-check',
                'include' => [
                    'fa fa-check',
                    'fa fa-close',
                ]
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__('Icon', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-regular' => [
                        'check-square',
                        'window-close',
                    ],
                    'fa-solid' => [
                        'check',
                    ]
                ]
            ]
        );
        $this->add_control(
            'features_list',
            [
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__('Standard Feature', 'bdevs-elementor'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__('Another Great Feature', 'bdevs-elementor'),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__('Obsolete Feature', 'bdevs-elementor'),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => esc_html__('Exciting Feature', 'bdevs-elementor'),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '<# print((text)); #>',
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_footer_control(){
        $this->start_controls_section(
            '_section_footer',
            [
                'label' => esc_html__('Price Footer', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Subscribe', 'bdevs-elementor'),
                'placeholder' => esc_html__('Type button text here', 'bdevs-elementor'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
					'url' => '#',
				],
            ]
        );

        $this->end_controls_section();


    }



    // register_style_controls
    protected function register_style_controls(){
        $this->pricing_content_style_controls();
        $this->pricing_header_style_controls();
        $this->pricing_style_controls();
        $this->pricing_features_style_controls();
        $this->pricing_footer_style_controls();
        $this->pricing_badge_style_controls();

    }

    protected function pricing_content_style_controls(){

        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__('General', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pricing_content_padding',
            [
                'label' => esc_html__('Content Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('_tabs_pricing_border');

        $this->start_controls_tab(
            '_tab_pricing_border_normal',
            [
                'label' => esc_html__('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'pricing_box_border_color',
                'selector' => '{{WRAPPER}} .gen-pricing-box',
            ]
        );

        $this->add_responsive_control(
            'pricing_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_pricing_border_hover',
            [
                'label' => esc_html__('Hover', 'bdevs-elementor'),
            ]
        );


        $this->add_control(
            'pricing_box_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-box:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_responsive_control(
            'align',
            [
                'label'     => esc_html__( 'Alignment', 'bdevs-elementor' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'bdevs-elementor' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-box, {{WRAPPER}} .gen-price-package-general .gen-package-price, {{WRAPPER}} .gen-package-price' => 'text-align: {{VALUE}};', '{{VALUE}}',
                ],
                'selectors_dictionary' => [
					'left' => '-webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start; text-align: left',
					'center' => '-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; text-align: center',
					'right' => '-webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end; text-align: right',
				],
            ]
        );

        $this->end_controls_section();

    }


    protected function pricing_header_style_controls(){
        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__('Header', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-package-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-package-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .gen-package-name',
            ]
        );


        $this->add_control(
            'pricing_heading_bg_color',
            [
                'label' => esc_html__('Heading BG Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-header' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .gen-package-name',
            ]
        );

        $this->add_control(
            'header_icon_color',
            [
                'label' => esc_html__('Header Icon Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-package-style-2 .gen-package-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_style_controls(){
        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => esc_html__('Pricing', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Price', 'bdevs-elementor'),
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-package-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-package-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .gen-package-price',
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Currency', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => esc_html__('Side Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-price-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .gen-price-currency',
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Period', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-price-period' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .gen-price-period',
            ]
        );

        $this->end_controls_section();
    }

    protected function pricing_features_style_controls(){
        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => esc_html__('Features', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_features_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Features List Title', 'bdevs-elementor'),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .gen-price-features-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-features-list' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_top_border_color',
            [
                'label' => esc_html__('Top Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-package-general .features-list' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'designs' => ['design_3'],
                ],
            ]
        );
        $this->add_control(
            'features_list_icon_color',
            [
                'label' => esc_html__('Features List Icon Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-price-package-style-2 .features-list li i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'designs' => ['design_2'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .gen-price-features-list',
            ]
        );
        $this->end_controls_section();
    }

    protected function pricing_footer_style_controls(){
        $this->start_controls_section(
            '_section_style_footer',
            [
                'label' => esc_html__('Footer', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_button',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => esc_html__('Button', 'bdevs-elementor'),
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label' => esc_html__('Border Radius', 'bdevs-elementor'),
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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
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
                'label' => esc_html__('Normal', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_colors',
            [
                'label' => esc_html__('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__('Hover', 'bdevs-elementor'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-el-btn:hover, {{WRAPPER}} .bdevs-el-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-el-btn:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function pricing_badge_style_controls(){
        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__('Badge', 'bdevs-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'designs' => ['design_1'],
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => esc_html__('Padding', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__('Text Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__('Background Color', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-badge' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .gen-pricing-badge',
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdevs-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .gen-pricing-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .gen-pricing-badge',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__('Typography', 'bdevs-elementor'),
                'selector' => '{{WRAPPER}} .gen-pricing-badge',
            ]
        );

        $this->end_controls_section();
    }


    private static function get_currency_symbol($symbol_name)
    {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset($symbols[$symbol_name]) ? $symbols[$symbol_name] : '';
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('title', 'class', 'item_title');
        $this->add_render_attribute('sub_title', 'class', 'sub_title');

        $this->add_inline_editing_attributes('price', 'basic');
        $this->add_render_attribute('price', 'class', 'pricing_text');

        $this->add_inline_editing_attributes('period', 'basic');
        $this->add_render_attribute('period', 'class', 'price-period');

        $this->add_inline_editing_attributes('features_title', 'basic');
        $this->add_render_attribute('features_title', 'class', 'price-featured mb-20');

        if ($settings['currency'] === 'custom') {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol($settings['currency']);
        }

        ?>


        <?php if ($settings['designs'] === 'design_3'):
            $class_name = $settings['active_price'] ? 'active' : '';

            $this->add_inline_editing_attributes('button_footer', 'none');
            $this->add_render_attribute('button_footer', 'class', 'gen-border-btn bdevs-el-btn');
            $this->add_link_attributes('button_footer', $settings['button_link']);

        ?>

        <div class="gen-price-package gen-price-package-style-3 mb-30 gen-pricing-box <?php echo $settings['active_price'] ? 'package-popular': ''; ?>">

            <div class="gen-pricing-header">
                <?php if (!empty($settings['plan_name'])) : ?>
                    <h4 class="gen-package-name"><?php echo wp_kses_post($settings['plan_name']); ?></h4>
                <?php endif; ?>

                <span class="gen-package-price">
                    <span class="price-currency gen-price-currency"><?php echo esc_html($currency); ?></span>
                    <?php echo wp_kses_post($settings['price']); ?>
                    <span class="additional-points gen-price-period"><?php echo wp_kses_post($settings['period']); ?></span>
                </span>
            </div>

            <div class="gen-pricing-content">
                <div class="features-list">
                    <ul>
                        <?php foreach ($settings['features_list'] as $index => $feature) :
                            $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                            $this->add_inline_editing_attributes($name_key, 'intermediate');
                            $this->add_render_attribute($name_key, 'class', 'price-feature-text');
                        ?>
                            <?php if(!empty($feature['text'])) : ?>
                                <li class="gen-price-features-list"><?php echo wp_kses_post($feature['text']); ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <?php if (!empty($settings['button_text'])) : ?>
                <div class="gen-pricing-btn">
                    <a <?php $this->print_render_attribute_string('button_footer'); ?>><?php echo esc_html($settings['button_text']); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>


    <?php elseif ($settings['designs'] === 'design_2') :
        $class_name = $settings['active_price'] ? 'active' : '';
        $this->add_inline_editing_attributes('button_footer', 'none');
        $this->add_render_attribute('button_footer', 'class', 'gen-fill-btn bdevs-el-btn');
        $this->add_link_attributes('button_footer', $settings['button_link']);
    ?>

        <div class="gen-price-package gen-price-package-style-2 gen-pricing-box <?php echo $settings['active_price'] ? 'package-popular': ''; ?> ">
            <div class="gen-pricing-header">
                <span class="gen-package-icon">
                    <?php if ( $settings['type'] === 'image' && ( $settings['image']['url'] || $settings['image']['id'] ) ) :
						$this->get_render_attribute_string( 'image' );
						$settings['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
						?>
						<figure>
							<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
						</figure>
						<?php elseif ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon']['value'] ) ) : ?>
						<figure>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</figure>
					<?php endif; ?>
                </span>

                <?php if ($settings['plan_name']) : ?>
                    <h4 class="gen-package-name"><?php echo wp_kses_post($settings['plan_name']); ?></h4>
                <?php endif; ?>
            </div>

            <div class="gen-pricing-content">
                <div class="features-list">
                    <ul>
                        <?php foreach ($settings['features_list'] as $index => $feature) :
                            $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                            $this->add_inline_editing_attributes($name_key, 'intermediate');
                            $this->add_render_attribute($name_key, 'class', 'price-feature-text');
                        ?>
                            <?php if(!empty($feature['text'])) : ?>
                                <li class="gen-price-features-list">

                                <?php if (!empty($feature['icon']) || !empty($feature['selected_icon']['value'])) :
                                    generic_elements_render_icon($feature, 'icon', 'selected_icon');
                                endif; ?>
                                    <?php echo wp_kses_post($feature['text']); ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <span class="gen-package-price">
                    <span class="price-currency gen-price-currency"><?php echo esc_html($currency); ?></span>
                    <?php echo wp_kses_post($settings['price']); ?>
                    <span class="price-period gen-price-period"><?php echo wp_kses_post($settings['period']); ?></span>
                </span>

                <?php if (!empty($settings['button_text'])) : ?>
                <div class="gen-pricing-btn">
                    <a <?php $this->print_render_attribute_string('button_footer'); ?>><?php echo esc_html($settings['button_text']); ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>


    <?php else:

        $class_name = $settings['active_price'] ? 'active' : '';
        $this->add_inline_editing_attributes('button_footer', 'none');
        $this->add_render_attribute('button_footer', 'class', 'pricing-btn bdevs-el-btn');
        $this->add_link_attributes('button_footer', $settings['button_link']);
        ?>

        <div class="row align-items-center g-0">
            <div class="col-xl-4 col-lg-4">
                <div class="bd-pricing-wrapper mb-30">
                    <div class="bd-singel-item">
                        <div class="bd-pricing-content">
                            <?php if ($settings['plan_name']) : ?>
                            <h3><?php echo wp_kses_post($settings['plan_name']); ?></h3>
                            <?php endif; ?>

                            <?php if ($settings['plan_desc']) : ?>
                            <p><?php echo wp_kses_post($settings['plan_desc']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bd-pricing-wrapper text-center mb-30">
                    <div class="bd-singel-item-2">
                        <div class="bd-pricing-content">
                            <?php if (!empty($settings['price_text'])) : ?>
                            <h5><?php echo wp_kses_post($settings['price_text']); ?></h5>
                            <?php endif; ?>
                            <div class="pricing-text">
                               <sub><?php echo esc_html($currency); ?></sub>
                               <span><?php echo wp_kses_post($settings['price']); ?></span>
                            </div>

                            <?php if (!empty($settings['price_text2'])) : ?>
                            <span class="cancel-text"><?php echo wp_kses_post($settings['price_text2']); ?></span>
                            <?php endif; ?>

                            <?php if (!empty($settings['button_text'])) : ?>
                            <a <?php $this->print_render_attribute_string('button_footer'); ?>><i class="fa-regular fa-basket-shopping"></i><?php echo esc_html($settings['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="bd-pricing-wrapper mb-30">
                    <div class="bd-singel-item">
                        <div class="bd-pricing-content">
                            <div class="bd-pricing-list">
                                <ul>
                                    <?php foreach ($settings['features_list'] as $index => $feature) :
                                        $name_key = $this->get_repeater_setting_key('text', 'features_list', $index);
                                        $this->add_inline_editing_attributes($name_key, 'intermediate');
                                        $this->add_render_attribute($name_key, 'class', 'price-feature-text');
                                    ?> 
                                    <?php if(!empty($feature['text'])) : ?>
                                    <li><i class="far fa-check"></i><?php echo wp_kses_post($feature['text']); ?></li>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php endif; ?>

        <?php
    }
}
