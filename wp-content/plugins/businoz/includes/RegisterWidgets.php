<?php 
namespace Bdevs\Elementor;

class RegisterWidgets {

    /**
	 * Instance of Elemenntor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	public static $elementor_instance;

    public function run() {
        self::$elementor_instance = \Elementor\Plugin::instance();
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_category' ], 1 );
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
    } 

    /**
	 * Add Elementor category.
	 */
	public function add_elementor_category() {
	    self::$elementor_instance->elements_manager->add_category('bdevs-elementor',
	      	array(
					'title' => esc_html__( 'Bdevs Elementor', 'bdevs-elementor' ),
					'icon'  => 'fa fa-plug',
	      	) 
	    );
	}

    public function init_widgets() {
        
        $widgets = new Helper;
		$widget_lists = $widgets::get_widgets();

        foreach ( $widget_lists as $widget_list => $data ) {

			$widget_class = '\Bdevs\Elementor\\'.ucwords(str_replace( '-', '_', $widget_list ));
			
			if ( class_exists( $widget_class ) ) {
        		self::$elementor_instance->widgets_manager->register( new $widget_class  );
			}
        }
    } 
}