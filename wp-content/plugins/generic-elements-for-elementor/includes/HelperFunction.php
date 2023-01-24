<?php

namespace Generic\Elements\Pro;


function generic_element_is_elementor_version($operator = '<', $version = '2.6.0')
{
    return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
}



function get_generic_elements_icons(){
    return [
        'fa-solid' => [
            'chevron-up',
            'angle-up',
            'angle-double-up',
            'caret-up',
            'caret-square-up',
        ],
        'fa-regular' => [
            'caret-square-up',
        ],
    ];
}

function generic_elements_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
{

    // Check if its already migrated
    $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty($settings[$old_icon_id]);

    $attributes['aria-hidden'] = 'true';

    \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);

}