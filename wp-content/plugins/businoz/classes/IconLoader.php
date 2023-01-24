<?php
namespace Bdevs\Elementor;

class IconLoader
{

    public function run() {

        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_bdevs_el_flat_icons_tab' ] );
        
      }


      public static function add_bdevs_el_flat_icons_tab( $tabs ) {
        $tabs['bdevs-elements-pro-flaticons'] = [
            'name' => 'bdevs-elements-pro-icons',
            'label' => __( 'FlatIcons', 'bdevs-element' ),
            'url' => BDEVS_ELEMENTOR_ASSETS . '/css/flaticon.css',
            'enqueue' => [ BDEVS_ELEMENTOR_ASSETS . '/css/flaticon.css' ],
            'prefix' => '',
            'displayPrefix' => '',
            'labelIcon' => 'flaticon-business-and-finance-1',
            'ver' => BDEVS_ELEMENTOR_VERSION,
            'fetchJson' => BDEVS_ELEMENTOR_ASSETS . '/gep-flaticons.js?v=' . BDEVS_ELEMENTOR_VERSION,
            'native' => false,
        ];
        return $tabs;
      }

}