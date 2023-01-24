<?php

namespace Bdevs\Elementor;

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
        wp_register_script('bdevs-elementor-js', BDEVS_ELEMENTOR_ASSETS . '/js/bdevs-elementor.js', [], BDEVS_ELEMENTOR_VERSION, true);
        wp_register_script('magnific-popup', BDEVS_ELEMENTOR_ASSETS . '/lib/js/jquery.magnific-popup.min.js', [], BDEVS_ELEMENTOR_VERSION, true);
    }

    public function register_css()
    {
        wp_register_style('bdevs-elementor-css', BDEVS_ELEMENTOR_ASSETS . '/css/bdevs-elementor.css', [], BDEVS_ELEMENTOR_VERSION, false);
        wp_register_style('magnific-popup', BDEVS_ELEMENTOR_ASSETS . '/lib/css/magnific-popup.css', [], BDEVS_ELEMENTOR_VERSION, false);
        wp_register_style('bdevs-elementor-flaticon', BDEVS_ELEMENTOR_ASSETS . '/fonts/css/flaticons.css', [], BDEVS_ELEMENTOR_VERSION, false);
    }

    public function editor_register_css()
    {
        wp_enqueue_style('gen-editor', BDEVS_ELEMENTOR_ASSETS . '/css/gen-editor.css', [], BDEVS_ELEMENTOR_VERSION, false);
    }
}
