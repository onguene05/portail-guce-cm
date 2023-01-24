<?php

namespace Generic\Elements;

class Assets
{

    public function run()
    {
        add_action('elementor/frontend/after_register_scripts', [$this, 'register_js']);
        add_action('elementor/frontend/after_register_styles', [$this, 'register_css']);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_register_css']);
    }

    public function register_js()
    {
        wp_register_script('bootstrap', GENERIC_ELEMENTS_ASSETS . '/lib/js/bootstrap.bundle.min.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('magnific-popup', GENERIC_ELEMENTS_ASSETS . '/lib/js/jquery.magnific-popup.min.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('counterup-js', GENERIC_ELEMENTS_ASSETS . '/lib/js/jquery.counterup.min.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('waypoints-js', GENERIC_ELEMENTS_ASSETS . '/lib/js/waypoints.min.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('wow-js', GENERIC_ELEMENTS_ASSETS . '/lib/js/wow.min.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('swiper', GENERIC_ELEMENTS_ASSETS . '/lib/js/swiper-bundle.js', [], GENERIC_ELEMENTS_VERSION, true);
        wp_register_script('generic-element-js', GENERIC_ELEMENTS_ASSETS . '/js/generic-elements.js', [], GENERIC_ELEMENTS_VERSION, true);
    }

    public function register_css()
    {
        wp_register_style('bootstrap', GENERIC_ELEMENTS_ASSETS . '/lib/css/bootstrap.min.css', [], GENERIC_ELEMENTS_VERSION, false);
        wp_register_style('fontawesome', GENERIC_ELEMENTS_ASSETS . '/css/fontawesome.min.css', [], GENERIC_ELEMENTS_VERSION, false);
        wp_register_style('magnific-popup', GENERIC_ELEMENTS_ASSETS . '/lib/css/magnific-popup.css', [], GENERIC_ELEMENTS_VERSION, false);

        wp_register_style('odometer-css', GENERIC_ELEMENTS_ASSETS . '/lib/css/odometer.css', [], GENERIC_ELEMENTS_VERSION, false);

        wp_register_style('animate-css', GENERIC_ELEMENTS_ASSETS . '/lib/css/animate.min.css', [], GENERIC_ELEMENTS_VERSION, false);
        wp_register_style('flaticon', GENERIC_ELEMENTS_ASSETS . '/css/flaticon.css', [], GENERIC_ELEMENTS_VERSION, false);
        wp_register_style('swiper', GENERIC_ELEMENTS_ASSETS . '/lib/css/swiper-bundle.css', [], GENERIC_ELEMENTS_VERSION, false);
        wp_register_style('generic-element-css', GENERIC_ELEMENTS_ASSETS . '/css/generic-elements.css', [], GENERIC_ELEMENTS_VERSION, false);
    }

    public function editor_register_css()
    {
        wp_enqueue_style('gen-editor', GENERIC_ELEMENTS_ASSETS . '/css/gen-editor.css', [], GENERIC_ELEMENTS_VERSION, false);
    }
}
