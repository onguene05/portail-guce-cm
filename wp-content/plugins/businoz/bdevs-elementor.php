<?php

/**
 * Plugin Name:       Bdevs Elementor
 * Plugin URI:        https://bdevs.net/
 * Description:       The ultimate Elementor Addons
 * Version:           1.0.3
 * Author:            Bdevs
 * Requires at least: 5.8
 * Author URI:        https://www.devsnews.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bdevs-elementor
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

//Require autoload files
require_once __DIR__ . '/vendor/autoload.php';

function bdevs_elementor_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
{

    // Check if its already migrated
    $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty($settings[$old_icon_id]);

    $attributes['aria-hidden'] = 'true';

    \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);

}

/**
 * Base_Plugin class
 *
 * The class that holds the entire Bdevs_Elementor plugin
 */
final class Bdevs_Elementor
{

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.3';

    /**
     * Constructor for the Base_Plugin class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     */
    public function __construct()
    {

        $this->define_constants();
        add_action('plugins_loaded', [$this, 'init_classes']);
        add_action('admin_notices', [$this, 'installation_notice']);
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('BDEVS_ELEMENTOR_VERSION', $this->version);
        define('BDEVS_ELEMENTOR_FILE', __FILE__);
        define('BDEVS_ELEMENTOR_PATH', __DIR__);
        define('BDEVS_ELEMENTOR_INCLUDES', BDEVS_ELEMENTOR_PATH . '/includes');
        define('BDEVS_ELEMENTOR_URL', plugins_url('', BDEVS_ELEMENTOR_FILE));
        define('BDEVS_ELEMENTOR_ASSETS', BDEVS_ELEMENTOR_URL . '/assets');
    }

    /**
     * Instantiate the required classes
     *
     * @return void
     */
    public function init_classes()
    {
        if (class_exists('Bdevs_Elementor')) {

            $reg_wid = new Bdevs\Elementor\RegisterWidgets();
            $reg_wid->run();

            $assets = new Bdevs\Elementor\Assets;
            $assets->run();

            $icon_loader = new Bdevs\Elementor\IconLoader;
            $icon_loader->run();

        }
    }

    /**
     * Show Admin Notice If Free Plugin Not installed
     *
     * @since 1.0.0
     *
     * @param null
     *
     * @return void
     */
    public function installation_notice()
    {
        if (!class_exists('Bdevs_Elementor')) {

            echo 'adf d fdsa fd fd fdsafdfdsf dsf df dsf dsf edf dsfdasf';
        }
    }

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {
        // Load textdomain
        load_plugin_textdomain('bdevs-elementor', false, basename(dirname(__FILE__)) . '/languages/');
    }

    /**
     * Initializes the Bdevs_Elementor class
     *
     * Checks for an existing Bdevs_Elementor() instance
     * and if it doesn't find one, creates it.
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new Bdevs_Elementor();
        }

        return $instance;
    }
}

Bdevs_Elementor::init();
