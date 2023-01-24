<?php
namespace Generic\Elements;

class RegisterCategory {

    /**
	 * Instance of Elemenntor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	public static $elementor_instance;

    public function run() {
        if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

			self::$elementor_instance = \Elementor\Plugin::instance();
			add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_category' ], 1 );
			add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		}
    }

    /**
	 * Add Elementor category.
	 */
	public function add_elementor_category() {
    	self::$elementor_instance->elements_manager->add_category('generic-elements',
	      	array(
					'title' => esc_html__( 'Generic Elements', 'generic-elements' ),
					'icon'  => 'fa fa-plug',
	      	)
	    );

		self::$elementor_instance->elements_manager->add_category('generic-elements-pro',
	      	array(
					'title' => esc_html__( 'Generic Elements Pro', 'generic-elements' ),
					'icon'  => 'fa fa-plug',
	      	)
	    );
	}

	/**
	 * Initialize widgets
	 *
	 * @since 1.0.0
	 */
    public function init_widgets() {
        $widgets = new Helper;
		$widget_lists = $widgets::get_widgets();

		foreach ( $widget_lists as $widget_list => $data ) {

			$widget_class = '\Generic\Elements\\'.ucwords(str_replace( '-', '_', $widget_list ));

			if ( class_exists( $widget_class ) ) {
        		self::$elementor_instance->widgets_manager->register( new $widget_class  );
			}
        }
    }
}
