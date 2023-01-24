<?php
namespace Generic\Elements;

class Notices {
    public function run() {
      // Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, GENERIC_ELEMENTS_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_generic_elements_minimum_elementor_version' ] );
			return;
		}

        // Check for required PHP version
		if ( version_compare( PHP_VERSION, GENERIC_ELEMENTS_MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_generic_elements_minimum_php_version' ] );
			return;
		}

    }

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Generic Elements', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'generic-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_generic_elements_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Bdevs Element', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'generic-elements' ) . '</strong>',
			 GENERIC_ELEMENTS_MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

    /**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_generic_elements_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'generic-elements' ),
			'<strong>' . esc_html__( 'Bdevs Element', 'generic-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'generic-elements' ) . '</strong>',
			 GENERIC_ELEMENTS_MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
}